<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousProjetLocalise extends Model
{
    use HasFactory;

    protected $table = 'sous_projets_localises';
    protected $primaryKey = 'code_du_sous_projet';

    protected $fillable = [
        'id_province',
        'id_commune',
        'id_projet',
        'code_du_sous_projet',
        'nom_du_sous_projet',
        'secteur_concerne',
        'site',
        'centre',
        'surface',
        'statut',
        'lineaire',
        'douars_desservis',
        'source_de_financement',
        'nature_de_l_intervention',
        'beneficiaire',
        'estimation_initiale',
        'avancement_physique',
        'avancement_financier',
        'commentaires',
        'localite',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
}
