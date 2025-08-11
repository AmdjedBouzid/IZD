@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact #{{ $contact->id }}</h1>

    @include('contacts._messages')

    <p><strong>Value:</strong> {{ $contact->value }}</p>
    <p><strong>Platform:</strong> {{ $contact->platform }}</p>

    <a href="{{ route('contacts.edit', $contact) }}">Edit</a> |
    <a href="{{ route('contacts.index') }}">Back</a>
</div>
@endsection
