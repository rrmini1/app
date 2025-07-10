<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stage\CreateRequest;
use App\Http\Requests\Stage\UpdateRequest;
use App\Models\Stage;
use App\Repository\StageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class StageController extends Controller
{
    public function __construct(
        private readonly StageRepositoryInterface $stageRepository,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $stage = $this->stageRepository->create($request->validated());

        return redirect()->route('projects.show', ['project' => $stage->project_id]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Stage $stage): RedirectResponse
    {
        $stage->update([
            'pay_status' => $request->has('pay_status'),
        ]);
        if ($this->stageRepository->update($stage, $request->validated())) {
            return redirect()
                ->route('projects.show', ['project' => $stage->project_id]);
        }

        return back()->with('error', 'Не удалось обновить этап проекта');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage): JsonResponse
    {
        try {
            $this->stageRepository->delete($stage);

            return response()->json('ok');
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
