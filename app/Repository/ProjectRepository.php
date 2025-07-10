<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

final class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function list(): Collection
    {
        return Project::with('users')->get();
    }
}
