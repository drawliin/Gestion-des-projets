<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un nouveau projet</title>

  <!-- CSS from Laravel's public folder -->
  <link rel="stylesheet" href="{{ asset('css/project.css') }}">
  
  <!-- External CSS (FontAwesome) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .btn-ajouter {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-left: 10px;
    }

    .btn-ajouter:hover {
      background-color: #218838;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
    }
  </style>
</head>
<body>
  <div class="app-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <div class="logo-icon">D</div>
          <div class="logo-text">
            <div>Gestion</div>
            <div class="logo-subtext">Des Projets</div>
          </div>
        </div>
      </div>
      
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span>Partenaires</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span>Chantiers</span>
            </a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link">
              <span>Projets</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span>Sous-Projets</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span>Utilisateurs</span>
            </a>
          </li>
        </ul>
      </nav>
      
      <div class="sidebar-footer">
        <button class="btn-add">Ajouter</button>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="form-header">
        <div class="form-actions">
          <button class="btn-icon"><i class="fas fa-redo"></i></button>
          <button class="btn-icon"><i class="fas fa-share"></i></button>
          <a href="/projets/create" class="btn-ajouter">Ajouter</a>
        </div>
      </div>

      <div class="form-content">
        <!-- Form removed -->
      </div>
    </div>
  </div>
</body>
</html>
