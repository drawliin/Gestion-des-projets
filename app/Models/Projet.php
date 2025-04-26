<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $table = 'projets';
    protected $primaryKey = 'id_projet';

    protected $fillable = [
        'code_du_projet',
        'nom_du_projet',
        'cout_cro',
        'cout_total_du_projet',
        'date_debut',
        'date_fin_prevue',
        'etat_d_avancement_physique',
        'etat_d_avancement_financier',
        'commentaires',
        'id_domaine',
        'id_chantier',
        'id_programme',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'id_domaine');
    }

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier');
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'id_programme');
    }

    public function sousProjetsLocalises()
    {
        return $this->hasMany(SousProjetLocalise::class, 'id_projet');
    }
}
