@props(['message', 'formatTime'])
@php
use Carbon\Carbon;
@endphp

<div class="border rounded-xl shadow p-4 bg-white flex flex-col justify-between gap-2 mb-4">
    <div>
        <p class="text-sm text-gray-500 font-medium">E-mail / Téléphone :</p>
        <p class="text-base text-gray-800">{{ $message['emailOrPhone'] }}</p>
    </div>
    <div>
        <p class="text-sm text-gray-500 font-medium">Objet :</p>
        <p class="text-base text-gray-800">{{ $message['subject'] }}</p>
    </div>
    <div>
        <p class="text-sm text-gray-500 font-medium">Message :</p>
        <p class="text-base text-gray-800 break-words whitespace-pre-wrap truncate" title="{{ $message['content'] }}">{{ $message['content'] }}
        </p>
    </div>
    <div>
        <p class="text-sm text-gray-500 font-medium">Date :</p>
        <p class="text-base text-gray-800">
            {{ Carbon::parse($message['time'])->format('d/m/Y H:i') }}
        </p>
    </div>
    <div class="mt-2">
        <button
            class="btnDeleteMessage bg-red-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-red-700"
            data-id="{{ $message['id'] }}">
            Supprimer
        </button>
    </div>
</div>