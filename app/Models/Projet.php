<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsToMany(
            Commune::class,
            'commune_projet',           // your actual pivot table name
            'projet_id_projet',         // foreign key on pivot table for Projet
            'commune_id_commune'        // foreign key on pivot table for Commune
        );
    }

    public function sousProjetsCommunes()
    {
        return $this->hasManyThrough(
            Commune::class,            // Final model you want
            SousProjetLocalise::class, // Intermediate model
            'id_projet',               // Foreign key on SousProjetLocalise table
            'id_commune',              // Foreign key on Commune table
            'id_projet',               // Local key on Projet table
            'id_commune'               // Local key on SousProjetLocalise table
        );
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
