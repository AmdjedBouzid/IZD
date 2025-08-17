@extends('layouts.app')
@section('title', 'Service Details')

@section('content')
<div class="min-h-screen px-4 py-12 md:px-12 bg-gray-50 ">
    @if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 md:p-12 flex flex-col md:flex-row gap-8 items-center">

        {{-- Image --}}
        <div class="w-full md:w-1/2 overflow-hidden rounded-2xl shadow-md ring-4 ring-[var(--color-secondary)]/10">
            <img
              src="{{ Storage::url($service->image_path) }}"
                alt="{{ $service->title }}"
                class="w-full h-full object-cover rounded-2xl"
            >
        </div>

        {{-- Details --}}
        <div class="w-full md:w-1/2">
            <h1
                class="text-3xl font-bold mb-4 uppercase
                @if(strtoupper($service->company->name) === 'IZDFIRE')
                    text-red-600 animate-pulse
                @else
                    text-[var(--color-primary)]
                @endif
                "
            >
                {{ $service->title }}
            </h1>

            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                {{ $service->description }}
            </p>

            <a
                href="{{ url('/') }}"
                class="px-6 py-3 rounded-lg font-semibold transition-colors duration-200 cursor-pointer text-white
                @if(strtoupper($service->company->name) === 'IZDFIRE')
                    bg-red-600 hover:bg-red-700 animate-pulse
                @else
                    bg-[var(--color-secondary)] hover:bg-[var(--color-primary)]
                @endif
                "
            >
                ← Retour
            </a>
        </div>

    </div>
</div>

@endsection