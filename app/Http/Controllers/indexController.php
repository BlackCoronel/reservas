<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function ayuda(){
        return view('layouts.ayuda');
    }

    public function contacta(){
        return view('layouts.contacta');
    }

    public function reservas(){
        $marcas = DB::table('ps_marcas')->get();
        return view('layouts.reservar',compact('marcas'));
    }

    public function cargarModelos($id){
        $modelos = DB::table('ps_modelos')->where('id_marca',$id)->get();
        return response()->json($modelos);
    }

    public function cargarCarrocerias($id){
        $carrocerias = DB::table('ps_submodelos')->where('id_modelo',$id)->get();
        return response()->json($carrocerias);
    }

    public function cargarHoras($dia){
        $reservadas = DB::table('reservas')->where('dia',$dia)->get();
        $provisionales = DB::table('fechas_reserva')->where('fecha',$dia)->get();
        $horas = DB::table('horas')->get();
        foreach ($horas as $hora){
            foreach ($reservadas as $reserva){
                if($hora->hora == $reserva->hora){
                    $hora->reservada = 'reservada';
                }
            }
        }
        foreach ($horas as $hora){
            foreach ($provisionales as $provisional){
                if($hora->hora == $provisional->hora){
                    $hora->reservada = 'provisional';
                }
            }
        }
        return response()->json($horas);
    }
}
