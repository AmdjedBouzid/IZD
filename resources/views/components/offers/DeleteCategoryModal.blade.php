<div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-center text-red-600">
            Confirmer la suppression
        </h2>
        <p class="text-gray-700 text-center mb-6">
            Êtes-vous sûr de vouloir supprimer cette catégorie ?
        </p>
        <form action="#" method="POST" class="flex justify-between gap-4">
            @csrf
            @method('DELETE')
            <button type="button"
                class="flex-1 py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">
                Annuler
            </button>
            <button type="submit"
                class="flex-1 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold">
                Supprimer
            </button>
        </form>
    </div>
</div>