<?php

namespace App\Http\Controllers;

use App\Models\PorticoAforador;
use App\Models\Roles;
use App\Models\Tarifas;
use App\Models\User;
use App\Models\VehiculosExcentos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class ConfiguracionController extends Controller
{

    public function index(){
        if (Auth::user()->rol->nombre == 'analista'){
            return Redirect::to(route('configuracion.vehiculos'));
        }
        return Redirect::to(route('configuracion.usuarios'));
    }

    /*TARIFAS*/

    public function showAdminTarifas(){
        $tarifa = Tarifas::where('active',true)->first();
        return view('configuracion.tarifas.administrar-tarifas',compact('tarifa'));
    }

    public function updateAdminTarifas(Request $request){

        $update_tarifa_rules = [
            'fecha_inicio' => ['required', 'date','before:fecha_fin'],
            'fecha_fin' => ['required','date','before:now'],
            'cantidad' => ['required','numeric'],
        ];
        $update_tarifa_messages = [
            'fecha_inicio.required' => 'La fecha inicio es obligatoria',
            'fecha_inicio.date' => 'El campo es de tipo fecha',
            'fecha_inicio.before' => 'La fecha inicio debe ser menor a la fecha fin',
            'fecha_fin.required' => 'La fecha fin es obligatoria',
            'fecha_fin.date' => 'El campo es de tipo fecha',
            'fecha_fin.before' => 'La fecha fin debe ser menor a la fecha actual',
            'cantidad.required' => 'Ingrese una cantidad',
            'cantidad.numeric' => 'La cantidad debe tener este formato 999.99',
        ];

        $validations = Validator::make($request->all(), $update_tarifa_rules,$update_tarifa_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        $tarifa = Tarifas::create([
            'user_id' => Auth::user()->id,
            'cantidad' => $request->cantidad,
            'active' => false,
            'accion' => 'Actualización de tarifa',
            'descripcion' => 'Se actualizó tarifa para Portico Aforador',
            'tarifa_fecha_inicio' => $request->fecha_inicio,
            'tarifa_fecha_fin' => $request->fecha_fin
        ]);

        PorticoAforador::whereBetween('fecha_ingreso', [$tarifa->tarifa_fecha_inicio, $tarifa->tarifa_fecha_fin])->each(function ($portico) use ($tarifa){
            $portico->cantidad = $tarifa->cantidad;
            $portico->update();
        });

        return back()->with('success','Se actualizó correctamente la tarifa!');
    }

    public function storeAdminTarifas (Request $request){
        $store_tarifa_rules = [
            'cantidad' => ['required','numeric'],
        ];
        $store_tarifa_messages = [

            'cantidad.required' => 'Ingrese una cantidad',
            'cantidad.numeric' => 'La cantidad debe tener este formato 999.99',
        ];

        $validations = Validator::make($request->all(), $store_tarifa_rules,$store_tarifa_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        $old = Tarifas::where('active',true)->first();
        $old->active = false;
        $old->update();


        Tarifas::create([
            'user_id' => Auth::user()->id,
            'cantidad' => $request->cantidad,
            'active' => true,
            'accion' => 'Definir tarifa',
            'descripcion' => 'Se define nueva tarifa',
            'tarifa_fecha_inicio' => null,
            'tarifa_fecha_fin' => null
        ]);

        return back()->with('success','Se definió correctamente la nueva tarifa!');

    }

    /*FIN TARIFAS*/

    /* USUARIOS */

    public function showAdminUsuarios(){
        $users = User::paginate(10)->withQueryString();
        $roles = Roles::paginate(10)->withQueryString();
        return view('configuracion.usuarios.administrar-usuarios',compact('users','roles'));
    }

    public function createAdminUsuarios(){
        $roles = Roles::all();
        return view('configuracion.usuarios.crear-usuario',compact('roles'));
    }

    public function storeAdminUsuarios(Request $request){

        $store_user_rules = [
            'name' => ['required','min:3','max:30'],
            'email' => ['required','email','min:4','max:50','unique:users'],
            'role_id' => ['required'],
            'password' => ['required','min:8'],
        ];
        $store_user_messages = [

            'name.required' => 'Ingrese el nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre debe tener máximo 30 caracteres',
            'email.required' => 'Ingrese el email',
            'email.email' => 'El formato es incorrecto',
            'email.min' => 'El email debe tener al menos 4 caracteres',
            'email.max' => 'El email debe tener máximo 50 caracteres',
            'email.unique' => 'Ya existe un usuario',
            'role_id.required' => 'Seleccione el tipo de usuario',
            'password.required' => 'Ingrese una contraseña',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',

        ];

        $validations = Validator::make($request->all(), $store_user_rules,$store_user_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        User::create([
           'name' => $request->name,
           'email' => $request->email,
           'role_id' => $request->role_id,
           'password' => Hash::make($request->password),
        ]);


        return Redirect::to('/configuracion/usuarios')->with('success','Se creo el nuevo usuario correctamente!');
    }

    public function editAdminUsuarios(User $user){

        $roles = Roles::all();

        return view('configuracion.usuarios.editar-usuario',compact('user','roles'));
    }

    public function updateAdminUsuarios(Request $request){

        $user = User::findOrFail($request->id);

        $update_user_rules = [
            'name' => ['required','min:3','max:30'],
            'email' => ['required','email','min:4','max:50','unique:users,email,'.$user->id,],
            'role_id' => ['required'],
            'password' => ['nullable','min:8'],
        ];
        $update_user_messages = [

            'name.required' => 'Ingrese el nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre debe tener máximo 30 caracteres',
            'email.required' => 'Ingrese el email',
            'email.email' => 'El formato es incorrecto',
            'email.min' => 'El email debe tener al menos 4 caracteres',
            'email.max' => 'El email debe tener máximo 50 caracteres',
            'email.unique' => 'Ya existe un usuario',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',

        ];

        $validations = Validator::make($request->all(), $update_user_rules,$update_user_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        $password = $user->password;
        if (isset($request->password)){
            $password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = $password;
        $user->save();

        return Redirect::to('/configuracion/usuarios')->with('success','Se edito el usuario correctamente!');
    }

    public function deleteAdminUsuarios(User $user){

        $user->delete();

        return Redirect::to('/configuracion/usuarios')->with('success','Se eliminó el usuario correctamente!');

    }

    /*FIN USUARIOS*/

    /*VEHICULOS*/

    public function showAdminVehiculos(){
        $excentos = VehiculosExcentos::paginate(10);
        return view('configuracion.vehiculos.index',compact('excentos'));
    }

    public function createAdminVehiculos(){
        $max_year = Carbon::now()->year;
        $max_year += 1;
        return view('configuracion.vehiculos.create',compact('max_year'));
    }

    public function storeAdminVehiculos(Request $request){
        $max_year = Carbon::now()->year + 1;

        $store_vehiculos_rules = [
            'marca' => ['required','min:2','max:50'],
            'submarca'=> ['required','max:50'],
            'year' => ['required','digits:4','integer','min:1960','max:'.$max_year],
            'numero_de_serie' => ['required','min:2','max:50'],
            'placa' => ['required','min:2','max:50'],
            'tag_id' => ['required','min:2','max:50','unique:vehiculos_excentos,tag_id'],
            'color' => ['required','min:2','max:50'],
            'descripcion_uso' => ['required','min:2','max:50']
        ];
        $store_vehiculos_messages = [

            'marca.required' => 'Campo requerido',
            'marca.min' => 'Debe tener al menos 2 caracteres',
            'marca.max' => 'Debe tener máximo 50 caracteres',
            'submarca.required' => 'Campo requerido',
            'submarca.max' => 'Debe tener máximo 50 caracteres',
            'year.required' => 'Campo requerido',
            'year.digits' => 'El año consta de 4 dígitos',
            'year.min' => 'Fecha mínima 1960',
            'year.max' => 'Fecha máxima '.$max_year,
            'numero_de_serie.required' => 'Campo requerido',
            'numero_de_serie.min' => 'Debe tener al menos 2 caracteres',
            'numero_de_serie.max' => 'Debe tener máximo 50 caracteres',
            'placa.required' => 'Campo requerido',
            'placa.min' => 'Debe tener al menos 2 caracteres',
            'placa.max' => 'Debe tener máximo 50 caracteres',
            'tag_id.required' => 'Campo requerido',
            'tag_id.min' => 'Debe tener al menos 2 caracteres',
            'tag_id.max' => 'Debe tener máximo 50 caracteres',
            'tag_id.unique' => 'Ya existe un vehículo excento con este TAG',
            'color.required' => 'Campo requerido',
            'color.min' => 'Debe tener al menos 2 caracteres',
            'color.max' => 'Debe tener máximo 50 caracteres',
            'descripcion_uso.required' => 'Campo requerido',
            'descripcion_uso.min' => 'Debe tener al menos 2 caracteres',
            'descripcion_uso.max' => 'Debe tener máximo 50 caracteres',
        ];


        $validations = Validator::make($request->all(), $store_vehiculos_rules,$store_vehiculos_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        VehiculosExcentos::create([
            'marca' => $request->marca,
            'submarca'=> $request->submarca,
            'year' => $request->year,
            'numero_de_serie' =>$request->numero_de_serie,
            'placa' => $request->placa,
            'tag_id' => $request->tag_id,
            'color' => $request->color,
            'descripcion_uso' => $request->descripcion_uso,
        ]);


        return Redirect::to('/configuracion/vehiculos')->with('success','Se vehículo excento!');

    }

    public function editAdminVehiculos(VehiculosExcentos $vehiculo){
        $max_year = Carbon::now()->year + 1 ;
        return view('configuracion.vehiculos.update',compact('vehiculo','max_year'));
    }

    public function updateAdminVehiculos(Request $request){
        $max_year = Carbon::now()->year + 1;

        $excento = VehiculosExcentos::findOrFail($request->id);

        $store_vehiculos_rules = [
            'placa' => ['required','min:2','max:50'],
            'color' => ['required','min:2','max:50'],
            'descripcion_uso' => ['required','min:2','max:50']
        ];
        $store_vehiculos_messages = [
            'placa.required' => 'Campo requerido',
            'placa.min' => 'Debe tener al menos 2 caracteres',
            'placa.max' => 'Debe tener máximo 50 caracteres',
            'color.required' => 'Campo requerido',
            'color.min' => 'Debe tener al menos 2 caracteres',
            'color.max' => 'Debe tener máximo 50 caracteres',
            'descripcion_uso.required' => 'Campo requerido',
            'descripcion_uso.min' => 'Debe tener al menos 2 caracteres',
            'descripcion_uso.max' => 'Debe tener máximo 50 caracteres',
        ];


        $validations = Validator::make($request->all(), $store_vehiculos_rules,$store_vehiculos_messages);
        if ($validations->fails()){
            return back()->withErrors($validations)->withInput();
        }

        $excento->placa = $request->placa;
        $excento->color = $request->color;
        $excento->descripcion_uso = $request->descripcion_uso;
        $excento->save();


        return Redirect::to('/configuracion/vehiculos')->with('success','Se actualizó el vehículo excento!');

    }

    public function destroyAdminVehiculos(VehiculosExcentos $vehiculo){
        $vehiculo->delete();
        return Redirect::to('/configuracion/vehiculos')->with('success','Se eliminó el vehículo excento correctamente!');
    }

    /*FIN VEHICULOS*/

}
