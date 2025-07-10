<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UsersWithRoleSeeder::class,
            ProjectSeeder::class,
            StageSeeder::class,
        ]);
    }
}
