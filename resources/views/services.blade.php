@extends('layouts.admin')
@section('title', 'Services')

@section('content')

<section class="p-8 space-y-10 bg-white rounded-xl shadow-md max-sm:p-0">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold text-primary">Services</h2>
        <button id="btnAddService"
            class="px-6 py-2 rounded-full bg-primary text-white hover:bg-primary/90 transition">
            ➕ Ajouter un service
        </button>
    </div>

    {{-- Filter --}}
    <div class="flex justify-end">
        <select id="companyFilter"
            class="border rounded px-4 py-2 text-sm bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="ALL">Toutes les entreprise</option>
            @foreach ($companies as $company)
            <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
            @endforeach
        </select>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border shadow-sm">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead class="bg-primary text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="p-4">Titre</th>
                    <th class="p-4">Entreprise</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Image</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="servicesTable" class="bg-white">
                @foreach ($services as $service)
                <tr data-company-id="{{ $service['company_id'] }}" data-service-id="{{ $service['id'] }}" class="border-b last:border-none hover:bg-gray-50 transition">
                    <td class="p-4 align-top font-medium text-gray-800">{{ $service['title'] }}</td>
                    <td class="p-4 align-top text-gray-700">{{ $service['company']->name }}</td>
                    <td class="p-4 align-top text-gray-600 whitespace-pre-wrap break-words w-40 sm:w-auto">
                        {{ $service['description'] }}
                    </td>
                    <td class="p-4 align-top">
                        @if($service->image_path)
                        <img src="{{ Storage::url($service->image_path) }}" alt="" class="w-24 h-16 object-cover rounded border">
                        @else
                        <span class="inline-flex w-24 h-16 bg-gray-100 border rounded items-center justify-center text-gray-400 text-xs font-medium">pas d'image</span>
                        @endif
                    </td>
                    <td class="p-4 align-top text-center">
                        <div class="flex justify-center items-center gap-2 flex-wrap">
                            <button class="btnUpdate px-4 py-1 rounded bg-primary text-white hover:bg-primary/90 transition">
                                Mise à jour
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
<div id="addServiceModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Ajouter un service</h3>
        <form class="space-y-4" id="addServiceForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input type="text" name="title" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Entreprise</label>
                <select name="company_id" class="border rounded px-3 py-2 w-full" required>
                    @foreach ($companies as $company)
                    <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" class="border rounded px-3 py-2 w-full" rows="4"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                <input type="file" name="image_path" accept="image/*" class="border rounded px-3 py-2 w-full">
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
<div id="updateServiceModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
        <h3 class="text-xl font-bold mb-4">Service de mise à jour</h3>
        <form id="updateServiceForm" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="updateServiceId">
            <div>
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input type="text" name="title" id="updateServiceTitle" class="border rounded px-3 py-2 w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Entreprise</label>
                <select name="company_id" id="updateServiceCompany" class="border rounded px-3 py-2 w-full" required>
                    @foreach ($companies as $company)
                    <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" id="updateServiceDescription" class="border rounded px-3 py-2 w-full" rows="4"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                <input type="file" name="image_path" accept="image/*" class="border rounded px-3 py-2 w-full">
                <img id="updateImagePreview" class="mt-2 w-24 h-16 object-cover rounded border hidden" src="{{$company['image'] ?? '/images/default.jpg'}}" alt="Image Preview">
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
        <p>Êtes-vous sûr de vouloir supprimer ce service ?</p>
        <form id="deleteServiceForm" action="" method="POST" >
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="btnCloseDeleteModal" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                    Annuler
                </button>
                <button type="submit" id="btnConfirmDelete" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addModal = document.getElementById("addServiceModal");
        const updateModal = document.getElementById("updateServiceModal");
        const deleteModal = document.getElementById("deleteModal");
        const companyFilter = document.getElementById("companyFilter");
        const servicesTable = document.getElementById("servicesTable");

        // Filter
        companyFilter.addEventListener("change", function() {
            const selected = this.value;
            servicesTable.querySelectorAll("tr").forEach(row => {
                row.style.display = (selected === "ALL" || row.dataset.companyId === selected) ? "" : "none";
            });
        });

        // Open Add Modal
        document.getElementById("btnAddService").addEventListener("click", function() {
            document.getElementById("addServiceForm").reset();
            //----------------------------------------------------------------------------------------------------------
            document.getElementById("addServiceForm").action = "{{ route('services.store') }}"; 
            //----------------------------------------------------------------------------------------------------------
            addModal.classList.remove("hidden");
            addModal.classList.add("flex");
        });

        // Open Update Modal
        document.querySelectorAll(".btnUpdate").forEach((btn) => {
    btn.addEventListener("click", function() {
        const row = this.closest("tr");
        const serviceId = row.getAttribute("data-service-id"); // get real ID from data attribute
        console.log('serviceId:', serviceId);

        // Fill form fields
        document.getElementById("updateServiceId").value = serviceId;
        document.getElementById("updateServiceTitle").value = row.cells[0].textContent.trim();
        document.getElementById("updateServiceCompany").value = row.dataset.companyId;
        document.getElementById("updateServiceDescription").value = row.cells[2].textContent.trim();

        // Preview image safely
        const preview = document.getElementById("updateImagePreview");
        const imgElement = row.querySelector("img");
        if (imgElement) {
            preview.src = imgElement.src;
            preview.classList.remove("hidden");
        } else {
            preview.classList.add("hidden");
        }

        // Update form action URL (no extra quotes)
        document.getElementById("updateServiceForm").action =
            "{{ route('services.update', ':id') }}".replace(':id', serviceId);

        // Show modal
        const updateModal = document.getElementById("updateServiceModal");
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
        document.querySelectorAll(".btnDelete").forEach((btn, index) => {
            btn.addEventListener("click", function() {
                const row = this.closest("tr");
                const serviceId = row.getAttribute("data-service-id");
                console.log('serviceId:', serviceId);

                const deleteForm = document.getElementById("deleteServiceForm");
                //----------------------------------------------------------------------------------------------------------
                deleteForm.action = `{{ route('services.destroy', ':id') }}`.replace(':id', serviceId);
                //----------------------------------------------------------------------------------------------------------

                const deleteModal = document.getElementById("deleteModal");
                deleteModal.classList.remove("hidden");
                deleteModal.classList.add("flex");
            });
        });

        // Close  Delete Modal
        document.getElementById("btnCloseDeleteModal").addEventListener("click", function() {
            deleteModal.classList.add("hidden");
            deleteModal.classList.remove("flex");
        });

    });
</script>

@endsection