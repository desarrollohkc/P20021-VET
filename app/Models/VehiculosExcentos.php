<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculosExcentos extends Model
{
    use HasFactory;

    protected $table = 'vehiculos_excentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marca',
        'submarca',
        'year',
        'numero_de_serie',
        'placa',
        'tag_id',
        'color',
        'descripcion_uso'
    ];

}
