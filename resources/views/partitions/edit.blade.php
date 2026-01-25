<x-layouts.app :title="'Modifier la partition'">
  <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 max-w-2xl mx-auto">
    <!-- En-tête -->
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
            <i class="fas fa-edit text-purple-600"></i>
          </div>
          Modifier la partition
        </h1>
        <p class="text-gray-600 mt-2">Mettez à jour les informations de cette partition</p>
      </div>
      <a href="{{ route('partitions.index') }}" 
         class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
        <i class="fas fa-arrow-left"></i>
        Retour
      </a>
    </div>

    <!-- Formulaire -->
    <form method="POST" action="{{ route('partitions.update', $partition) }}" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Nom -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-heading text-indigo-500 mr-2"></i>
          Nom de la partition
        </label>
        <input type="text" 
               name="nom" 
               value="{{ old('nom', $partition->nom) }}"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all"
               placeholder="Ex: Sonate au clair de lune"
               required>
        @error('nom')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Compositeur -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-user-tie text-purple-500 mr-2"></i>
          Compositeur
        </label>
        <input type="text" 
               name="compositeur" 
               value="{{ old('compositeur', $partition->compositeur) }}"
               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all"
               placeholder="Ex: Ludwig van Beethoven"
               required>
        @error('compositeur')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Fichier PDF (optionnel pour modification) -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-file-pdf text-red-500 mr-2"></i>
          Fichier PDF (optionnel)
        </label>
        
        <!-- Fichier actuel -->
        <div class="mb-4 p-4 bg-gray-50 rounded-lg">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                <i class="fas fa-file-pdf text-red-600"></i>
              </div>
              <div>
                <p class="font-medium text-gray-800">Fichier actuel</p>
                <p class="text-sm text-gray-600">
                  <a href="{{ route('partitions.download', $partition) }}" 
                     class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                    <i class="fas fa-download text-xs"></i>
                    Télécharger
                  </a>
                </p>
              </div>
            </div>
            <span class="text-sm text-gray-500">
              {{ $partition->created_at->format('d/m/Y') }}
            </span>
          </div>
        </div>

        <!-- Nouveau fichier -->
        <div class="mt-2">
          <input type="file" 
                 name="fichier" 
                 accept=".pdf"
                 class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-gray-300 hover:border-indigo-400 transition-colors">
          <p class="mt-2 text-sm text-gray-500">
            <i class="fas fa-info-circle text-blue-500 mr-1"></i>
            Laissez vide pour conserver le fichier actuel. Max: 10MB, PDF uniquement.
          </p>
          @error('fichier')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Boutons -->
      <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
        <button type="submit" 
                class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
          <i class="fas fa-save"></i>
          Enregistrer les modifications
        </button>
        
        <button type="button"
                onclick="confirmDelete()"
                class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-rose-500 text-white font-semibold hover:from-red-600 hover:to-rose-600 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
          <i class="fas fa-trash-alt"></i>
          Supprimer
        </button>
      </div>
    </form>

    <!-- Formulaire de suppression caché -->
    <form id="delete-form" method="POST" action="{{ route('partitions.destroy', $partition) }}" class="hidden">
      @csrf
      @method('DELETE')
    </form>
  </div>

  <!-- Script de confirmation -->
  <script>
    function confirmDelete() {
      Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action est irréversible ! La partition et son fichier PDF seront définitivement supprimés.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form').submit();
        }
      });
    }
  </script>
</x-layouts.app>