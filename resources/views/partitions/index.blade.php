<x-layouts.app :title="'Partitions musicales'">
  <div class="max-w-7xl mx-auto">
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
            <i class="fas fa-file-music text-purple-600 text-xl"></i>
          </div>
          Partitions musicales
        </h1>
        <p class="text-gray-600 mt-2">Téléchargez gratuitement les partitions disponibles</p>
      </div>
      
      <!-- Bouton d'ajout (admin) -->
      
    </div>

    <!-- Liste des partitions -->
    @if($partitions->isEmpty())
      <div class="text-center py-16 border-2 border-dashed border-gray-300 rounded-2xl bg-gradient-to-b from-gray-50 to-white">
        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
          <i class="fas fa-music text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune partition disponible</h3>
        <p class="text-gray-500 max-w-md mx-auto mb-6">
          Commencez par ajouter vos premières partitions musicales.
        </p>
        @auth
          @if(auth()->user()->is_admin)
            <a href="{{ route('partitions.create') }}" 
               class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl inline-flex items-center gap-2">
              <i class="fas fa-plus"></i>
              Ajouter ma première partition
            </a>
          @endif
        @endauth
      </div>
    @else
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($partitions as $partition)
          <div class="bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <!-- En-tête de la carte -->
            <div class="p-6">
              <!-- Icône et statut -->
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                  </div>
                  <div>
                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-indigo-100 text-indigo-800">
                      PDF
                    </span>
                    <p class="text-xs text-gray-500 mt-1">
                      {{ $partition->created_at->diffForHumans() }}
                    </p>
                  </div>
                </div>
                
                <!-- Menu actions (admin seulement) -->
                @auth
                  @if(auth()->user()->is_admin)
                    <div class="relative" x-data="{ open: false }">
                      <button @click="open = !open"
                              class="w-8 h-8 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-500 hover:text-gray-700">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      
                      <!-- Menu dropdown -->
                      <div x-show="open" 
                           @click.away="open = false"
                           class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 z-10 py-2"
                           style="display: none;">
                        <a href="{{ route('partitions.edit', $partition) }}"
                           class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                          <i class="fas fa-edit text-indigo-500"></i>
                          <span>Modifier</span>
                        </a>
                        
                        <form method="POST" action="{{ route('partitions.destroy', $partition) }}" 
                              onsubmit="return confirmDelete('{{ $partition->nom }}')" 
                              class="w-full">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                                  class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors text-left">
                            <i class="fas fa-trash-alt text-red-500"></i>
                            <span>Supprimer</span>
                          </button>
                        </form>
                      </div>
                    </div>
                  @endif
                @endauth
              </div>

              <!-- Titre -->
              <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                {{ $partition->nom }}
              </h3>
              
              <!-- Compositeur -->
              <div class="flex items-center gap-2 text-gray-600 mb-4">
                <i class="fas fa-user-tie text-purple-500"></i>
                <span class="text-sm">{{ $partition->compositeur }}</span>
              </div>

              <!-- Bouton télécharger -->
              <a href="{{ route('partitions.download', $partition) }}" 
                 class="block w-full text-center px-4 py-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium hover:from-green-600 hover:to-emerald-600 transition-all shadow-md hover:shadow-lg group-hover:scale-[1.02]">
                <div class="flex items-center justify-center gap-3">
                  <i class="fas fa-download"></i>
                  <span>Télécharger</span>
                </div>
                <p class="text-xs opacity-90 mt-1">Cliquez pour télécharger le PDF</p>
              </a>

              <!-- Actions rapides (admin) -->
              @auth
                @if(auth()->user()->is_admin)
                  <div class="flex gap-2 mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('partitions.edit', $partition) }}"
                       class="flex-1 text-center px-3 py-2 rounded-lg border border-indigo-200 text-indigo-700 hover:bg-indigo-50 transition-colors text-sm">
                      <i class="fas fa-edit mr-1"></i>
                      Modifier
                    </a>
                    <form method="POST" action="{{ route('partitions.destroy', $partition) }}" 
                          onsubmit="return confirmDelete('{{ $partition->nom }}')" 
                          class="flex-1">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="w-full px-3 py-2 rounded-lg border border-red-200 text-red-700 hover:bg-red-50 transition-colors text-sm">
                        <i class="fas fa-trash-alt mr-1"></i>
                        Supprimer
                      </button>
                    </form>
                  </div>
                @endif
              @endauth
            </div>
          </div>
        @endforeach
      </div>

      <!-- Statistiques -->
      <div class="mt-8 p-6 bg-gradient-to-r from-gray-50 to-white rounded-2xl border border-gray-200">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-indigo-100">
              <i class="fas fa-file-alt text-indigo-600 text-xl"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600">Total des partitions</p>
              <p class="text-2xl font-bold text-gray-800">{{ $partitions->count() }}</p>
            </div>
          </div>
          
          @auth
            @if(auth()->user()->is_admin)
              <a href="{{ route('partitions.create') }}" 
                 class="px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Ajouter une autre partition
              </a>
            @endif
          @endauth
        </div>
      </div>
    @endif
  </div>

  <!-- Script de confirmation -->
  <script>
    function confirmDelete(partitionName) {
      return confirm(`Êtes-vous sûr de vouloir supprimer la partition "${partitionName}" ?\nCette action est irréversible.`);
    }
  </script>
  
  <!-- Ajoute SweetAlert2 pour de belles confirmations -->
  @auth
    @if(auth()->user()->is_admin)
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Intercepter les formulaires de suppression
          document.querySelectorAll('form[onsubmit*="confirmDelete"]').forEach(form => {
            form.onsubmit = function(e) {
              e.preventDefault();
              const partitionName = this.querySelector('button[type="submit"]')?.dataset?.name || 
                                   'cette partition';
              
              Swal.fire({
                title: 'Supprimer la partition ?',
                html: `Êtes-vous sûr de vouloir supprimer <strong>"${partitionName}"</strong> ?<br>
                      <span class="text-red-600">Cette action est irréversible !</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                backdrop: true
              }).then((result) => {
                if (result.isConfirmed) {
                  this.submit();
                }
              });
              
              return false;
            };
          });
        });
      </script>
    @endif
  @endauth
</x-layouts.app>