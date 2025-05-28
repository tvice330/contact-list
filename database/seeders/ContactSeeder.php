<?php

namespace Tvice\ContactList\Database\Seeders;

use Illuminate\Database\Seeder;
use Tvice\ContactList\Models\Contact;
use Tvice\ContactList\Models\ContactPhone;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::factory()
            ->count(15)
            ->create()
            ->each(function ($contact) {
                $contact->phones()->createMany(
                    ContactPhone::factory()
                        ->count(rand(1, 3))
                        ->make()
                        ->toArray()
                );
            });
    }
}