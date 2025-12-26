<x-layouts.app :title="'Registre — Angel’s Band'">
  <form class="grid grid-cols-1 gap-3 mb-4" method="GET">
  <input
    class="p-3 rounded border w-full"
    name="q"
    value="{{ $q }}"
    placeholder="Rechercher (nom, téléphone)…"
  >
</form>


  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($instrumentists as $m)
      <a href="{{ route('instrumentists.show', $m) }}" class="bg-white rounded-xl border p-4 hover:shadow">
        <div class="flex gap-3 items-center">
         @php
  $initials = strtoupper(
      mb_substr($m->last_name, 0, 1) . mb_substr($m->first_name, 0, 1)
  );
@endphp

@if($m->photo_path)
  <img
    class="w-14 h-14 rounded-full object-cover border"
    src="{{ asset('storage/'.$m->photo_path) }}"
    alt="photo"
  >
@else
  <div
    class="w-14 h-14 rounded-full flex items-center justify-center
           bg-gray-200 text-gray-700 font-bold text-lg border">
    {{ $initials }}
  </div>
@endif

          <div>
            <div class="font-semibold">{{ $m->last_name }} {{ $m->first_name }}</div>
@php
  $primary = $m->instruments->firstWhere('pivot.is_primary', true);
  $first = $m->instruments->first();
  $displayInstrument = $primary ?? $first;
@endphp

<div class="text-sm text-gray-600">
  @if($displayInstrument)
    {{ $displayInstrument->name }} • {{ $displayInstrument->category }}
    @if($primary)
      <span class="ml-2 text-xs px-2 py-0.5 rounded bg-black text-white">Principal</span>
    @endif
  @else
    Aucun instrument
  @endif
</div>
            <div class="text-sm text-gray-600">{{ $m->phone }}</div>
          </div>
        </div>
      </a>
    @endforeach
  </div>

  <div class="mt-6">{{ $instrumentists->links() }}</div>
</x-layouts.app>
