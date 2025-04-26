<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $table = 'domaines';
    protected $primaryKey = 'id_domaine';

    protected $fillable = [
        'code_du_domaine',
        'description_fr',
        'description_ar',
    ];

    public function chantiers()
    {
        return $this->hasMany(Chantier::class, 'id_domaine');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'id_domaine');
    }
}
