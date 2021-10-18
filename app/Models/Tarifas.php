<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifas extends Model
{
    use HasFactory;

    protected $table = 'tarifas';

    protected $fillable = [
        'user_id',
        'cantidad',
        'active',
        'accion',
        'descripcion',
        'tarifa_fecha_inicio',
        'tarifa_fecha_fin',
        'created_at',
        'updated_at'
    ];

}
