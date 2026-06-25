<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? "Angel's Band — Registre" }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap');
    
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
      min-height: 100vh;
    }
    
    .logo-text {
      font-family: 'Playfair Display', serif;
      background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .nav-link {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #6366f1, #8b5cf6);
      transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
      width: 100%;
    }
    
    .card-hover {
      transition: all 0.3s ease;
      border: 1px solid rgba(99, 102, 241, 0.1);
    }
    
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
      border-color: rgba(99, 102, 241, 0.3);
    }
    
    .gradient-btn {
      background: linear-gradient(90deg, #6366f1, #8b5cf6);
      color: white;
      transition: all 0.3s ease;
    }
    
    .gradient-btn:hover {
      background: linear-gradient(90deg, #4f46e5, #7c3aed);
      transform: scale(1.05);
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .music-note {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    .pulse-dot {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
    }
  </style>
</head>
<body class="text-gray-800">
  <!-- Bandeau supérieur -->
  

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- En-tête principale -->
    <header class="glass-effect rounded-2xl shadow-xl p-6 mb-8">
      <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
        <!-- Logo et titre -->
        <div class="flex items-center gap-4">
          <div class="relative">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
              <i class="fas fa-music text-3xl text-indigo-600"></i>
              <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full pulse-dot"></div>
            </div>
          </div>
          <div>
            <h1 class="text-3xl font-bold logo-text">Angel's Registry</h1>
            
          </div>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-wrap items-center gap-3">
          <!-- Liens principaux -->
          <div class="flex items-center gap-3 bg-white/50 rounded-xl p-2">
            <a href="{{ route('instrumentists.index') }}" 
               class="nav-link px-5 py-3 rounded-lg flex items-center gap-2 font-medium text-gray-700 hover:text-indigo-700 hover:bg-white">
              <i class="fas fa-users text-indigo-500"></i>
              <span>Musiciens/nes</span>
            </a>
            
            <div class="h-6 w-px bg-gray-200"></div>
            
            <a href="{{ route('partitions.index') }}" 
               class="nav-link px-5 py-3 rounded-lg flex items-center gap-2 font-medium text-gray-700 hover:text-purple-700 hover:bg-white">
              <i class="fas fa-file-music text-purple-500"></i>
              <span>Partitions</span>
            </a>
          </div>

          <!-- Boutons d'action admin -->
          @auth
            @if(auth()->user()->is_admin)
              <div class="flex items-center gap-3">
                <a href="{{ route('partitions.create') }}" 
                   class="gradient-btn px-5 py-3 rounded-xl flex items-center gap-2 font-semibold shadow-lg">
                  <i class="fas fa-plus"></i>
                  <span>Nouvelle partition</span>
                </a>
                
                <a href="{{ route('instrumentists.create') }}" 
                   class="px-5 py-3 rounded-xl bg-gray-900 text-white flex items-center gap-2 font-semibold shadow-lg hover:bg-gray-800 transition-colors">
                  <i class="fas fa-user-plus"></i>
                  <span>Nouveau musicien</span>
                </a>
              </div>
            @endif
          @endauth

          <!-- État connexion -->
          <div class="ml-2">
            @auth
              <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-gradient-to-r from-green-50 to-emerald-50 px-4 py-2 rounded-xl border border-green-100">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center">
                    <i class="fas fa-user text-xs text-white"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrateur</p>
                  </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" 
                          class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="text-sm">Déconnexion</span>
                  </button>
                </form>
              </div>
            @else
              <a href="{{ route('login') }}" 
                 class="px-5 py-3 rounded-xl border-2 border-indigo-200 text-indigo-700 hover:bg-indigo-50 hover:border-indigo-300 transition-colors flex items-center gap-2 font-medium">
                <i class="fas fa-key"></i>
                <span>Connexion admin</span>
              </a>
            @endauth
          </div>
        </nav>
      </div>
    </header>

    <!-- Messages d'alerte -->
    @if (session('success'))
      <div class="mb-8">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-r-xl p-5 shadow-lg">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-check text-green-600"></i>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-green-800">Succès !</h3>
              <p class="text-green-700">{{ session('success') }}</p>
            </div>
          </div>
        </div>
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-8">
        <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-r-xl p-5 shadow-lg">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-red-800">Erreur de validation</h3>
              <ul class="mt-2 list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Contenu principal -->
    <main class="card-hover bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      {{ $slot }}
    </main>

    <!-- Pied de page -->
    <!-- Pied de page -->
    <footer class="mt-12">
      <div class="glass-effect rounded-2xl shadow-xl p-8 overflow-hidden relative">
        <!-- Décoration d'arrière-plan -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full blur-3xl opacity-30 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-pink-100 to-rose-100 rounded-full blur-3xl opacity-30 -z-10"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          <!-- Section À propos -->
          <div class="space-y-4">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                <i class="fas fa-music text-2xl text-white music-note"></i>
              </div>
              <div>
                <h3 class="font-bold text-lg logo-text">Fanfare Angel's Band</h3>
              </div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
              Plateforme de gestion des talents musicaux. 
              Votre registre digital pour organiser partitions et musiciens avec passion.
            </p>
            
          </div>

          <!-- Section Navigation rapide -->
          <div>
            <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
              <i class="fas fa-compass text-indigo-500 text-sm"></i>
              Navigation rapide
            </h4>
            <ul class="space-y-3">
              <li>
                <a href="{{ route('instrumentists.index') }}" 
                   class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center gap-2 group">
                  <i class="fas fa-users text-xs group-hover:translate-x-1 transition-transform"></i>
                  <span class="text-sm">Musiciens & Musiciennes</span>
                </a>
              </li>
              <li>
                <a href="{{ route('partitions.index') }}" 
                   class="text-gray-600 hover:text-purple-600 transition-colors flex items-center gap-2 group">
                  <i class="fas fa-file-music text-xs group-hover:translate-x-1 transition-transform"></i>
                  <span class="text-sm">Bibliothèque de partitions</span>
                </a>
              </li>
              @auth
                @if(auth()->user()->is_admin)
                  <li>
                    <a href="{{ route('partitions.create') }}" 
                       class="text-gray-600 hover:text-green-600 transition-colors flex items-center gap-2 group">
                      <i class="fas fa-cog text-xs group-hover:rotate-90 transition-transform"></i>
                      <span class="text-sm">Panneau d'administration</span>
                    </a>
                  </li>
                @endif
              @endauth
            </ul>
          </div>

          <!-- Section Communauté -->
          <div>
            <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
              <i class="fas fa-heart text-pink-500 text-sm"></i>
              Rejoignez la communauté
            </h4>
            <p class="text-sm text-gray-600 mb-4">Suivez-nous sur nos réseaux sociaux pour ne rien manquer !</p>
            <div class="flex gap-3 mb-4">
              <a href="https://www.tiktok.com/@fanfare_angels_band?is_from_webapp=1&sender_device=pc" 
                 target="_blank"
                 class="group w-12 h-12 rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 hover:from-indigo-500 hover:to-purple-600 flex items-center justify-center text-white transition-all shadow-md hover:shadow-xl hover:scale-110">
                <i class="fab fa-tiktok text-lg group-hover:scale-110 transition-transform"></i>
              </a>
              <a href="https://www.youtube.com/@AngelsBand-dm2kf" 
                 target="_blank"
                 class="group w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 flex items-center justify-center text-white transition-all shadow-md hover:shadow-xl hover:scale-110">
                <i class="fab fa-youtube text-lg group-hover:scale-110 transition-transform"></i>
              </a>
            </div>
            
          </div>
        </div>

        <!-- Ligne de séparation élégante -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
          </div>
          <div class="relative flex justify-center">
            <span class="px-4 bg-white text-gray-400">
              <i class="fas fa-music text-xs"></i>
            </span>
          </div>
        </div>

        <!-- Bas du footer -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <p class="text-sm text-gray-500 text-center md:text-left">
            © {{ date('Y') }} Angel's Band. Tous droits réservés.
          </p>
          <div class="flex items-center gap-2 text-xs text-gray-400">
            <span>Développé avec</span>
            <i class="fas fa-heart text-red-400 animate-pulse"></i>
            <span>par AÏDAM Oscar Roméo</span>
          </div>
          <div class="flex items-center gap-4 text-xs text-gray-500">
            <a href="#" class="hover:text-indigo-600 transition-colors">Mentions légales</a>
            <span class="text-gray-300">•</span>
            <a href="#" class="hover:text-indigo-600 transition-colors">Confidentialité</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Éléments décoratifs -->
  <div class="fixed -z-10 top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
    <div class="absolute top-20 left-10 w-72 h-72 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-72 h-72 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
    <div class="absolute top-1/2 left-1/3 w-72 h-72 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-500"></div>
  </div>

  <script>
    // Animation des éléments au scroll
    document.addEventListener('DOMContentLoaded', function() {
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-fadeInUp');
          }
        });
      }, observerOptions);

      // Observer les cartes et sections
      document.querySelectorAll('.card-hover, .nav-link').forEach(el => {
        observer.observe(el);
      });
    });
  </script>
</body>
</html>

