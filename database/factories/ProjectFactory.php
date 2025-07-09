<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            //            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            // Получаем ID всех разработчиков и клиентов
            $developerIds = User::role('developer')->pluck('id')->toArray();
            $clientIds = User::role('client')->pluck('id')->toArray();

            if (empty($developerIds) || empty($clientIds)) {
                throw new \RuntimeException('Не найдены пользователи с требуемыми ролями');
            }

            // Привязываем обязательных участников
            $project->users()->attach([
                $this->faker->randomElement($developerIds), // Случайный разработчик
                $this->faker->randomElement($clientIds),     // Случайный клиент
            ]);

            $clientIds = array_diff($clientIds, $project->users()->role('client')->get()->pluck('id')->toArray());
            $developerIds = array_diff($developerIds, $project->users()->role('developer')->get()->pluck('id')->toArray());
            // Добавляем 0-2 дополнительных клиентов
            $additionalClients = $this->faker->randomElements(
                $clientIds,
                $this->faker->numberBetween(0, 2)
            );

            $additionalDevelopers = $this->faker->randomElements(
                $developerIds,
                $this->faker->numberBetween(0, 2)
            );

            $project->users()->attach($additionalDevelopers);
            $project->users()->attach($additionalClients);
        });
    }
}
