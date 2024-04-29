<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\region>
 */
class regionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['A', 'I', 'trash'];
        return [
            "description" => Str::random(20),// faker->paragraph(2),
            'status'=> 'A'
        ];
    }
}
