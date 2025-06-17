<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class  UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
//        dd($request->input());
        $roles = $request->input('role', []);
        if (!is_array($roles)) {
            $roles = explode(',', $roles);
        }

        return view('content/dashboard/users/index',
            ['users' => $this->userRepository->usersByRoleList($roles)]);
    }

    public function usersByRole(Request $request): View
    {
        return view('content/dashboard/users/index',
            ['users' => $this->userRepository->usersByRoleList($request->path())]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('content/dashboard/users/create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $user = $this->userRepository->create($request->validated());
        $user->assignRole('client');

        return redirect()
            ->route('users.index',['role'=> 'client'])
            ->with('success', __('Пользователь успешно создан'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('content/dashboard/users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user = $this->userRepository->update($user, $request->validated());
        if ($user) {
            return redirect()
                ->route('dashboard')
                ->with('success', __('Пользователь успешно обновлен'));
        }
        return back()->with('success', __('Не удалось обновить пользователя'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($this->userRepository->delete($user)) {
            return redirect()
                ->route('dashboard')
                ->with('success', __('Пользователь безвозвратно удален'));
        }
        return back()->with('success', __('Что-то не удаляется пользователь :('));
    }
}
