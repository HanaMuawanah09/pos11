<?php

namespace Database\Factories;

use App\Models\Jenis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jenis>
 */
class JenisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
        ];
    }
}
