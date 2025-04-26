<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';
    protected $primaryKey = 'id_province';

    protected $fillable = [
        'code_province',
        'description_province_fr',
        'description_province_ar',
    ];

    public function sousProjetsLocalises()
    {
        return $this->hasMany(SousProjetLocalise::class, 'id_province');
    }
}
