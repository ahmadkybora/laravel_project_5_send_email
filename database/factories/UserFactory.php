<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'username' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->phoneNumber('201-886-0269 x3767'),
            'home_phone' => $this->faker->phoneNumber('201-886-0269 x3767'),
            'work_phone' => $this->faker->phoneNumber('201-886-0269 x3767'),
            'work_address' => $this->faker->sentence(),
            'home_address' => $this->faker->sentence(),
            'password' => Hash::make(12345678),
            'remember_token' => Str::random(10),
            'status' => 'ACTIVE',
            'information' => '',
            'image' => ''
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
