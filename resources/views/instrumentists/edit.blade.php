<x-layouts.app :title="'Modifier instrumentiste'">
  <div class="bg-white border rounded-xl p-6 max-w-3xl">
    <h2 class="text-xl font-semibold">Modifier</h2>

    <form class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4"
          method="POST"
          action="{{ route('instrumentists.update', $instrumentist) }}"
          enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="md:col-span-2 flex items-center gap-4">
        <img class="w-20 h-20 rounded-xl object-cover border"
             src="{{ $instrumentist->photo_path ? asset('storage/'.$instrumentist->photo_path) : 'https://via.placeholder.com/100' }}"
             alt="photo">
        <div class="flex-1">
          <label class="block text-sm font-medium mb-1">Changer la photo</label>
          <input type="file" name="photo" accept="image/*" class="w-full p-2 border rounded">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Nom</label>
        <input name="last_name" value="{{ old('last_name', $instrumentist->last_name) }}" class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Prénoms</label>
        <input name="first_name" value="{{ old('first_name', $instrumentist->first_name) }}" class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Surnom</label>
        <input name="nickname" value="{{ old('nickname', $instrumentist->nickname) }}" class="w-full p-3 border rounded">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Sexe</label>
        <select name="sex" class="w-full p-3 border rounded" required>
          <option value="M" @selected(old('sex', $instrumentist->sex)==='M')>Masculin</option>
          <option value="F" @selected(old('sex', $instrumentist->sex)==='F')>Féminin</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Date de naissance</label>
        <input type="date" name="birth_date"
               value="{{ old('birth_date', $instrumentist->birth_date->format('Y-m-d')) }}"
               class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Lieu de résidence / Quartier</label>
        <input name="residence" value="{{ old('residence', $instrumentist->residence) }}" class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Numéro de téléphone</label>
        <input name="phone" value="{{ old('phone', $instrumentist->phone) }}" class="w-full p-3 border rounded" required>
      </div>

      @php
  $selectedIds = old('instrument_ids', $instrumentist->instruments->pluck('id')->toArray());
  $primaryId = old(
      'primary_instrument_id',
      optional($instrumentist->instruments->firstWhere('pivot.is_primary', true))->id
      ?? optional($instrumentist->instruments->first())->id
  );
@endphp

<div class="md:col-span-2">
  <label class="block text-sm font-medium mb-1">Instruments (max 10)</label>
  <select name="instrument_ids[]" multiple class="w-full p-3 border rounded" size="8" required>
    @foreach($instruments as $ins)
      <option value="{{ $ins->id }}" @selected(in_array($ins->id, $selectedIds))>
        {{ $ins->category }} — {{ $ins->name }}
      </option>
    @endforeach
  </select>
  <p class="text-sm text-gray-500 mt-1">
    Maintiens Ctrl (Windows) / Cmd (Mac) pour sélectionner plusieurs.
  </p>
</div>

<div class="md:col-span-2">
  <label class="block text-sm font-medium mb-1">Instrument principal</label>
  <select name="primary_instrument_id" class="w-full p-3 border rounded" required>
    <option value="">— Choisir —</option>
    @foreach($instruments as $ins)
      <option value="{{ $ins->id }}" @selected((int)$primaryId === (int)$ins->id)>
        {{ $ins->category }} — {{ $ins->name }}
      </option>
    @endforeach
  </select>
</div>

      <div class="md:col-span-2 flex gap-2">
        <button class="px-4 py-2 rounded bg-black text-white">Enregistrer</button>
        <a href="{{ route('instrumentists.show', $instrumentist) }}" class="px-4 py-2 rounded bg-white border">Retour</a>
      </div>
    </form>
  </div>
</x-layouts.app>
