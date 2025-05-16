<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function usersByRoleList(string|array $role): Collection
    {
        if ($role == []){
            return $this->list();
        }
        return $this->model::role($role)->get();
    }
}
