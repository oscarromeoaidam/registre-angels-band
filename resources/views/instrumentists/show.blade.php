<x-layouts.app :title="'Fiche instrumentiste'">
  <div class="bg-white border rounded-xl p-6 max-w-4xl">
    <div class="flex flex-col md:flex-row gap-6 items-start">
      @php
  $initials = strtoupper(
      mb_substr($instrumentist->last_name, 0, 1) .
      mb_substr($instrumentist->first_name, 0, 1)
  );
@endphp

@if($instrumentist->photo_path)
  <img
    class="w-32 h-32 rounded-xl object-cover border"
    src="{{ asset('storage/'.$instrumentist->photo_path) }}"
    alt="photo"
  >
@else
  <div
    class="w-32 h-32 rounded-xl flex items-center justify-center
           bg-gray-200 text-gray-700 font-bold text-4xl border">
    {{ $initials }}
  </div>
@endif


      <div class="flex-1">
        <div class="flex items-start justify-between gap-4">
          <div>
            <h2 class="text-2xl font-bold">
              {{ $instrumentist->last_name }} {{ $instrumentist->first_name }}
            </h2>
            @if($instrumentist->nickname)
              <p class="text-gray-600 mt-1">Surnom : {{ $instrumentist->nickname }}</p>
            @endif
@php
  $primary = $instrumentist->instruments->firstWhere('pivot.is_primary', true);
  $first = $instrumentist->instruments->first();
  $displayInstrument = $primary ?? $first;
@endphp

<p class="text-gray-600 mt-1">
  @if($displayInstrument)
    {{ $displayInstrument->name }} • {{ $displayInstrument->category }}
    @if($primary)
      <span class="ml-2 text-xs px-2 py-0.5 rounded bg-black text-white">Principal</span>
    @endif
  @else
    Aucun instrument
  @endif
</p>
          </div>

          <div class="flex gap-2">
            <a class="px-4 py-2 rounded bg-white border"
               href="{{ route('instrumentists.edit', $instrumentist) }}">Modifier</a>

            <form method="POST" action="{{ route('instrumentists.destroy', $instrumentist) }}"
                  onsubmit="return confirm('Supprimer cet instrumentiste ?');">
              @csrf
              @method('DELETE')
              <button class="px-4 py-2 rounded bg-red-600 text-white">Supprimer</button>
            </form>
          </div>
        </div>
@php
  $role = $instrumentist->role->name ?? 'Instrumentiste';

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
@endphp

<div class="flex items-center gap-2 flex-wrap mt-2">
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

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="p-4 rounded border bg-gray-50">
            <div class="text-sm text-gray-600">Sexe</div>
            <div class="font-semibold">{{ $instrumentist->sex === 'M' ? 'Masculin' : 'Féminin' }}</div>
          </div>

          <div class="p-4 rounded border bg-gray-50">
            <div class="text-sm text-gray-600">Âge</div>
            <div class="font-semibold">{{ $instrumentist->age }} ans</div>
          </div>

          <div class="p-4 rounded border bg-gray-50">
            <div class="text-sm text-gray-600">Date de naissance</div>
            <div class="font-semibold">{{ $instrumentist->birth_date->format('d/m/Y') }}</div>
          </div>

          <div class="p-4 rounded border bg-gray-50">
            <div class="text-sm text-gray-600">Téléphone</div>
            <div class="font-semibold">{{ $instrumentist->phone }}</div>
          </div>

          <div class="p-4 rounded border bg-gray-50 md:col-span-2">
            <div class="text-sm text-gray-600">Lieu de résidence / Quartier</div>
            <div class="font-semibold">{{ $instrumentist->residence }}</div>
          </div>
          <div class="p-4 rounded border bg-gray-50 md:col-span-2">
  <div class="text-sm text-gray-600">Instruments</div>
  <div class="font-semibold">
    @foreach($instrumentist->instruments as $ins)
      <span class="inline-flex items-center px-2 py-1 mr-2 mb-2 rounded bg-white border">
        {{ $ins->name }}
        @if($ins->pivot->is_primary)
          <span class="ml-2 text-xs px-2 py-0.5 rounded bg-black text-white">Principal</span>
        @endif
      </span>
    @endforeach
  </div>
</div>


        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
