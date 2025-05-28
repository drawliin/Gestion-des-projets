<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommuneProjet extends Model
{
    protected $table = 'commune_projet';
    protected $fillable = [
        "projet_id_projet", "commune_id_commune"
    ];
}
