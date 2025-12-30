<x-layouts.app :title="'Ajouter un instrumentiste'">
  <div class="bg-white border rounded-xl p-6 max-w-3xl">
    <h2 class="text-xl font-semibold">Ajouter un instrumentiste</h2>

    <form class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4"
          method="POST"
          action="{{ route('instrumentists.store') }}"
          enctype="multipart/form-data">
      @csrf

      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Photo d’identité</label>
        <input type="file" name="photo" accept="image/*" class="w-full p-2 border rounded">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Nom</label>
        <input name="last_name" value="{{ old('last_name') }}" class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Prénoms</label>
        <input name="first_name" value="{{ old('first_name') }}" class="w-full p-3 border rounded" required>
      </div>
<div>
  <label class="block text-sm font-medium mb-1">Rôle</label>
  <select name="role_id" class="w-full p-3 border rounded" required>
    <option value="">— Choisir —</option>
    @foreach($roles as $r)
      <option value="{{ $r->id }}"
        @selected((int)old('role_id', $instrumentist->role_id ?? '') === (int)$r->id)>
        {{ $r->name }}
      </option>
    @endforeach
  </select>
</div>


      <div>
        <label class="block text-sm font-medium mb-1">Surnom (facultatif)</label>
        <input name="nickname" value="{{ old('nickname') }}" class="w-full p-3 border rounded">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Sexe</label>
        <select name="sex" class="w-full p-3 border rounded" required>
          <option value="">— Choisir —</option>
          <option value="M" @selected(old('sex')==='M')>Masculin</option>
          <option value="F" @selected(old('sex')==='F')>Féminin</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Date de naissance</label>
        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full p-3 border rounded" >
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Lieu de résidence / Quartier</label>
        <input name="residence" value="{{ old('residence') }}" class="w-full p-3 border rounded" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Numéro de téléphone</label>
        <input name="phone" value="{{ old('phone') }}" class="w-full p-3 border rounded" >
      </div>

      <div class="md:col-span-2">
  <label class="block text-sm font-medium mb-1">Instruments (max 10)</label>
  <select name="instrument_ids[]" multiple class="w-full p-3 border rounded" required size="8">
    @foreach($instruments as $ins)
      <option value="{{ $ins->id }}" @selected(collect(old('instrument_ids', []))->contains($ins->id))>
        {{ $ins->category }} — {{ $ins->name }}
      </option>
    @endforeach
  </select>
  <p class="text-sm text-gray-500 mt-1">Maintiens Ctrl (Windows) / Cmd (Mac) pour sélectionner plusieurs.</p>
</div>

<div class="md:col-span-2">
  <label class="block text-sm font-medium mb-1">Instrument principal</label>
  <select name="primary_instrument_id" class="w-full p-3 border rounded" required>
    <option value="">— Choisir —</option>
    @foreach($instruments as $ins)
      <option value="{{ $ins->id }}" @selected(old('primary_instrument_id')==$ins->id)>
        {{ $ins->category }} — {{ $ins->name }}
      </option>
    @endforeach
  </select>
</div>


      <div class="md:col-span-2 flex gap-2">
        <button class="px-4 py-2 rounded bg-black text-white">Enregistrer</button>
        <a href="{{ route('instrumentists.index') }}" class="px-4 py-2 rounded bg-white border">Annuler</a>
      </div>
    </form>
  </div>
</x-layouts.app>
