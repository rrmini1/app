<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return  ProjectResource::collection($this->projectRepository->list());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $this->projectRepository->create($request->validated());

        return response()->json(['message' => 'Project created successfully.'], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project): JsonResponse
    {
        try {
            $this->projectRepository->update($project, $request->validated());

            return response()->json(['message' => 'Project updated successfully.']);
        }
        catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        try {
            $this->projectRepository->delete($project);
            return response()->json(['message' => 'Project deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['message' => 'Project can not delete'], 400);
        }
    }
}
