<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\commune>
 */
class communeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $status = ['A', 'I', 'trash'];
        $r = array_rand($status, 1);
        return [
            'id_reg' => rand(1,5),
            'description' => 'Commune 1 in North Region',
            'status'=> 'A'
        ];
    }
}
