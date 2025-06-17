<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stage>
 */
class StageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory()->create(),
            'name' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'start' => CarbonImmutable::now(),
            'finish' => CarbonImmutable::now()->addWeek(),
            'price' => $this->faker->randomNumber(2, true),
        ];
    }
}
