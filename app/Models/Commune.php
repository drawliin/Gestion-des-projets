<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes';
    protected $primaryKey = 'id_commune';

    protected $fillable = [
        'code_commune',
        'nom_fr',
        'nom_ar',
        'id_province',
    ];

    // Relation avec la province
    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

    // Relation avec SousProjetLocalise
    public function sousProjetsLocalises()
    {
        return $this->hasMany(SousProjetLocalise::class, 'id_commune');
    }
}
