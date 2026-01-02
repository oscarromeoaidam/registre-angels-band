<x-layouts.app>

@section('content')
  {{-- KPI Section --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-5 text-white">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm opacity-90">Total Membres</p>
          <p class="text-2xl font-bold mt-1">{{ $totalMembers ?? App\Models\Instrumentist::count() }}</p>
        </div>
        <div class="bg-blue-400/30 p-3 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.137a4 4 0 00-5.413-5.413"/>
          </svg>
        </div>
      </div>
      <div class="text-xs mt-2 opacity-80">Tous les membres</div>
    </div>

    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-5 text-white">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm opacity-90">Bureau</p>
          <p class="text-2xl font-bold mt-1">{{ $leadershipCount ?? 0 }}</p>
        </div>
        <div class="bg-emerald-400/30 p-3 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
      </div>
      <div class="text-xs mt-2 opacity-80">Rôles de direction</div>
    </div>


    <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg p-5 text-white">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm opacity-90">Nouveaux</p>
          <p class="text-2xl font-bold mt-1">{{ $newMembersThisMonth ?? 0 }}</p>
        </div>
        <div class="bg-amber-400/30 p-3 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <div class="text-xs mt-2 opacity-80">Ce mois-ci</div>
    </div>
  </div>

  {{-- Header avec recherche et filtres --}}
  <div class="bg-white rounded-xl shadow border p-5 mb-6">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
      <div class="flex-1">
        <!-- <h2 class="text-xl font-semibold text-gray-800">Liste des Membres</h2>
        <p class="text-sm text-gray-600 mt-1">Gérez tous les membres de l'orchestre</p> -->
      </div>
      
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
        {{-- Filtres rapides --}}
        <div class="flex gap-2 overflow-x-auto pb-2 sm:pb-0">
          <button onclick="filterBy('')" class="px-3 py-2 text-sm rounded-lg border hover:bg-gray-50 transition whitespace-nowrap">
            Tous
          </button>
          @foreach(['Président', 'DT ', 'DT Adjoint', 'trésorière', 'Organisateur'] as $filterRole)
            <button onclick="filterByRole('{{ $filterRole }}')" class="px-3 py-2 text-sm rounded-lg border hover:bg-gray-50 transition whitespace-nowrap">
              {{ $filterRole }}
            </button>
          @endforeach
        </div>

        {{-- Recherche avancée --}}
        <form class="relative" method="GET">
          <div class="relative">
            <input
              class="pl-10 pr-4 py-2.5 rounded-lg border w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
              name="q"
              value="{{ $q }}"
              placeholder="Rechercher un membre..."
            >
            <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </form>

        {{-- Bouton Ajouter --}}
        @if(auth()->check() && auth()->user()->is_admin)
          <a href="{{ route('instrumentists.create') }}" 
             class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2.5 rounded-lg hover:shadow-lg transition-all duration-200 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter
          </a>
        @endif
        {{-- Connexion / Déconnexion --}}
  @auth
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="px-3 py-2 rounded border hover:bg-gray-100">
        Déconnexion
      </button>
    </form>
  @else
    <a href="{{ route('login') }}" class="px-3 py-2 rounded border hover:bg-gray-100">
      Connexion admin
    </a>
  @endauth

</div>
      </div>
    </div>

    {{-- Statistiques rapides --}}
  </div>

  {{-- Liste des membres avec design amélioré --}}
  <div class="bg-white rounded-xl shadow border overflow-hidden mb-6">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gray-50 border-b">
            <th class="text-left p-4 font-medium text-gray-700">Membre</th>
            <th class="text-left p-4 font-medium text-gray-700">Rôle</th>
            <th class="text-left p-4 font-medium text-gray-700">Instrument</th>
            <th class="text-left p-4 font-medium text-gray-700">Contact</th>
            <th class="text-left p-4 font-medium text-gray-700">Résidence</th>
            <th class="text-left p-4 font-medium text-gray-700">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @foreach($instrumentists as $m)
            @php
              $initials = strtoupper(
                mb_substr($m->last_name ?? '', 0, 1) .
                mb_substr($m->first_name ?? '', 0, 1)
              );

              $role = $m->role->name ?? 'Instrumentiste';
              $key = mb_strtolower(trim($role));
              $key = str_replace(
                ['é','è','ê','ë','à','â','î','ï','ô','ö','ù','û'],
                ['e','e','e','e','a','a','i','i','o','o','u','u'],
                $key
              );

              $roleColors = [
                'president' => 'bg-amber-100 text-amber-800 border border-amber-200',
                'dt principal' => 'bg-blue-100 text-blue-800 border border-blue-200',
                'dt adjoint' => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
                'dt alto' => 'bg-purple-100 text-purple-800 border border-purple-200',
                'dt soprano' => 'bg-pink-100 text-pink-800 border border-pink-200',
                'dt tenor' => 'bg-cyan-100 text-cyan-800 border border-cyan-200',
                'dt basse' => 'bg-slate-100 text-slate-800 border border-slate-200',
                'organisateur' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                'secretaire' => 'bg-orange-100 text-orange-800 border border-orange-200',
                'tresoriere' => 'bg-green-100 text-green-800 border border-green-200',
                'chargé spirituel' => 'bg-rose-100 text-rose-800 border border-rose-200',
              ];

              $badgeClass = $roleColors[$key] ?? 'bg-gray-100 text-gray-800 border border-gray-200';

              $primary = $m->instruments->firstWhere('pivot.is_primary', true);
              $first = $m->instruments->first();
              $displayInstrument = $primary ?? $first;
            @endphp

            <tr class="hover:bg-gray-50/50 transition-colors">
              <td class="p-4">
                <a href="{{ route('instrumentists.show', $m) }}" class="flex items-center gap-3 group">
                  @if($m->photo_path)
                    <img class="w-10 h-10 rounded-full object-cover border-2 border-white shadow"
                         src="{{ asset('storage/'.$m->photo_path) }}" alt="photo">
                  @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 text-gray-700 font-bold border-2 border-white shadow">
                      {{ $initials }}
                    </div>
                  @endif
                  <div>
                    <div class="font-medium text-gray-900 group-hover:text-blue-600 transition">
                      {{ $m->last_name }} {{ $m->first_name }}
                      @if($m->nickname)
                        <span class="text-gray-500 text-sm">"{{ $m->nickname }}"</span>
                      @endif
                    </div>
                    <div class="text-sm text-gray-500">{{ $m->sex == 'M' ? 'Homme' : 'Femme' }}</div>
                  </div>
                </a>
              </td>
              
              <td class="p-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
                  {{ $role }}
                </span>
              </td>
              
              <td class="p-4">
                @if($displayInstrument)
                  <div class="flex items-center gap-2">
                    @php
                      $categoryColors = [
                        'Soprano' => 'bg-pink-100 text-pink-600',
                        'Alto' => 'bg-purple-100 text-purple-600',
                        'Ténor' => 'bg-cyan-100 text-cyan-600',
                        'Basse' => 'bg-slate-100 text-slate-600'
                      ];
                      $catColor = $categoryColors[$displayInstrument->category] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <div class="w-8 h-8 rounded-lg {{ $catColor }} flex items-center justify-center">
                      <span class="text-sm font-semibold">
                        {{ substr($displayInstrument->category, 0, 1) }}
                      </span>
                    </div>
                    <div>
                      <div class="font-medium text-gray-900">{{ $displayInstrument->name }}</div>
                      <div class="text-xs text-gray-500">{{ $displayInstrument->category }}</div>
                    </div>
                  </div>
                @else
                  <span class="text-gray-400">—</span>
                @endif
              </td>
              
              <td class="p-4">
                <div class="text-gray-900 font-medium">{{ $m->phone }}</div>
                <div class="text-sm text-gray-500">{{ $m->birth_date->format('d/m/Y') }}</div>
              </td>
              
              <td class="p-4">
                <div class="text-gray-900">{{ $m->residence }}</div>
              </td>
              
              <td class="p-4">
                <div class="flex items-center gap-2">
                  <a href="{{ route('instrumentists.show', $m) }}" 
                     class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                     title="Voir">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </a>
                  @if(auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('instrumentists.edit', $m) }}" 
                       class="p-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                       title="Modifier">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                      </svg>
                    </a>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
      @if($instrumentists->isEmpty())
        <div class="text-center py-12">
          <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p class="mt-4 text-gray-500">Aucun membre trouvé</p>
        </div>
      @endif
    </div>

    {{-- Pagination --}}
    <div class="p-4 border-t">
      {{ $instrumentists->links() }}
    </div>
  </div>

  {{-- Pied de page avec statistiques --}}
  <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl border p-5">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
      <div>
        <h3 class="font-medium text-gray-800">Base de données des membres</h3>
        <p class="text-sm text-gray-600">Dernière mise à jour: {{ now()->format('d/m/Y H:i') }}</p>
      </div>
      <div class="text-sm text-gray-600 text-center sm:text-right">
        <div>Affichage de <span class="font-semibold">{{ $instrumentists->firstItem() ?? 0 }}</span> à <span class="font-semibold">{{ $instrumentists->lastItem() ?? 0 }}</span></div>
        <div>sur <span class="font-semibold">{{ $instrumentists->total() }}</span> membres</div>
      </div>
    </div>
  </div>

  <script>
    function filterByRole(role) {
      const url = new URL(window.location.href);
      url.searchParams.set('q', role);
      window.location.href = url.toString();
    }
    
    function filterBy(type) {
      // Pour filtres supplémentaires si besoin
      console.log('Filtrer par:', type);
    }
  </script>

  <style>
    @media (max-width: 768px) {
      table {
        font-size: 14px;
      }
      .p-4 {
        padding: 0.75rem;
      }
    }
  </style>

</x-layouts.app>
