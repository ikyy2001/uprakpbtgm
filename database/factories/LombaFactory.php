<?php

namespace Database\Factories;

use App\Models\Lomba;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lomba>
 */
class LombaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lomba' => fake()->sentence(3),
            'deskripsi' => fake()->paragraph(),
            'batas_kuota_maksimal' => fake()->numberBetween(5, 30),
        ];
    }
}
