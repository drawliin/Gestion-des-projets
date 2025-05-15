<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un nouveau sous-projet</title>
  <link rel="stylesheet" href="{{ asset('css/sous_projet.css') }}">
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
          <li class="nav-item"><a href="#" class="nav-link"><span>Partenaires</span></a></li>
          <li class="nav-item"><a href="#" class="nav-link"><span>Chantiers</span></a></li>
          <li class="nav-item"><a href="#" class="nav-link"><span>Projets</span></a></li>
          <li class="nav-item active"><a href="#" class="nav-link"><span>Sous-Projets</span></a></li>
          <li class="nav-item"><a href="#" class="nav-link"><span>Utilisateurs</span></a></li>
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
            <h1>Sous-Projet</h1>
          </div>

          <!-- FORMULAIRE LARAVEL -->
          <form method="POST" action="#" id="sousProjetForm">
            @csrf
            <h3>Détails du Sous-Projet</h3>
            
            <div class="form-row">
              <div class="form-group">
                <label for="projetParent">Projet Parent <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="projetParent" name="projet_parent_id" required>
                    <option value="">Sélectionner</option>
                     @foreach($projets as $projet)
                      <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="codeSousProjet">Code Sous-Projet <span class="required">*</span></label>
                <input type="text" id="codeSousProjet" name="code" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="nomSousProjet">Nom Sous-Projet <span class="required">*</span></label>
                <input type="text" id="nomSousProjet" name="nom" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="statut">Statut <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="statut" name="statut" required>
                    <option value="">Sélectionner</option>
                    <option value="en_attente">En attente</option>
                    <option value="en_cours">En cours</option>
                    <option value="termine">Terminé</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="priorite">Priorité <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="priorite" name="priorite" required>
                    <option value="">Sélectionner</option>
                    <option value="haute">Haute</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="basse">Basse</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="dateDebut">Date Début <span class="required">*</span></label>
                <div class="date-input">
                  <input type="date" id="dateDebut" name="date_debut" required>
                </div>
              </div>
              <div class="form-group">
                <label for="dateFin">Date Fin <span class="required">*</span></label>
                <div class="date-input">
                  <input type="date" id="dateFin" name="date_fin" required>
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="responsable">Responsable <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="responsable" name="responsable_id" required>
                    <option value="">Sélectionner</option>
                    @foreach($responsables as $responsable)
                      <option value="{{ $responsable->id }}">{{ $responsable->nom }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="equipe">Équipe <span class="required">*</span></label>
                <div class="select-wrapper">
                  <select id="equipe" name="equipe_id" required>
                    <option value="">Sélectionner</option>
                    @foreach($equipes as $equipe)
                      <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="budgetAlloue">Budget Alloué (MAD) <span class="required">*</span></label>
                <input type="number" id="budgetAlloue" name="budget_alloue" required>
              </div>
              <div class="form-group">
                <label for="budgetConsomme">Budget Consommé (MAD)</label>
                <input type="number" id="budgetConsomme" name="budget_consomme">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="avancementPhysique">Avancement Physique (%)</label>
                <input type="number" id="avancementPhysique" name="avancement_physique" min="0" max="100">
              </div>
              <div class="form-group">
                <label for="avancementFinancier">Avancement Financier (%)</label>
                <input type="number" id="avancementFinancier" name="avancement_financier" min="0" max="100">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"></textarea>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group full-width">
                <label for="livrables">Livrables</label>
                <textarea id="livrables" name="livrables" rows="2"></textarea>
              </div>
            </div>

            <div class="form-actions-top">
              <button type="submit" class="btn-return">Enregistrer</button>
              <a href="{{ route('sous_projets.index') }}" class="btn-return">Revenir à la liste</a>
            </div>
          </form>

        </div>
      </div>
      
      <div class="bottom-nav">
        <a href="{{ route('sous_projets.index') }}" class="btn-response"><i class="fas fa-arrow-left"></i> Réponse</a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/sous_projet.js') }}"></script>
</body>
</html>
