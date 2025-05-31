<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <link rel="stylesheet" href="{{ asset('css/project.css') }}">
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">




  <style>
    /* Root theme colors */
:root {
  --primary-color: #1e293b;    /* Dark blue-gray background */
  --accent-color: #fbbf24;     /* Golden accent */
  --text-color: #0a0f18;       /* Light text */
  --sidebar-bg: #111827;       /* Darker sidebar */
  --sidebar-color: #f3f4f6;       /* Darker sidebar */
  --sidebar-hover: #374151;    /* Hover on sidebar links */
  --header-bg: #f9fafb;        /* Light header */
  --header-text: #374151;      /* Darker header text */
  --logout-btn-color: #fbbf24; /* Accent for logout icon */
}

/* App container */
.app-container {
  display: flex;
  height: 100vh;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: var(--text-color);
  background-color: var(--primary-color);
}

/* Sidebar styles */
.sidebar {
  width: 240px;
  background-color: var(--sidebar-bg);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 1rem;
  color: var(--sidebar-color);
  box-shadow: 2px 0 5px rgba(0,0,0,0.3);
}

/* Sidebar Header */
.sidebar-header .logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.logo-icon {
  background-color: var(--accent-color);
  color: var(--sidebar-bg);
  font-weight: 700;
  font-size: 1.5rem;
  width: 40px;
  height: 40px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.logo-text .logo-subtext {
  font-weight: 600;
  font-size: 1.1rem;
  color: var(--sidebar-color);
}

/* Sidebar nav */
.sidebar-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-item {
  margin: 0.7rem 0;
}

.nav-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 0.5rem 1rem;
  color: var(--sidebar-color);
  text-decoration: none;
  border-radius: 6px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-link i {
  font-size: 18px;
  width: 24px;
  text-align: center;
  color: var(--accent-color);
}

.nav-link span {
  font-weight: 500;
}

.nav-link:hover {
  background-color: var(--sidebar-hover);
  color: var(--accent-color);
}

/* User nav (bottom of sidebar) */
.user-nav {
  border-top: 1px solid #374151;
  padding: 1rem 0 0;
  font-size: 0.9rem;
  color: #9ca3af;
}

/* Main content */
.main-content {
  flex-grow: 1;
  background-color: #f9fafb;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
}

/* Header */
.main-header {
  background-color: var(--header-bg);
  color: var(--header-text);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.8rem 2rem;
  border-bottom: 1px solid #ddd;
  box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
  font-size: 0.9rem;
}

/* Date & role badge */
.date-role-badge {
  background-color: #fde68a; /* lighter golden */
  color: #92400e;
  padding: 0.4rem 0.8rem;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-weight: 600;
}

/* Right header */
.right-header {
  display: flex;
  align-items: center;
  gap: 1.2rem;
}

/* Profile icon */
.profile-ring {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    padding: 2px;
    display: inline-block;
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

/* Logout button */
.btn-logout {
  background: none;
  border: none;
  color: var(--logout-btn-color);
  font-size: 1.3rem;
  cursor: pointer;
  transition: color 0.3s ease;
}

.btn-logout:hover {
  color: #b45309; /* darker golden */
}

/* Scrollbar for main content */
.main-content::-webkit-scrollbar {
  width: 8px;
}

.main-content::-webkit-scrollbar-track {
  background: #f3f4f6;
}

.main-content::-webkit-scrollbar-thumb {
  background-color: var(--accent-color);
  border-radius: 20px;
  border: 2px solid #f3f4f6;
}

  </style>

</head>
<body>
  <div class="app-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <div class="sidebar-header">
          <div class="logo">
            <div class="logo-icon">D</div>
            <div class="logo-text">
              <div class="logo-subtext">Gestion des Projets</div>
            </div>
          </div>
        </div>

        <nav class="sidebar-nav">
          <ul>
            @hasanyrole("admin|gestionnaire")
            <li class="nav-item">
              <a href="{{ route('commune.index') }}" class="nav-link">
                <i class="fas fa-city"></i> 
                <span>Communes</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('province.index') }}" class="nav-link">
                <i class="fas fa-map"></i> 
                <span>Provinces</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('domaine.index') }}" class="nav-link">
                <i class="fas fa-layer-group"></i> <span>Domaines</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('chantier.index') }}" class="nav-link">
                <i class="fas fa-tools"></i> <span>Chantiers</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('programme.index') }}" class="nav-link">
                <i class="fas fa-tasks"></i> <span>Programmes</span>
              </a>
            </li>
            @endhasanyrole
            @role('financier')
            <li class="nav-item">
              <a href="/couts" class="nav-link">
                <i class="fa-solid fa-coins"></i> <span>Couts</span>
              </a>
            </li>
            @endrole
            <li class="nav-item">
              <a href="{{ route('projet.index') }}" class="nav-link">
                <i class="fas fa-project-diagram"></i> <span>Projets</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sousprojet.index') }}" class="nav-link">
                <i class="fas fa-puzzle-piece"></i> <span>Sous-Projets</span>
              </a>
            </li>
            @role("directeur")
              <li class="nav-item">
                  <a href="/dashboard" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i> <span>Dashboard</span>
                  </a>
              </li>
            @endrole
          </ul>
          @role("admin")
              <ul class="nav-item">
                <li style="border-top: 1px solid #ccc; margin-top: 0.5rem; padding-top: 0.5rem; margin-bottom: 0px;">
                  <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fa-solid fa-users"></i><span>Utilisateurs</span>
                  </a>
                </li>
              </ul>
          @endrole
        </nav>
      </div>

    </div>

    <!-- Main Content -->
    <div class="main-content">
      <header class="main-header">
          <span class="date-role-badge">
              📅 {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('ddd D MMMM YYYY') }} |
              👤 Rôle : <strong>{{ ucfirst(auth()->user()->roles->first()?->name) }}</strong>
          </span>

          <div class="right-header">
              <a href="{{route("profile.index")}}" class="profile-ring" title="Mon Profil">
                <img src="/user.png" alt="Profile" class="profile-img">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </a>

              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn-logout" title="Se déconnecter">
                      <i class="fa-solid fa-right-from-bracket"></i>
                  </button>
              </form>
          </div>
      </header>
      @yield('content')
    </div>
  </div>
</body>
</html>
