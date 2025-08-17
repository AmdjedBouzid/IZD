@extends('layouts.admin')
@section('title', 'Companies')

@section('content')

<section class="p-8 space-y-10 bg-white rounded-xl shadow-md max-sm:p-0">
    @if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif
@if(session()->has('error'))
    <x-toast-error message="{{ session('error') }}" />
@endif
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold text-primary">Entreprises</h2>
        <button id="btnAddCompany"
            class="px-6 py-2 rounded-full bg-primary text-white hover:bg-primary/90 transition">
            ➕ Ajouter une entreprise
        </button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border shadow-sm">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-primary text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="p-4">Nom</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="companiesTable" class="bg-white">
                @foreach ($companies as $company)
                <tr data-company-id="{{ $company->id }}" class="border-b last:border-none hover:bg-gray-50 transition">
                    <td class="p-4 align-top font-medium text-gray-800">{{ $company->name }}</td>
                    <td class="p-4 align-top text-center">
                        <div class="flex justify-center items-center gap-2 flex-wrap">
                            <button class="btnUpdate px-4 py-1 rounded bg-primary text-white hover:bg-primary/90 transition">
                                Mettre à jour
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

{{-- Add Modal --}}
<div id="addCompanyModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Ajouter une entreprise</h3>
        <form class="space-y-4" id="addCompanyForm" method="POST" action="{{ route('companies.store') }}">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="name" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" class="btnCloseModal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary/90">
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Update Modal --}}
<div id="updateCompanyModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Mise à jour de l'entreprise</h3>
        <form id="updateCompanyForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="updateCompanyId">
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="name" id="updateCompanyName" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <button type="button" class="btnCloseModal px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary/90">
                    Mise à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
        <h3 class="text-lg font-bold mb-4">Confirmer la suppression</h3>
        <p>Êtes-vous sûr de vouloir supprimer cette entreprise ?</p>
        <form id="deleteCompanyForm" action="" method="POST">
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
    const addModal = document.getElementById("addCompanyModal");
    const updateModal = document.getElementById("updateCompanyModal");
    const deleteModal = document.getElementById("deleteModal");

    // Open Add Modal
    document.getElementById("btnAddCompany").addEventListener("click", function() {
        document.getElementById("addCompanyForm").reset();
        addModal.classList.remove("hidden");
        addModal.classList.add("flex");
    });

    // Open Update Modal
    document.querySelectorAll(".btnUpdate").forEach((btn) => {
        btn.addEventListener("click", function() {
            const row = this.closest("tr");
            const companyId = row.getAttribute("data-company-id");
            const companyName = row.cells[0].textContent.trim();

            document.getElementById("updateCompanyId").value = companyId;
            document.getElementById("updateCompanyName").value = companyName;

            document.getElementById("updateCompanyForm").action =
                "{{ route('companies.update', ':id') }}".replace(':id', companyId);

            updateModal.classList.remove("hidden");
            updateModal.classList.add("flex");
        });
    });

    // Close Add/Update Modals
    document.querySelectorAll(".btnCloseModal").forEach(btn => {
        btn.addEventListener("click", function() {
            addModal.classList.add("hidden");
            addModal.classList.remove("flex");
            updateModal.classList.add("hidden");
            updateModal.classList.remove("flex");
        });
    });

    // Delete Modal
    document.querySelectorAll(".btnDelete").forEach((btn) => {
        btn.addEventListener("click", function() {
            const row = this.closest("tr");
            const companyId = row.getAttribute("data-company-id");

            const deleteForm = document.getElementById("deleteCompanyForm");
            deleteForm.action = "{{ route('companies.destroy', ':id') }}".replace(':id', companyId);

            deleteModal.classList.remove("hidden");
            deleteModal.classList.add("flex");
        });
    });

    // Close Delete Modal
    document.getElementById("btnCloseDeleteModal").addEventListener("click", function() {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("flex");
    });
});
</script>

@endsection
