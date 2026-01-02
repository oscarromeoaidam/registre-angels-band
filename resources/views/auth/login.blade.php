<x-layouts.app>


@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
  <div class="w-full max-w-md bg-white border rounded-xl p-6">
    <div class="flex flex-col items-center mb-6 text-center">
      <img src="{{ asset('images/FAB.png') }}" alt="Angel’s Band" class="h-16 w-auto object-contain mb-2">
      <h1 class="text-xl font-bold">Connexion Administrateur</h1>
      <p class="text-sm text-gray-600">Accès réservé à l’administrateur du registre</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input id="email" type="email"
               class="w-full p-3 border rounded"
               name="email" value="{{ old('email') }}" required autofocus>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Mot de passe</label>
        <input id="password" type="password"
               class="w-full p-3 border rounded"
               name="password" required>
      </div>

      <div class="flex items-center justify-between">
        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
          <input type="checkbox" name="remember" class="rounded border-gray-300">
          Se souvenir de moi
        </label>

        @if (Route::has('password.request'))
          <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
            Mot de passe oublié ?
          </a>
        @endif
      </div>

      <button type="submit" class="w-full px-4 py-3 rounded bg-black text-white hover:bg-gray-900">
        Se connecter
      </button>
    </form>
  </div>
</div>
</x-layouts.app>
