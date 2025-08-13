@extends('layouts.admin')
@section('title', 'Companies')

@section('content')
<div class="container">
    <h1>Create Contact</h1>

    @include('contacts._messages')

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div>
            <label>Value</label>
            <input type="text" name="value" value="{{ old('value') }}" required>
            @error('value') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>


        <div class="form-group">
            <label for="platform">Contact Platform</label>
            <select name="platform" id="platform" class="form-control" required>
                <option value="">-- Select Platform --</option>
                <option value="location">Location</option>
                <option value="phone">Phone</option>
                <option value="email">Email</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="telegram">Telegram</option>
                <option value="linkedin">LinkedIn</option>
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="twitter">Twitter / X</option>
                <option value="website">Website</option>
            </select>
            @error('platform') <div style="color:red">{{ $message }}</div> @enderror
        </div>


        <button type="submit">Save</button>
    </form>
</div>
@endsection
