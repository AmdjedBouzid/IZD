@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Contact</h1>

    @include('contacts._messages')

    <form action="{{ route('contacts.update', $contact) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Value</label>
            <input type="text" name="value" value="{{ old('value', $contact->value) }}" required>
            @error('value') <div style="color:red">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $contact->name) }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="platform">Platform</label>
            <select name="platform" id="platform" required>
                <option value="">-- Select Platform --</option>
                @php
                    $platforms = [
                        'location' => 'Location',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'whatsapp' => 'WhatsApp',
                        'telegram' => 'Telegram',
                        'linkedin' => 'LinkedIn',
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'twitter' => 'Twitter / X',
                        'website' => 'Website'
                    ];
                @endphp
                @foreach($platforms as $value => $label)
                    <option value="{{ $value }}" {{ old('platform', $contact->platform) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('platform')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>



        <button type="submit">Update</button>
    </form>
</div>
@endsection
