<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Gestion de Projets')</title>

  <link rel="stylesheet" href="{{ asset('css/project.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .sidebar {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100vh;
    }

    .sidebar-header{
      height: 7vh;
    }

    .sidebar-nav{
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 83vh;
    }

    .sidebar-nav ul {
      list-style: none;
      padding: 0;

    }

    /* Style pour les éléments de la barre latérale */
    .nav-item {
      margin: 8px 0;         /* Espacement vertical */
      margin-right: 60px;    /* Espacement à droite */
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 10px;             /* Espacement entre l'icône et le texte */
      padding: 8px 12px;
      color: #fff;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .nav-link i {
      font-size: 18px;       /* Taille de l'icône */
    }

    .nav-link span {
      margin-left: 10px;      /* Marge entre l'icône et le texte */
    }

    .nav-link:hover {
      background-color: #444; /* Couleur de fond au survol */
    }



    .user-nav {
      height: 10vh;
      padding: 12px;
      border-top: 1px solid #ccc;
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
            <li class="nav-item">
              <a href="{{ route('commune.index') }}" class="nav-link">
                <i class="fas fa-city"></i> <span>Communes</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('province.index') }}" class="nav-link">
                <i class="fas fa-map"></i> <span>Provinces</span>
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
            <li class="nav-item">
                <a href="/dashboard" class="nav-link">
                <i class="fa-solid fa-chart-line"></i> <span>Dashboard</span>
                </a>
                </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fa-solid fa-user"></i> <span>Mon Compte</span>
                </a>
            </li>
          </ul>
          @role("admin")
            <ul class="admin-ul">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="fa-solid fa-users"></i><span>Utilisateurs</span>
                </a>
              </li>
            </ul>
          @endrole
        </nav>
      </div>

      <!-- Utilisateur en bas -->
      <div class="user-nav">
        <ul>
          <li class="nav-item">
            <form action="{{route("logout")}}" method="Post">
              @csrf
              <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Log out</span>
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      @yield('content')
    </div>
  </div>
</body>
</html>
