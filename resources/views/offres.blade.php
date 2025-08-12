@extends('layouts.admin')
@section('content')

@php
$categories = [
(object)['id' => 1, 'name' => 'Electronique'],
(object)['id' => 2, 'name' => 'Mode'],
(object)['id' => 3, 'name' => 'Maison'],
];
$selectedCategory = (object)['id' => 2, 'name' => 'Mode'];

$images = [
(object)['id' => 1, 'url' => '/banner1.jpg' , 'category_id' => 2],
(object)['id' => 2, 'url' => '/banner2.jpg', 'category_id' => 2],
(object)['id' => 3, 'url' => '/banner3.jpg', 'category_id' => 3],
(object)['id' => 4, 'url' => '/banner3.jpg', 'category_id' => 3],
];
@endphp
<x-offers.header />
<x-offers.categories :categories="$categories" />
<x-offers.selectButtons />

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    @foreach ($images as $image)
    <x-offers.image :image="$image" />
    @endforeach
</div>
<x-offers.deleteImagesModal />

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toDeleteIds = [];

        const deselectAllButton = document.getElementById('deselectAllButton');
        const selectAllButton = document.getElementById('selectAllButton');

        const imageContainers = document.querySelectorAll('.relative.group');

        function updateButtons() {
            // Show "Deselect All" if at least one selected, else show "Select All"
            if (toDeleteIds.length === imageContainers.length) {
                selectAllButton.classList.add('hidden');
                deselectAllButton.classList.remove('hidden');
            } else if (toDeleteIds.length === 0) {
                selectAllButton.classList.remove('hidden');
                deselectAllButton.classList.add('hidden');
            } else {
                // Partial selection - show both? or just show deselect? Here I show both disabled:
                selectAllButton.classList.remove('hidden');
                deselectAllButton.classList.remove('hidden');
            }

            if (toDeleteIds.length > 0) {
                document.getElementById('deleteImagesButton').classList.remove('hidden');
            } else {
                document.getElementById('deleteImagesButton').classList.add('hidden');
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
</script>
@endsection