<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $table = 'programmes';
    protected $primaryKey = 'id_programme';

    protected $fillable = [
        'code_du_programme',
        'description_du_programme',
        'id_chantier',
    ];

    public function chantier()
    {
        return $this->belongsTo(Chantier::class, 'id_chantier');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'id_programme');
    }
}

