<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\fechas;
use App\User;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function index(){
        if(Auth::user()->rol == 'admin'){
            $reservas = DB::table('reservas')->where('dia', '>=', date('Y-m-d'))->get();
            $estados = DB::table('estados')->get();
        } elseif (Auth::user()->rol == 'concesionario'){
            $reservas = DB::table('reservas')->where('dia', '>=', date('Y-m-d'))->where('id_cliente',Auth::user()->id)->get();
            $estados = DB::table('estados')->get();
        }
        return view('admin.principal',compact('reservas','estados'));
    }

    public function actualizarReserva($id,Request $request){
        DB::table('reservas')->where('id',$id)->update([
           'estado' => $request->estado
        ]);
        return redirect('/admin');
    }

    public function cargarReserva($id){
        $reserva = DB::table('reservas')->where('id',$id)->get();
        $modelos = DB::table('ps_submodelos')->get();
        $reservadas = DB::table('reservas')->where('dia',$reserva[0]->dia)->get();
        $provisionales = DB::table('fechas_reserva')->where('fecha',$reserva[0]->dia)->get();
        $horas = DB::table('horas')->get();
        foreach ($horas as $hora){
            foreach ($reservadas as $res){
                if($hora->hora == $res->hora){
                    $hora->reservada = 'reservada';
                }
            }
        }
        foreach ($horas as $hora){
            foreach ($provisionales as $provisional){
                if($hora->hora == $provisional->hora){
                    $hora->reservada = 'reservada';
                }
            }
        }
        return response()->json([$reserva,$modelos,$horas]);
    }

    public function eliminarReserva($id){
        DB::table('reservas')->where('id',$id)->delete();
        return redirect('/admin');
    }

    public function editarReserva($id,Request $request){
        if($request->hora){
            DB::table('reservas')->where('id',$id)->update([
                "hora" => $request->hora
            ]);
        }
        DB::table('reservas')->where('id',$id)->update([
            "modelo" => $request->modelo,
            "dia" => $request->dia,
            "nombre" => $request->nombre,
            "telefono" => $request->telefono,
            "sociedad" => $request->sociedad,
            "cargo" => $request->cargo,
            "email" => $request->email
        ]);

        return redirect('/admin');
    }

    public function crearFechas($id,Request $request){
       $datos = DB::table('reservas')->where('id',$id)->get();
       for($i = 0; $i < count($request->fecha); $i++){
           if($request->fecha[$i] != null && $request->hora[$i] != 'Seleccione primero una fecha...'){
               $fecha = new fechas([
                  'fecha' => $request->fecha[$i],
                  'hora' => $request->hora[$i],
                  'referencia' => $datos[0]->referencia
               ]);
               $fecha->save();
           }
       }
       DB::table('reservas')->where('id',$id)->update([
           'estado'=> 'ESPERANDO FECHA CLIENTE',
       ]);
       return redirect('/admin');
    }

    public function vistaRegistro(){
        return view('admin.layouts.registro');
    }

    public function registroEmpresa(Request $request){
        $registro = new User([
            'name' => $request->name,
            'email' => $request->email,
            'cargo' => $request->cargo,
            'token' => str::random(32),
            'telefono' => $request->telefono,
            'rol' => 'concesionario',
        ]);
        $registro->save();
        return redirect('/register');
    }

    public function vistaClave($token){
        $empresa = DB::table('users')->where('token',$token)->get();
        if($empresa->count() > 0){
            return view('auth.confirmar',compact('token'));
        } else {
            abort(403,'El token introducido ha expirado o es incorrecto');
        }

    }

    public function crearClave($token,Request $request){
        $request->validate([
           'password' => 'required|confirmed'
        ]);
        DB::table('users')->where('token',$token)->update([
            'token' => str::random(32),
            'password' => bcrypt($request->password)
        ]);
        return redirect('/login');
    }



}
