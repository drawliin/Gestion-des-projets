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
      <div class="form-container">
        <div class="form-header">
          <div class="form-actions">
            <button class="btn-icon"><i class="fas fa-redo"></i></button>
            <button class="btn-icon"><i class="fas fa-share"></i></button>
          </div>
        </div>
        
        <div class="form-content">
          <div class="form-title">
            <h2>CRÉER UN NOUVEAU</h2>
            <h1>Projet</h1>
          </div>
          
          <form id="projectForm" method="POST" action="#">
            @csrf
            <h3>Détails du Projet</h3>
            
            <div class="form-row">
              <div class="form-group">
                <label for="codeProjet">Code Projet <span class="required">*</span></label>
                <input type="text" id="codeProjet" name="codeProjet" required>
              </div>
              <div class="form-group">
                <label for="nomProjet">Nom Projet <span class="required">*</span></label>
                <input type="text" id="nomProjet" name="nomProjet" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="domaine">Domaine <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="domaine" name="domaine" required>
                    <option value="">Sélectionner</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="programme">Programme <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="programme" name="programme" required>
                    <option value="">Sélectionner</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="chantier">Chantier <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="chantier" name="chantier" required>
                    <option value="">Sélectionner</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="convention">Convention <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="convention" name="convention" required>
                    <option value="">Sélectionner</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="dateDebut">Date Début <span class="required">*</span></label>
                <input type="date" id="dateDebut" name="dateDebut" required>
              </div>
              <div class="form-group">
                <label for="dateFin">Date Fin <span class="required">*</span></label>
                <input type="date" id="dateFin" name="dateFin" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="auPhys">Etat d'avancement Phys (%) <span class="required">*</span></label>
                <input type="number" id="auPhys" name="auPhys" required>
              </div>
              <div class="form-group">
                <label for="auFinancier">Etat d'avancement Finan (%) <span class="required">*</span></label>
                <input type="number" id="auFinancier" name="auFinancier" required>
              </div>
              <div class="form-group">
                <label for="coutProjet">Coût Projet (MAD) <span class="required">*</span></label>
                <input type="number" id="coutProjet" name="coutProjet" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="coutPartONG">Coût CRO (MAD) <span class="required">*</span></label>
                <input type="number" id="coutPartONG" name="coutPartONG" required>
              </div>
            </div>
            <div class="form-row">
            <div class="form-group full-width">
            <label for="observations">Observations <span class="required">*</span></label>
            <textarea id="observations" name="observations" required></textarea>
  </div>
</div>

            <div class="form-actions-top">
              <button class="btn-return" type="submit">Revenir à la liste</button>
            </div>
                
          </form>

        </div>
      </div>

    </div>
  </div>



</body>
</html>
