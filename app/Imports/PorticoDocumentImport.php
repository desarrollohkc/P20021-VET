<?php

namespace App\Imports;

use App\Models\PorticoAforador;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
/*use Maatwebsite\Excel\Concerns\Rules;*/
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
/*use Maatwebsite\Excel\Concerns\WithUpserts;*/
/*use Carbon\Carbon;*/

class PorticoDocumentImport implements ToModel,WithHeadingRow,WithBatchInserts,WithValidation
{
    public function __construct($user_id, $cantidad)
    {
        $this->user_id = $user_id;
        $this->cantidad = $cantidad;
    }

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fecha_ingreso = Carbon::parse($row['fecha_ingreso'])->format('Y-m-d H:i:s');

        if(substr($row['carril'], -1) == "A")
        {
            $cuerpo = 'A';
        }else{
            $cuerpo = 'B';
        }
        $carril = substr_replace($row['carril'] ,"",-1);

        return new PorticoAforador(
            [
                'user_id'                              => $this->user_id,
                'cuerpo'                               => $cuerpo,
                'carril'                               => $carril,
                'tag_id'                               => $row['tag_id'],
                'fecha_ingreso'                        => $fecha_ingreso,
                'placa'                                => $row['placa'],
                'operador'                             => $row['operador'],
                'cantidad'                             => $this->cantidad,
            ]
        );
    }
    public function rules(): array
    {
            return [
                '*.tag_id' => 'nullable',
                '*.fecha_ingreso' => 'required',
                '*.carril' => 'required',
                '*.placa' => 'nullable',
                '*.operador' => 'nullable',
            ];

    }
    public function customValidationMessages()
    {
            return [
                'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria',
                'carril.required' => 'El carril es obligatorio',
            ];
    }
    public function batchSize(): int
    {
        return 100;
    }

}
