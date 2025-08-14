  <?php
  public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'title' => $this->faker->words(3, true), // título com 3 palavras
            'author_id' => Author::factory(),
            'category_id' => Category::factory(), // Agora usa a CategoryFactory
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
            'published_year' => $this->faker->year
            'published_year' => $this->faker->year,
        ];
    }
}