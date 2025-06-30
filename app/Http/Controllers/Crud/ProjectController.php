<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Mail\AddUserToProjectMail;
use App\Models\Project;
use App\Models\User;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Services\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly FileUpload                 $fileUpload,
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly UserRepositoryInterface    $userRepository)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('content.dashboard.projects.index', [
            'projects' => $this->projectRepository->list()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('content.dashboard.projects.create', [
            'developers' => $this->userRepository->usersByRoleList('developer'),
            'clients' => $this->userRepository->usersByRoleList('client')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $project = $this->projectRepository->create($request->validated());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $link = $this->fileUpload->upload($file, $project);
                $this->projectRepository->saveImage($project, $link);
            }
        }
        return redirect()
            ->with('success', __('Проект успешно создан'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('content.dashboard.projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        return view('content.dashboard.projects.edit', [
            'project' => $project,
            'developers' => $this->userRepository->usersByRoleList('developer'),
            'clients' => $this->userRepository->usersByRoleList('client')
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image']);

        $status = $this->userRepository->update($project, $data);
        if ($status) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $link = $this->fileUpload->upload($file, $project);
                    $this->projectRepository->saveImage($project, $link);
                }
            }
            return redirect()
                ->route('projects.show', $project)
                ->with('success', __('Проект успешно обновлен'));
        }
        return back()->with('error', __('Не удалось обновить проект'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        if($this->projectRepository->delete($project))
        {
            return redirect()->route('projects.index')->with('success', __('Проект удален'));
        }
        return back()->with('error', __('Что-то не удаляется проект :('));
    }

    public function addUserToProject(Request $request, Project $project): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);

//        $userId = $request->input('user_id');
        $user = User::findOrFail($request->user_id);

        // Проверяем, не добавлен ли уже пользователь
        if (!$project->users()->where('user_id', $user->id)->exists()) {
            $project->users()->attach($user->id);
            // send mail
            try {
                Mail::to($user)->send(new AddUserToProjectMail($project, $user));
            } catch (\Exception $e) {
                Log::error('Ошибка отправки письма'. $e->getMessage());
            }

            return redirect()->back()->with('success', 'User added!');
        }

        return redirect()->back()->with('error', 'User already in project!');
    }

    public function removeUserFromProject( Project $project, User $user): RedirectResponse
    {
        // Проверяем, что пользователь есть в проекте
        if ($project->users()->where('user_id', $user->id)->exists()) {
            // Удаляем связь
            $project->users()->detach($user->id);

            return redirect()->back()
                ->with('success', 'Пользователь успешно удалён из проекта');
        }

        return redirect()->back()
            ->with('error', 'Пользователь не найден в проекте');
    }
}
