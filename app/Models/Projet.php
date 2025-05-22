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
        'annee_debut',
        'annee_fin_prevue',
        'etat_d_avancement_physique',
        'etat_d_avancement_financier',
        'commentaires',
        'id_province',
        'id_commune',
        'id_programme',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
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
