@extends('layouts.app')

@section('content')
@php
// Temporary hardcoded messages, later to be fetched from controller
$messages = [
['id' => 1, 'emailOrPhone' => 'user1@example.com', 'subject' => 'Question', 'content' => 'Hello, I need help.', 'time' => '2025-08-11 10:00:00'],
['id' => 2, 'emailOrPhone' => 'user2@example.com', 'subject' => 'Support', 'content' => 'I have an issue with my order.', 'time' => '2025-08-11 11:15:00'],
['id' => 3, 'emailOrPhone' => 'user3@example.com', 'subject' => 'Feedback', 'content' => 'Great service, thanks!', 'time' => '2025-08-11 12:30:00'],
];

@endphp

<div class="container mx-auto px-4 mt-8 max-w-5xl">
    <h1 class="text-2xl font-bold mb-6">Messages</h1>

    @forelse ($messages as $msg)
    @component('components.messages.message', ['message' => $msg])
    @endcomponent
    @empty
    <p class="text-gray-500">Aucun message trouvé.</p>
    @endforelse
</div>

<!-- Confirmation Modal -->
<div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
        <h2 class="text-xl font-semibold mb-4">Confirmer la suppression</h2>
        <p class="mb-6">Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.</p>
        <div class="flex justify-center gap-4">
            <button id="cancelDeleteBtn" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Annuler</button>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirmDeleteModal');
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const deleteForm = document.getElementById('deleteForm');

        // Attach event to all delete buttons
        document.querySelectorAll('.btnDeleteMessage').forEach(btn => {
            btn.addEventListener('click', function() {
                const messageId = this.dataset.id;
                //----------------------------------------------------------------------------------------------------------
                deleteForm.action = `/messages/${messageId}`; // Adjust route as needed
                //----------------------------------------------------------------------------------------------------------
                modal.classList.remove('hidden');
            });
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    });
</script>
@endsection