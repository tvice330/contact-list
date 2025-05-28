<?php

namespace Tvice\ContactList\Services;

use Tvice\ContactList\Models\Contact;

class ContactService
{

    public function getPaginatedContacts($perPage = 10)
    {
        return Contact::with('phones')->paginate($perPage);
    }

    public function createContact($data)
    {
        $contact = Contact::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
        ]);
        foreach ($data['phones'] as $number) {
            $contact->phones()->create(['number' => $number]);
        }
        return $contact->load('phones');
    }
}