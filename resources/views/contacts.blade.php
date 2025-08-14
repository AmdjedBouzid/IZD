@extends('layouts.admin')
@section('title', 'Contacts')

@section('content')

<section class="p-8 space-y-10 bg-white rounded-xl shadow-md max-sm:p-0">

    {{-- En-tête --}}
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold text-primary">Contacts</h2>
        <button id="btnAddContact"
            class="px-6 py-2 rounded-full bg-primary text-white hover:bg-primary/90 transition">
            ➕ Ajouter un contact
        </button>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto rounded-lg border shadow-sm">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-primary text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="p-4">Plateforme</th>
                    <th class="p-4">Nom</th>
                    <th class="p-4">Valeur</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="contactsTable" class="bg-white">
                @foreach ($contacts as $contact)
                <tr data-contact-id="{{ $contact->id }}" class="border-b last:border-none hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800">{{ ucfirst($contact->platform) }}</td>
                    <td class="p-4">{{ $contact->name }}</td>
                    <td class="p-4">{{ $contact->value }}</td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center items-center gap-2 flex-wrap">
                            <button class="btnUpdate px-4 py-1 rounded bg-primary text-white hover:bg-primary/90 transition">
                                Modifier
                            </button>
                            <button class="btnDelete px-4 py-1 rounded bg-red-500 text-white hover:bg-red-600 transition">
                                Supprimer
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

{{-- Modal Ajouter --}}

<div id="addContactModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Ajouter un contact</h3>
        <form class="space-y-4" id="addContactForm" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Plateforme</label>
                <select name="platform" id="platformSelect" class="border rounded px-3 py-2 w-full" required>
                    <option value="email">Email</option>
                    <option value="phone">Téléphone</option>
                    <option value="location">Localisation</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="telegram">Telegram</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                    <option value="website">Site web</option>
                </select>
            </div>

            {{-- NOTE for location --}}
            <div id="locationNote" class="hidden p-3 mt-2 bg-yellow-100 text-yellow-800 text-sm rounded-md border border-yellow-300">
                💡 <strong>Astuce :</strong> Pour la localisation, vous pouvez coller :
                <ul class="list-disc pl-5 mt-1">
                    <li>Un lien Google Maps complet (ex: <code>https://maps.google.com/...</code>) -Recommandé- </li>
                    <li>Ou simplement l'adresse (ex: <em>Tour Eiffel, Paris</em>)</li>
                </ul>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input placeholder="Exemple: Assistance 24/7" type="text" name="name" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Valeur</label>
                <input placeholder="Exemple: +213 512 34 56 78" type="text" name="value" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" class="btnCloseModal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary/90">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Modifier --}}
<div id="updateContactModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Modifier le contact</h3>
        <form id="updateContactForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="updateContactId">
            <div>
                <label class="block text-sm font-medium mb-1">Plateforme</label>
                <select name="platform" id="updateContactPlatform" class="border rounded px-3 py-2 w-full" required>
                    <option value="location">Localisation</option>
                    <option value="phone">Téléphone</option>
                    <option value="email">Email</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="telegram">Telegram</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                    <option value="website">Site web</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="name" id="updateContactName" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Valeur</label>
                <input type="text" name="value" id="updateContactValue" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" class="btnCloseModal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary/90">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Suppression --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
        <h3 class="text-lg font-bold mb-4">Confirmer la suppression</h3>
        <p>Êtes-vous sûr de vouloir supprimer ce contact ?</p>
        <form id="deleteContactForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="btnCloseDeleteModal" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addModal = document.getElementById("addContactModal");
    const updateModal = document.getElementById("updateContactModal");
    const deleteModal = document.getElementById("deleteModal");

    // Ouvrir ajout
    document.getElementById("btnAddContact").addEventListener("click", function() {
        document.getElementById("addContactForm").reset();
        addModal.classList.remove("hidden");
        addModal.classList.add("flex");
    });

    // Ouvrir modification
    document.querySelectorAll(".btnUpdate").forEach((btn) => {
        btn.addEventListener("click", function() {
            const row = this.closest("tr");
            const id = row.getAttribute("data-contact-id");
            const platform = row.cells[0].textContent.trim();
            const name = row.cells[1].textContent.trim();
            const value = row.cells[2].textContent.trim();

            document.getElementById("updateContactId").value = id;
            document.getElementById("updateContactPlatform").value = platform.toLowerCase();
            document.getElementById("updateContactName").value = name;
            document.getElementById("updateContactValue").value = value;

            document.getElementById("updateContactForm").action =
                "{{ route('contacts.update', ':id') }}".replace(':id', id);

            updateModal.classList.remove("hidden");
            updateModal.classList.add("flex");
        });
    });

    // Fermer modals ajout/modif
    document.querySelectorAll(".btnCloseModal").forEach(btn => {
        const note = document.getElementById('locationNote');
        btn.addEventListener("click", function() {
            note.classList.add('hidden');
            addModal.classList.add("hidden");
            addModal.classList.remove("flex");
            updateModal.classList.add("hidden");
            updateModal.classList.remove("flex");
        });
    });

    // Suppression
    document.querySelectorAll(".btnDelete").forEach((btn) => {
        btn.addEventListener("click", function() {
            const row = this.closest("tr");
            const id = row.getAttribute("data-contact-id");

            const deleteForm = document.getElementById("deleteContactForm");
            deleteForm.action = "{{ route('contacts.destroy', ':id') }}".replace(':id', id);

            deleteModal.classList.remove("hidden");
            deleteModal.classList.add("flex");
        });
    });

    // Fermer suppression
    document.getElementById("btnCloseDeleteModal").addEventListener("click", function() {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("flex");
    });
});

// Show note when 'Localisation' is selected
document.getElementById('platformSelect').addEventListener('change', function() {
    const note = document.getElementById('locationNote');
    if (this.value === 'location') {
        note.classList.remove('hidden');
    } else {
        note.classList.add('hidden');
    }
});

</script>

@endsection
