<?php

namespace App\View\Components;

use App\Http\Controllers\PorticoAforadorController;
use App\Models\PorticoAforador;
use App\Models\Tarifas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use App\Imports\PorticoDocumentImport;

class FilterPortico extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     * @param $registros
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render($registros = null)
    {
        return view('components.filter-portico');
    }


    /**
     * Funcion para filtrar los datos
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function filter(Request $request){
        $data = [
            'carril' => $request->carril,
            'cuerpo' => $request->cuerpo,
            'tag' => $request->tag,
            'placa' => $request->placa,
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ];

        $query = PorticoAforador::filterPortico($data);

        $registros = $query->paginate(10)->withQueryString();

        return view('home', compact('registros'));

    }

    public function createLoadDocuments(){

        if (Auth::user()->rol->nombre == 'banobras'){
            return back()->with('error','No tiene permisos para realizar esta acción.');
        }

        return view('configuracion.portico.cargar_documento_prortico');
    }

    /**
     * Funcion para cargar csv de portico
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeDocuments(Request $request){

        $document_rules = [
            'csv_url' => ['required','file','mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/plain'],
        ];

        $document_messages = [
            'csv_url.required' => 'Cargue un archivo',
            'csv_url.file' => 'El campo debe ser un archivo',
            'csv_url.mimetypes' => 'Suba un archivo con extensión csv/xls',
        ];

        $validations = Validator::make($request->all(), $document_rules,$document_messages);
        if ($validations->fails()){
            return back()->withErrors($validations);
        }

        $user = Auth::user();
        $document = $user->addMedia(request('csv_url'))->toMediaCollection();
        $extension = pathinfo($document->getPath(), PATHINFO_EXTENSION );
        if ($extension != 'csv'){
            $document->delete();
            return back()->with('error','Solo se pueden cargar archivos tipo csv.');
        }

        $tarifa = Tarifas::where('active',true)->first();

        try {
            $finished = (new PorticoDocumentImport($user->id, $tarifa->cantidad))->import($document->getPath(), null, \Maatwebsite\Excel\Excel::CSV);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorList=[];
            $i=0;
            foreach ($failures as $failure) {
                $errorList[$i]['row']=$failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $errorList[$i]['message']=$failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                $i++;
            }
            /*DB::delete("delete from portico_aforadors where user_id ='.$user->id.'");*/
            $document->delete();
            return back()->with('error_csv_load',$errorList);

        }
        if($finished){
            /*LotSchedule::create([
                'user_id' => Auth::user()->id,
                'lots_id' => $lot->id,
                'media_id' => $document->id,
                'description' => 'Se carga documento',
            ]);*/
            return back()->with('success','Se cargo el archivo exitosamente');
        }

    }
}
