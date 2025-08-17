@extends('layouts.admin')
@section('content')
@if(!empty($success))
    <x-toast-success :message="$success" />
@endif
@if(session()->has('error'))
    <x-toast-error message="{{ session('error') }}" />
@endif
<x-offers.header :categories="$categories" :selectedCategoryId="$selectedCategoryId" />
<x-offers.categories :categories="$categories" :selectedCategoryId="$selectedCategoryId" />
<x-offers.selectButtons />

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pb-3">
    @foreach ($images as $image)
    <x-offers.image :image="$image" />
    @endforeach
</div>
@error('name')
<x-toast-error message="{{ $message }}" />
@enderror
<x-offers.deleteImagesModal :selectedCategoryId="$selectedCategoryId" />
<x-offers.deleteCategoryModal />

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toDeleteIds = [];


        const deselectAllButton = document.getElementById('deselectAllButton');
        const selectAllButton = document.getElementById('selectAllButton');

        const imageContainers = document.querySelectorAll('.relative.group');

        function updateButtons() {
            // Case 1: All selected → Show "Deselect All"
            if (toDeleteIds.length === imageContainers.length && imageContainers.length > 0) {
                selectAllButton.classList.add('hidden');
                deselectAllButton.classList.remove('hidden');
            }
            // Case 2: None selected or no images → Hide both
            else if (toDeleteIds.length === 0 || imageContainers.length === 0) {
                selectAllButton.classList.add('hidden');
                deselectAllButton.classList.add('hidden');
            }
            // Case 3: Partial selection → Show both
            else {
                selectAllButton.classList.remove('hidden');
                deselectAllButton.classList.remove('hidden');
            }

            // Show delete button only if something is selected
            if (toDeleteIds.length > 0) {
                deleteImagesButton.classList.remove('hidden');
            } else {
                deleteImagesButton.classList.add('hidden');
            }
        }


        function selectImage(container, id) {
            const checkbox = container.querySelector('input[type="checkbox"][data-id]');
            const overlay = container.querySelector('div.absolute.inset-0');
            if (!checkbox.checked) {
                checkbox.checked = true;
                if (!toDeleteIds.includes(id)) toDeleteIds.push(id);
                if (overlay) overlay.style.display = 'block';
            }
        }

        function deselectImage(container, id) {
            const checkbox = container.querySelector('input[type="checkbox"][data-id]');
            const overlay = container.querySelector('div.absolute.inset-0');
            if (checkbox.checked) {
                checkbox.checked = false;
                const index = toDeleteIds.indexOf(id);
                if (index > -1) toDeleteIds.splice(index, 1);
                if (overlay) overlay.style.display = 'none';
            }
        }

        imageContainers.forEach(container => {
            const checkbox = container.querySelector('input[type="checkbox"][data-id]');
            const overlay = container.querySelector('div.absolute.inset-0');
            const id = checkbox.dataset.id;

            // Initialize overlay display based on checkbox state (if checked by default)
            if (checkbox.checked && overlay) {
                overlay.style.display = 'block';
                if (!toDeleteIds.includes(id)) toDeleteIds.push(id);
            } else if (overlay) {
                overlay.style.display = 'none';
            }

            // Toggle selection when clicking anywhere on the container
            container.addEventListener('click', function(e) {
                if (e.target === checkbox) return;
                checkbox.checked = !checkbox.checked;

                if (checkbox.checked) {
                    if (!toDeleteIds.includes(id)) toDeleteIds.push(id);
                    if (overlay) overlay.style.display = 'block';
                } else {
                    const index = toDeleteIds.indexOf(id);
                    if (index > -1) toDeleteIds.splice(index, 1);
                    if (overlay) overlay.style.display = 'none';
                }

                updateButtons();
                console.log('Selected IDs:', toDeleteIds);
            });

            // Handle direct checkbox change
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (!toDeleteIds.includes(id)) toDeleteIds.push(id);
                    if (overlay) overlay.style.display = 'block';
                } else {
                    const index = toDeleteIds.indexOf(id);
                    if (index > -1) toDeleteIds.splice(index, 1);
                    if (overlay) overlay.style.display = 'none';
                }
                updateButtons();
                console.log('Selected IDs:', toDeleteIds);
            });
        });

        // Select all button
        selectAllButton.addEventListener('click', () => {
            imageContainers.forEach(container => {
                const checkbox = container.querySelector('input[type="checkbox"][data-id]');
                const id = checkbox.dataset.id;
                selectImage(container, id);
            });
            updateButtons();
            console.log('Selected IDs after Select All:', toDeleteIds);
        });

        // Deselect all button
        deselectAllButton.addEventListener('click', () => {
            imageContainers.forEach(container => {
                const checkbox = container.querySelector('input[type="checkbox"][data-id]');
                const id = checkbox.dataset.id;
                deselectImage(container, id);
            });
            updateButtons();
            console.log('Selected IDs after Deselect All:', toDeleteIds);
        });

        updateButtons();

        function openModal(ids) {
            document.getElementById('idsInput').value = JSON.stringify(ids);
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // makes it visible
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex'); // removes display flex
        }

        // when you click your "delete" button in page
        document.getElementById('deleteImagesButton').addEventListener('click', () => {
            console.log('Delete button clicked with IDs:', toDeleteIds);
            openModal(toDeleteIds); // here you pass selected IDs
        });

        // when you click "cancel" button in modal
        document.getElementById('cancelDeleteImagesBtn')
            .addEventListener('click', closeModal);
    });


    function openDeleteModal(id) {
        const modal = document.getElementById('deleteCategoryModal');
        const form = document.getElementById('deleteCategoryForm');

        form.action = `/admin/offres/categories/${id}`;
        modal.classList.remove('hidden');
    }

    function closeDeleteCategoryModal() {
        document.getElementById('deleteCategoryModal').classList.add('hidden');
    }

    const deleteButtons = document.querySelectorAll('.deleteCategoryBtn');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const categoryId = this.dataset.categoryId;

            openDeleteModal(categoryId);
        });
    });



    const categoryItems = document.querySelectorAll(".category-item");
    const selectedInput = document.getElementById("selectedCategoryId");

    categoryItems.forEach(item => {
        item.addEventListener("click", function() {
            // Remove "selected" styles from all categories
            categoryItems.forEach(c => {
                c.classList.remove("bg-blue-500", "text-white");
                c.classList.add("bg-gray-100", "hover:bg-gray-200");
            });

            // Add "selected" styles to clicked category
            this.classList.remove("bg-gray-100", "hover:bg-gray-200");
            this.classList.add("bg-blue-500", "text-white");

            // Update hidden input with selected category ID
            selectedInput.value = this.dataset.categoryId;
        });


        //---------------------------------------- Image Upload Handling ---------------------------------------------------
        document.addEventListener("DOMContentLoaded", function() {
            const addImageBtn = document.getElementById("addImageBtn");
            const imageInput = document.getElementById("imageInput");
            const imageForm = document.getElementById("imageUploadForm");

            if (!addImageBtn || !imageInput || !imageForm) return;

            // Remove any previous event listeners (safety)
            addImageBtn.replaceWith(addImageBtn.cloneNode(true));
            imageInput.replaceWith(imageInput.cloneNode(true));

            const newAddImageBtn = document.getElementById("addImageBtn");
            const newImageInput = document.getElementById("imageInput");

            // Open file picker
            newAddImageBtn.addEventListener("click", () => {
                newImageInput.click();
            }, {
                once: false
            });

            // Auto-submit form when a file is selected
            newImageInput.addEventListener("change", () => {
                if (newImageInput.files.length > 0) {
                    imageForm.submit();
                }
            });
        });

        //---------------------------------------------------------------------------------------------------------------------------------------
    });
</script>
@endsection