<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 10),
            'firstname' => $this->faker->firstName,
            'lastname' =>  $this->faker->lastName,
            'address' =>  $this->faker->address,
            'phone' =>  $this->faker->phoneNumber,
        ];
    }
}
