<x-layouts.app :title="'Ajouter une partition'">
  <div class="bg-white border rounded-xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">➕ Ajouter une partition</h2>

    <form method="POST" action="{{ route('partitions.store') }}" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-medium mb-1">Nom de la partition</label>
        <input type="text" name="nom" placeholder="Ex: Sonate au clair de lune" 
               class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Compositeur</label>
        <input type="text" name="compositeur" placeholder="Ex: Ludwig van Beethoven" 
               class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Fichier PDF</label>
        <input type="file" name="fichier" accept=".pdf" 
               class="w-full p-3 border rounded" required>
        <p class="text-sm text-gray-500 mt-1">Taille maximum : 5MB. Format accepté : PDF uniquement.</p>
      </div>

      <div class="flex gap-2 pt-4">
        <button type="submit" class="px-4 py-2 rounded bg-black text-white hover:bg-gray-800">
          📤 Uploader la partition
        </button>
        <a href="{{ route('partitions.index') }}" class="px-4 py-2 rounded bg-gray-100 border hover:bg-gray-200">
          Annuler
        </a>
      </div>
    </form>
  </div>
</x-layouts.app>