<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

final class UsersWithRoleSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);

        Role::create(['name' => 'developer']);
        Role::create(['name' => 'client']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => static::$password ??= Hash::make('admin')
        ]);

        $user->assignRole($roleAdmin);

        User::factory()
            ->count(3)
            ->create()
            ->each(function ($user) {
                $user->assignRole('developer');
            });

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->assignRole('client');
            });
    }
}
