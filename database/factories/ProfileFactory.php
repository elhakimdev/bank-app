<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       => User::factory()->create()->id,
            'first_name'    => $this->faker->firstName(),
            'last_name'     => $this->faker->lastName(),
            'gender'        => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'address'       => $this->faker->address,
            'phone_number'  => $this->faker->phoneNumber,
        ];
    }
}
