<?php

namespace Tvice\ContactList\Http\Controllers;

use Tvice\ContactList\Http\Requests\StoreContactRequest;
use Tvice\ContactList\Services\ContactService;
use Tvice\ContactList\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class ContactController extends Controller
{
    protected $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $contacts = $this->service->getPaginatedContacts(10);
        $phones = $request->old('phones', ['']);

        if ($request->ajax()) {
            return response()->json(['contacts' => $contacts]);
        }

        if ($request->get('add_phone') !== null) {
            $phones[] = '';
        }

        if ($request->has('remove_phone')) {
            $remove = (int)$request->get('remove_phone');
            unset($phones[$remove]);
            $phones = array_values($phones);
        }

        return view('contact-list::index', compact('contacts', 'phones'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = $this->service->createContact($request->validated());

        return request()->ajax()
            ? response()->json(['contact' => $contact->load('phones')])
            : redirect()->back()->with('success', __('Added contact successfully.'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Contact deleted successfully!');
    }
}