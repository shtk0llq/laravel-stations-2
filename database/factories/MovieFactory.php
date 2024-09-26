<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->year,
            'description' => $this->faker->realText(20),
            'is_showing' => $this->faker->boolean,
            'genre_id' => $this->getGenreId(),
        ];
    }

    /**
     * Get a genre ID, sometimes using an existing one if available.
     *
     * @return int
     */
    protected function getGenreId()
    {
        // 既存のジャンルの数を取得
        $existingGenresCount = Genre::count();

        // 既存のジャンルがあり、50%の確率で既存のジャンルを使用
        if ($existingGenresCount > 0 && $this->faker->boolean(50)) {
            return Genre::inRandomOrder()->first()->id;
        }

        // 新しいジャンルを作成
        return Genre::factory()->create()->id;
    }
}
