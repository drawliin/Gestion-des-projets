<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    protected $table = 'chantiers';
    protected $primaryKey = 'id_chantier';

    protected $fillable = [
        'code_du_chantier',
        'description_du_chantier',
        'id_domaine',
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'id_domaine');
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class, 'id_chantier');
    }

    public function projetsPrincipaux()
    {
        return $this->hasMany(Projet::class, 'id_chantier');
    }
}

