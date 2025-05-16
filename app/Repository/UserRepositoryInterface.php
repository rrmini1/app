<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function usersByRoleList(string|array $role): Collection;
}
