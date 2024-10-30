<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $d =$this->faker->name;
        return [
            'name' => $d,
            'slug'=> Str::slug($d),
            'description'=> $this->faker->sentence(15),
            'logo_image'=> $this->faker->imageUrl,
            'cover_image'=> $this->faker->imageUrl,
            'status' => $this->faker->randomElement(['active', 'inactive']),

        ];
    }
}