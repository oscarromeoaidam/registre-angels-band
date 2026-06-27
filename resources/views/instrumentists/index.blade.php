<x-layouts.app>

  {{-- Section Hero avec titre élégant --}}
  <div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Régistre Orchestral</h1>
    <p class="text-gray-600">Fanfare Angel's band</p>
    <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mt-4"></div>
  </div>

  {{-- KPI Section avec plus d'indicateurs --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
      <div class="flex items-start justify-between">
        <div>
          <p class="text-sm opacity-90 mb-2 font-light">Total Membres</p>
          <p class="text-3xl font-bold mt-1">{{ $totalMembers ?? App\Models\Instrumentist::count() }}</p>
        </div>
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.137a4 4 0 00-5.413-5.413"/>
          </svg>

        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-white/20">
        <div class="text-xs opacity-80 flex items-center gap-1">
          <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                    <span>Tous les membres</span>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
      <div class="flex items-start justify-between">
        <div>
          <p class="text-sm opacity-90 mb-2 font-light">Bureau </p>
          <p class="text-3xl font-bold mt-1">{{ $leadershipCount ?? 0 }}</p>
        </div>
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-white/20">
        <div class="text-xs opacity-80 flex items-center gap-1">
          <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
          <span>Rôles de direction</span>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
      <div class="flex items-start justify-between">
        <div>
          <p class="text-sm opacity-90 mb-2 font-light">Partitions</p>
          <p class="text-3xl font-bold mt-1">{{ $totalSheets ?? App\Models\Partition::count() }}</p>
        </div>
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
          </svg>
        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-white/20">
        <div class="text-xs opacity-80 flex items-center gap-1">
          <span class="w-2 h-2 bg-orange-400 rounded-full"></span>
          <span>Répertoire musical</span>
        </div>
      </div>
    </div>

    {{-- Deux nouveaux KPI ajoutés --}}
    <div class="bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
      <div class="flex items-start justify-between">
        <div>
          <p class="text-sm opacity-90 mb-2 font-light">Femmes</p>
          <p class="text-3xl font-bold mt-1">{{ $femaleCount ?? App\Models\Instrumentist::where('sex', 'F')->count() }}</p>
        </div>
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
          </svg>
        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-white/20">
        <div class="text-xs opacity-80 flex items-center gap-1">
          <span class="w-2 h-2 bg-pink-400 rounded-full"></span>
          <span>{{ round(($femaleCount ?? 0) / ($totalMembers ?: 1) * 100, 1) }}% de l'effectif</span>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-cyan-500 via-cyan-600 to-cyan-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
      <div class="flex items-start justify-between">
        <div>
          <p class="text-sm opacity-90 mb-2 font-light">Hommes</p>
          <p class="text-3xl font-bold mt-1">{{ $maleCount ?? App\Models\Instrumentist::where('sex', 'M')->count() }}</p>
        </div>
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-white/20">
        <div class="text-xs opacity-80 flex items-center gap-1">
          <span class="w-2 h-2 bg-cyan-400 rounded-full"></span>
          <span>{{ round(($maleCount ?? 0) / ($totalMembers ?: 1) * 100, 1) }}% de l'effectif</span>
        </div>
      </div>
    </div>
  </div>

  {{-- VOTRE CONTENU EXISTANT COMPLET --}}
  {{-- Header avec recherche et filtres --}}
  <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
      <div class="flex-1">
        <!-- <h2 class="text-xl font-semibold text-gray-800">Liste des Membres</h2>
        <p class="text-sm text-gray-600 mt-1">Gérez tous les membres de l'orchestre</p> -->
      </div>
      
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
        {{-- Filtres rapides --}}
        <div class="flex gap-2 overflow-x-auto pb-2 sm:pb-0">
          
          @foreach(['Président', 'DT ', 'DT Adjoint', 'trésorière', 'Organisateur'] as $filterRole)
            <button onclick="filterByRole('{{ $filterRole }}')" class="px-4 py-2.5 text-sm rounded-lg border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 whitespace-nowrap font-medium text-gray-700">
              {{ $filterRole }}
            </button>
          @endforeach
        </div>

        {{-- Recherche avancée --}}
        <form class="relative" method="GET">
          <div class="relative">
            <input
              class="pl-12 pr-4 py-3 rounded-xl border border-gray-200 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50/50"
              name="q"
              value="{{ $q }}"
              placeholder="Rechercher un membre..."
            >
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </form>

        {{-- Export (conserve la recherche/filtres actuels) --}}
        <div class="relative">
          <button onclick="document.getElementById('export-menu').classList.toggle('hidden')" type="button"
             class="px-5 py-3 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 flex items-center gap-2 font-medium text-gray-700 whitespace-nowrap"
             title="Exporter la liste affichée">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"/>
            </svg>
            <span>Exporter</span>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div id="export-menu"
               class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-20">
            <a href="{{ route('instrumentists.export', request()->query()) }}"
               class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 text-gray-700 text-sm font-medium">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2a4 4 0 014-4h2m-6 6h6m-6-6V7a2 2 0 012-2h6l4 4v10a2 2 0 01-2 2H9a2 2 0 01-2-2v-1"/>
              </svg>
              CSV (.csv)
            </a>
            <a href="{{ route('instrumentists.export-excel', request()->query()) }}"
               class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 text-gray-700 text-sm font-medium border-t border-gray-100">
              <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2a4 4 0 014-4h2m-6 6h6m-6-6V7a2 2 0 012-2h6l4 4v10a2 2 0 01-2 2H9a2 2 0 01-2-2v-1"/>
              </svg>
              Excel (.xlsx)
            </a>
            <a href="{{ route('instrumentists.export-pdf', request()->query()) }}"
               class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 text-gray-700 text-sm font-medium border-t border-gray-100">
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2a4 4 0 014-4h2m-6 6h6m-6-6V7a2 2 0 012-2h6l4 4v10a2 2 0 01-2 2H9a2 2 0 01-2-2v-1"/>
              </svg>
              Rapport PDF (.pdf)
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- Liste des membres avec design amélioré --}}
  <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
    {{-- En-tête de table avec options --}}
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
      <div class="flex items-center justify-between">
        <h3 class="font-semibold text-gray-800">Liste des membres</h3>
        <div class="flex items-center gap-3">
          
          <div class="relative">
            <select class="appearance-none pl-4 pr-8 py-2 rounded-lg border border-gray-200 bg-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
              <option>15 par page</option>
              
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gray-50/80 border-b border-gray-100">
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <span>Membre</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
              </div>
            </th>
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <span>Rôle</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
              </div>
            </th>
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <span>Instrument</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
              </div>
            </th>
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Contact</th>
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Résidence</th>
            <th class="text-left p-6 font-semibold text-gray-700 text-sm uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
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
    'president'        => 'bg-gradient-to-r from-amber-100 to-amber-50 text-amber-900 border border-amber-300',
    'dt principal'     => 'bg-gradient-to-r from-blue-100 to-blue-50 text-blue-900 border border-blue-300',
    'dt adjoint'       => 'bg-gradient-to-r from-indigo-100 to-indigo-50 text-indigo-900 border border-indigo-300',
    'dt alto'          => 'bg-gradient-to-r from-purple-100 to-purple-50 text-purple-900 border border-purple-300',
    'dt soprano'       => 'bg-gradient-to-r from-pink-100 to-pink-50 text-pink-900 border border-pink-300',
    'dt tenor'         => 'bg-gradient-to-r from-teal-100 to-teal-50 text-teal-900 border border-teal-300',
    'dt basse'         => 'bg-gradient-to-r from-stone-100 to-stone-50 text-stone-900 border border-stone-300',
    'organisateur'     => 'bg-gradient-to-r from-emerald-100 to-emerald-50 text-emerald-900 border border-emerald-300',
    'secretaire'       => 'bg-gradient-to-r from-amber-200 to-amber-100 text-amber-950 border border-amber-400',
    'tresoriere'       => 'bg-gradient-to-r from-green-100 to-green-50 text-green-900 border border-green-300',
    'chargé spirituel' => 'bg-gradient-to-r from-rose-100 to-rose-50 text-rose-900 border border-rose-300',
    'conseiller'       => 'bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-900 border border-yellow-300',
];

              $badgeClass = $roleColors[$key] ?? 'bg-gray-100 text-gray-800 border border-gray-200';

              $primary = $m->instruments->firstWhere('pivot.is_primary', true);
              $first = $m->instruments->first();
              $displayInstrument = $primary ?? $first;
            @endphp

            <tr class="hover:bg-gray-50/50 transition-all duration-200 group">
              <td class="p-6">
                <a href="{{ route('instrumentists.show', $m) }}" class="flex items-center gap-4 group-hover:translate-x-1 transition-transform duration-200">
                  @if($m->photo_path)
                    <div class="relative">
                      <img class="w-12 h-12 rounded-xl object-cover border-2 border-white shadow-md"
                           src="{{ $m->photo_path }}" alt="photo">
                      <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white 
                        {{ $m->sex == 'M' ? 'bg-blue-400' : 'bg-pink-400' }}">
                      </div>
                    </div>
                  @else
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-gray-700 font-bold border-2 border-white shadow-md group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-200">
                      {{ $initials }}
                    </div>
                  @endif
                  <div>
                    <div class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                      {{ $m->last_name }} {{ $m->first_name }}
                      @if($m->nickname)
                        <span class="text-gray-500 text-sm font-normal">"{{ $m->nickname }}"</span>
                      @endif
                    </div>
                    <div class="text-sm text-gray-500 flex items-center gap-2 mt-1">
                      <span class="px-2 py-0.5 rounded-full text-xs {{ $m->sex == 'M' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                        {{ $m->sex == 'M' ? 'Homme' : 'Femme' }}
                      </span>
                      <span>•</span>
                      <span>{{ $m->age ?? 'N/A' }} ans</span>
                    </div>
                  </div>
                </a>
              </td>
              
              <td class="p-6">
                <div class="flex flex-col gap-2">
                  <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold {{ $badgeClass }} transition-all duration-200 hover:shadow-sm">
                    {{ $role }}
                  </span>
                  @if($m->date_joined)
                    <span class="text-xs text-gray-500">Depuis {{ $m->date_joined->format('m/Y') }}</span>
                  @endif
                </div>
              </td>
              
              <td class="p-6">
                @if($displayInstrument)
                  <div class="flex items-center gap-3">
                    @php
                      $categoryColors = [
                        'Soprano' => 'bg-gradient-to-br from-pink-100 to-pink-200 text-pink-700',
                        'Alto' => 'bg-gradient-to-br from-purple-100 to-purple-200 text-purple-700',
                        'Ténor' => 'bg-gradient-to-br from-cyan-100 to-cyan-200 text-cyan-700',
                        'Basse' => 'bg-gradient-to-br from-slate-100 to-slate-200 text-slate-700'
                      ];
                      $catColor = $categoryColors[$displayInstrument->category] ?? 'bg-gradient-to-br from-gray-100 to-gray-200 text-gray-700';
                    @endphp
                    <div class="w-10 h-10 rounded-lg {{ $catColor }} flex items-center justify-center shadow-sm">
                      <span class="text-sm font-bold">
                        {{ substr($displayInstrument->category, 0, 1) }}
                      </span>
                    </div>
                    <div>
                      <div class="font-medium text-gray-900">{{ $displayInstrument->name }}</div>
                      <div class="text-xs text-gray-500">{{ $displayInstrument->category }}</div>
                    </div>
                  </div>
                @else
                  <span class="text-gray-400 italic">Aucun instrument</span>
                @endif
              </td>
              
              <td class="p-6">
                <div class="space-y-1">
                  <div class="flex items-center gap-2 text-gray-900 font-medium">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $m->phone }}
                  </div>
                  <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $m->birth_date->format('d/m/Y') }}
                  </div>
                  @if($m->email)
                    <div class="text-xs text-gray-400 truncate max-w-[150px]">{{ $m->email }}</div>
                  @endif
                </div>
              </td>
              
              <td class="p-6">
                <div class="space-y-1">
                  <div class="text-gray-900 font-medium">{{ $m->residence }}</div>
                  @if($m->birth_place)
                    <div class="text-xs text-gray-500">Né(e) à {{ $m->birth_place }}</div>
                  @endif
                </div>
              </td>
              
              <td class="p-6">
  <div class="flex items-center gap-2">
    <a href="{{ route('instrumentists.show', $m) }}" 
       class="p-2.5 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-200 group/action"
       title="Voir le profil">
      <svg class="w-5 h-5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
      </svg>
    </a>
    @if(auth()->check() && auth()->user()->is_admin)
      <a href="{{ route('instrumentists.edit', $m) }}" 
         class="p-2.5 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200 group/action"
         title="Modifier">
        <svg class="w-5 h-5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
      </a>
      
      {{-- FORMULAIRE DE SUPPRESSION --}}
      <form action="{{ route('instrumentists.destroy', $m) }}" method="POST" class="inline" 
            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $m->first_name }} {{ $m->last_name }} ?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="p-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200 group/action"
                title="Supprimer">
          <svg class="w-5 h-5 group-hover/action:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
          </svg>
        </button>
      </form>
    @endif
  </div>
