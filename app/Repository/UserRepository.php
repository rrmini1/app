<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function usersByRoleList(string $role): Collection
    {
        return $this->model::role($role)->get();
    }
}
