<?php

namespace Tvice\ContactList\Database\Factories;
use Tvice\ContactList\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numerify('+380#########'),
        ];
    }
}