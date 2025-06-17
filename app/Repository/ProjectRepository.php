<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function list(): Collection
    {
        return Project::with('users')->get();
    }
}
