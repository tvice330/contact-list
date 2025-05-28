<?php

namespace Tvice\ContactList\Database\Factories;
use Tvice\ContactList\Models\ContactPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactPhoneFactory extends Factory
{
    protected $model = ContactPhone::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numerify('+380#########'),
        ];
    }
}