# 🎺 Registre — Angel’s Band

Application web de gestion des instrumentistes de la fanfare **Angel’s Band**.

Le registre permet :
- d’enregistrer les membres
- d’associer plusieurs instruments à un instrumentiste
- de définir un instrument principal
- d’attribuer des rôles (Président, DT, Instrumentiste, etc.)
- de consulter le registre publiquement
- de restreindre la création / modification aux administrateurs

---

## 🚀 Fonctionnalités

- 📋 Liste des instrumentistes (recherche globale)
- 🧑‍🎤 Fiche détaillée par instrumentiste
- 🎶 Gestion multi-instruments (max 10)
- ⭐ Instrument principal
- 🏷️ Rôles hiérarchisés (Président → Instrumentiste)
- 🖼️ Upload photo (avec initiales automatiques si absente)
- 🔐 Authentification Admin
- 📱 Responsive (mobile / tablette)

---

## 🛠️ Stack technique

- **Backend** : Laravel
- **Frontend** : Blade + Tailwind CSS
- **Base de données** : MySQL
- **Auth** : Laravel (admin only)
- **Serveur local** : PHP / WAMP / Artisan

---

## 📦 Installation locale

### 1️⃣ Cloner le projet
```bash
git clone https://github.com/VOTRE-USERNAME/registre-angels-band.git
cd registre-angels-band
composer install
cp .env.example .env
php artisan key:generate
