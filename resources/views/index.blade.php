@extends('contact-list::layouts.contact-list')
@section('content')
    <div class="container">
        <form action="{{ route('contacts.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-2">
                <div class="col">
                    <input name="first_name" type="text" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
                </div>
                <div class="col">
                    <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required>
                </div>
            </div>
            <div id="phones">
                @foreach($phones as $idx => $phone)
                    <div class="input-group mb-2">
                        <input name="phones[]" type="text" class="form-control" placeholder="Phone" value="{{ $phone }}" required>
                        @if(count($phones) > 1)
                            <button type="submit" name="remove_phone" value="{{ $idx }}" class="btn btn-danger">-</button>
                        @endif
                    </div>
                @endforeach
            </div>
            <button class="btn btn-secondary me-2" type="submit" name="add_phone">+</button>
            <button class="btn btn-primary" type="submit">Add</button>
        </form>
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phones</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->first_name }}</td>
                    <td>{{ $contact->last_name }}</td>
                    <td>
                        <ul class="mb-0">
                            @foreach($contact->phones as $phone)
                                <li>{{ $phone->number }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
@endsection