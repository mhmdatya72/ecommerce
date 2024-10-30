<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'image'=> $this->faker->imageUrl,
            'price'=> $this->faker->randomFloat(2,1,450),
            'compare_price'=> $this->faker->randomFloat(2,500,999),
           'store_id' => Store::factory(),
            'category_id' => Category::factory(),
            'feature'=> rand(0,1),
            'options' => json_encode(['color' => 'red', 'size' => 'M']), // خيارات (يمكن تعديلها حسب الحاجة)
            'rating' => $this->faker->randomFloat(1, 0, 5), // تقييم المنتج
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),

        ];
    }
}
