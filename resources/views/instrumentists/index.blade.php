<x-layouts.app :title="'Registre — Angel’s Band'">

  {{-- Recherche + bouton Ajouter (admin only) --}}
  <div class="flex items-center justify-between gap-3 mb-4 flex-wrap">
    <form class="flex-1 min-w-[240px]" method="GET">
      <input
        class="p-3 rounded border w-full bg-white"
        name="q"
        value="{{ $q }}"
        placeholder="Rechercher (nom, téléphone, rôle, instrument)…"
      >
    </form>

    @auth
      @if(auth()->user()->is_admin)
        <a href="{{ route('instrumentists.create') }}"
           class="px-4 py-3 rounded bg-black text-white hover:bg-gray-900">
          + Ajouter
        </a>
      @endif
    @endauth
  </div>

  {{-- Liste --}}
  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($instrumentists as $m)

      @php
        // Initiales
        $initials = strtoupper(
          mb_substr($m->last_name ?? '', 0, 1) .
          mb_substr($m->first_name ?? '', 0, 1)
        );

        // Rôle (via table roles)
        $role = $m->role->name ?? 'Instrumentiste';

        $key = mb_strtolower(trim($role));
        $key = str_replace(
          ['é','è','ê','ë','à','â','î','ï','ô','ö','ù','û'],
          ['e','e','e','e','a','a','i','i','o','o','u','u'],
          $key
        );

        $roleColors = [
          'president' => 'bg-amber-600 text-white',
          'dt' => 'bg-blue-600 text-white',
          'dt adjoint' => 'bg-indigo-600 text-white',
          'dt alto' => 'bg-purple-600 text-white',
          'dt soprano' => 'bg-pink-600 text-white',
          'dt tenor' => 'bg-cyan-600 text-white',
          'dt basse' => 'bg-slate-700 text-white',
          'organisateur' => 'bg-emerald-600 text-white',
          'secretaire' => 'bg-orange-600 text-white',
          'tresoriere' => 'bg-green-600 text-white',
          'charge spirituel' => 'bg-rose-600 text-white',
        ];

        $badgeClass = $roleColors[$key] ?? 'bg-gray-600 text-white';

        // Instrument affiché (principal sinon premier)
        $primary = $m->instruments->firstWhere('pivot.is_primary', true);
        $first = $m->instruments->first();
        $displayInstrument = $primary ?? $first;
      @endphp

      <a href="{{ route('instrumentists.show', $m) }}"
         class="bg-white rounded-xl border p-4 hover:shadow transition">

        <div class="flex gap-3 items-center">

          {{-- Photo / initiales --}}
          @if($m->photo_path)
            <img class="w-14 h-14 rounded-full object-cover border"
                 src="{{ asset('storage/'.$m->photo_path) }}" alt="photo">
          @else
            <div class="w-14 h-14 rounded-full flex items-center justify-center bg-gray-200 text-gray-700 font-bold text-lg border">
              {{ $initials }}
            </div>
          @endif

          <div class="flex-1">
            {{-- Nom + badge rôle --}}
            <div class="flex items-center gap-2 flex-wrap">
              <div class="font-semibold">{{ $m->last_name }} {{ $m->first_name }}</div>

              @if($key !== 'instrumentiste')
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $badgeClass }}">
                  {{ $role }}
                </span>
              @else
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-white border text-gray-700">
                  Instrumentiste
                </span>
              @endif
            </div>

            {{-- Instrument --}}
            <div class="text-sm text-gray-600 mt-1">
              @if($displayInstrument)
                {{ $displayInstrument->name }} • {{ $displayInstrument->category }}
                
              @else
                Aucun instrument
              @endif
            </div>

            {{-- Tel --}}
            <div class="text-sm text-gray-600">{{ $m->phone }}</div>
          </div>

        </div>
      </a>

    @endforeach
  </div>

  <div class="mt-6">{{ $instrumentists->links() }}</div>

</x-layouts.app>