</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
      @if($instrumentists->isEmpty())
        <div class="text-center py-16">
          <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <h4 class="text-lg font-medium text-gray-700 mb-2">Aucun membre trouvé</h4>
          <p class="text-gray-500 mb-6">Essayez de modifier vos critères de recherche</p>
          <button onclick="window.location.href='{{ route('instrumentists.create') }}'" 
                  class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all duration-200 font-medium">
            Ajouter le premier membre
          </button>
        </div>
      @endif
    </div>

    {{-- Pagination améliorée --}}
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-600">
          Affichage de <span class="font-semibold text-gray-900">{{ $instrumentists->firstItem() ?? 0 }}</span> à 
          <span class="font-semibold text-gray-900">{{ $instrumentists->lastItem() ?? 0 }}</span> sur 
          <span class="font-semibold text-gray-900">{{ $instrumentists->total() }}</span> membres
        </div>
        {{ $instrumentists->links() }}
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-600">Lignes par page:</span>
          <select class="text-sm px-3 py-1.5 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
            <option selected>15</option>
            <option >25</option>
            <option>50</option>
            <option>100</option>
          </select>
        </div>
      </div>
    </div>
  </div>


  {{-- Pied de page enrichi --}}
  <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-xl p-8 text-white">
    <div class="flex flex-col md:flex-row items-center justify-between gap-8">
      <div class="flex-1">
        <h3 class="text-xl font-bold mb-3">Base de données des membres</h3>
        <p class="text-gray-300 mb-4">Système de gestion complet des membres de l'orchestre avec statistiques avancées et outils d'administration.</p>
        <div class="flex items-center gap-4 text-sm text-gray-400">
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            <span>Système actif</span>
          </div>
          <div>•</div>
          <div>Dernière mise à jour: {{ now()->format('d/m/Y à H:i') }}</div>
          <div>•</div>
          <div>Version 2.1.0</div>
        </div>
      </div>
      <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-sm">
        <div class="text-center">
          <div class="text-3xl font-bold mb-2">{{ $instrumentists->total() }}</div>
          <div class="text-gray-300 text-sm">Membres au total</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function filterByRole(role) {
      const url = new URL(window.location.href);
      url.searchParams.set('q', role);
      window.location.href = url.toString();
    }

    // Fermer le menu d'export si on clique en dehors
    document.addEventListener('click', function (e) {
      const menu = document.getElementById('export-menu');
      if (!menu) return;
      const button = e.target.closest('button');
      const clickedInsideMenu = menu.contains(e.target);
      const clickedButton = button && button.getAttribute('onclick') && button.getAttribute('onclick').includes('export-menu');
      if (!clickedInsideMenu && !clickedButton) {
        menu.classList.add('hidden');
      }
    });
    
    function filterBy(type) {
      console.log('Filtrer par:', type);
    }

    // Animation pour les cartes KPI
    document.addEventListener('DOMContentLoaded', function() {
      const kpiCards = document.querySelectorAll('[class*="bg-gradient-to-br"]');
      kpiCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
          card.style.transform = 'translateY(-2px)';
        });
        card.addEventListener('mouseleave', () => {
          card.style.transform = 'translateY(0)';
        });
      });
    });

    // Gestion des sélections multiples
    let selectedMembers = new Set();
    
    function toggleMemberSelection(id) {
      if (selectedMembers.has(id)) {
        selectedMembers.delete(id);
      } else {
        selectedMembers.add(id);
      }
      updateSelectionCounter();
    }
    
    function updateSelectionCounter() {
      const counter = document.getElementById('selection-counter');
      if (counter) {
        counter.textContent = selectedMembers.size;
      }
    }
  </script>

  <style>
    @media (max-width: 768px) {
      table {
        font-size: 14px;
      }
      .p-6 {
        padding: 1rem;
      }
      .text-3xl {
        font-size: 1.75rem;
      }
      .grid-cols-5 {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 640px) {
      .grid-cols-5 {
        grid-template-columns: 1fr;
      }
      .p-6 {
        padding: 0.75rem;
      }
    }
    
    /* Animations subtiles */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
      animation: fadeIn 0.3s ease-out;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>

</x-layouts.app>
