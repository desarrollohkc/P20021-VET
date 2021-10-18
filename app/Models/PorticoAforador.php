<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PorticoAforador extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'portico_aforadors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'carril',
        'cuerpo',
        'placa',
        'cantidad',
        'operador',
        'user_id',
        'fecha_ingreso'
    ];

    protected $dates = [
        'fecha_ingreso'
    ];

    public function scopeFilterPortico($query,$data = []){

        if (isset($data['carril']) and $data['carril'] != ''){
            $query->whereRaw("TRANSLATE(carril, 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU') ilike TRANSLATE('%".$data['carril']."%', 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU')");
        }

        if (isset($data['cuerpo']) and $data['cuerpo'] != ''){
            $query->whereRaw("TRANSLATE(cuerpo, 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU') ilike TRANSLATE('%".$data['cuerpo']."%', 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU')");
        }

        if (isset($data['tag']) and $data['tag'] != ''){
            $query->whereRaw("TRANSLATE(tag_id, 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU') ilike TRANSLATE('%".$data['tag']."%', 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU')");
        }

        if (isset($data['placa']) and $data['placa'] != ''){
            $query->whereRaw("TRANSLATE(placa, 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU') ilike TRANSLATE('%".$data['placa']."%', 'áàéèíìóòúùÁÀÉÈÍÌÓÒÚÙ', 'aaeeiioouuAAEEIIOOUU')");
        }

        if (isset($data['desde']) and $data['desde'] != '' and isset($data['hasta']) and $data['hasta']){
            $query->whereBetween('fecha_ingreso', [$data['desde'], $data['hasta']]);
        }

        return $query;
    }

    /*BOOT*/
    public static function boot() {

        parent::boot();

        /**
         * Write code on Method
         *
         * @return response()
         */
        static::creating(function($item) {
            $tarifa = Tarifas::where('active',true)->first();

            $tarifa->cantidad;

            $item->cantidad = $tarifa->cantidad;
            $item->update();
        });
    }
    /*END BOOT*/

}
