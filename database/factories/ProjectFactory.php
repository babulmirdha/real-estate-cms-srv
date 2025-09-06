<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types   = ['Residential', 'Commercial'];
        $status  = ['Ready', 'Under Construction'];
        $cities  = ['Dhaka', 'Chattogram', 'Khulna', 'Sylhet', 'Rajshahi'];
        $areas   = [
            'Gulshan', 'Banani', 'Uttara', 'Dhanmondi', 'Mohammadpur',
            'Agrabad', 'Pahartali', 'Sholokbahar', 'Zindabazar', 'Mirpur'
        ];
        $amenities = ['Lift', 'Parking', 'Security', 'Gym', 'Swimming Pool', 'Community Hall', 'Generator'];

        $bedrooms = $this->faker->numberBetween(2, 6);
        $size     = $this->faker->numberBetween(900, 3500); // in sqft
        $price    = $size * $this->faker->numberBetween(2000, 3500); // simple rate per sqft

        $lat = $this->faker->latitude(23.7, 24.0);   // around Dhaka
        $lng = $this->faker->longitude(90.3, 90.5);

        return [
            'title'       => $this->faker->company . ' ' . $this->faker->randomElement(['Heights', 'Residency', 'Plaza', 'Tower']),
            'type'        => $this->faker->randomElement($types),
            'status'      => $this->faker->randomElement($status),
            'area'        => $this->faker->randomElement($areas),
            'city'        => $this->faker->randomElement($cities),

            'bedrooms'    => $bedrooms,
            'size_sqft'   => $size,
            'price'       => $price,

            'lat'         => $lat,
            'lng'         => $lng,

            'images'      => [
                $this->faker->imageUrl(900, 600, 'real-estate', true),
                $this->faker->imageUrl(900, 600, 'building', true),
                $this->faker->imageUrl(900, 600, 'apartment', true),
            ],
            'amenities'   => $this->faker->randomElements($amenities, rand(3, 6)),

            'video_url'   => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'description' => $this->faker->paragraph(3),
            'is_published'=> $this->faker->boolean(80), // 80% published
        ];
    }
}
