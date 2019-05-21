<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\reservas;


class reservasController extends Controller
{
    public function reserva(Request $request){
    $msg = ' ¡ Reserva realizada con éxito, compruebe su email o teléfono para más información !';
    $marcas = DB::table('ps_marcas')->get();
    $hora = explode(':',$request->hora);
    $fecha = explode('-',$request->dia);
       $request->validate([
            'modelo' => 'required',
            'dia' => 'required',
            'hora' => 'required',
            'nombre' => 'required',
            'telefono' =>'required',
            'email' => 'required',
            'sociedad' => 'required',
            'cargo' => 'required',
            'dia' => 'required',
            'hora' => 'required',
            'modelo' =>'required',
            'politicas' => 'required'
        ]);

        $reserva = new reservas([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'sociedad' => $request->sociedad,
            'cargo' => $request->cargo,
            'dia' => $request->dia,
            'hora' => $request->hora,
            'modelo' => $request->modelo,
            'token' => bcrypt('PQ' . strtoupper(substr($request->nombre,0,2)). $fecha[2] . $fecha[1] . $hora[0]),
            'referencia' => 'PQ' . strtoupper(substr($request->nombre,0,2)). $fecha[2] . $fecha[1] . $hora[0],
            'estado' => 'ESPERANDO CONFIRMACIÓN'
        ]);

        $reserva->save();

        return view('layouts.reservar',compact('marcas','msg'));
    }

    public function consultar(){
        return view('layouts.consulta');
    }

    public function consulta($referencia){
        $reserva = DB::table('reservas')->where('referencia',$referencia)->get();
        $reserva[0]->dia = date('d-m-Y',strtotime($reserva[0]->dia));
        return response()->json($reserva);
    }

    public function vistaPlazos($token){
        $datos = DB::table('reservas')->where('token',$token)->get();
        if($datos->count() > 0){
            $fechas = DB::table('fechas_reserva')->where('referencia',$datos[0]->referencia)->orderBy('fecha','ASC')->get();
            foreach ($fechas as $fecha){
                $fecha->token = $token;
            }
        }
       return view('layouts.plazos',compact('fechas'));
    }

    public function asignarPlazos($token,$dia,$hora){
        $datos = DB::table('reservas')->select('referencia')->where('token',$token)->get();
        if($datos->count() > 0){
            $plazos = DB::table('fechas_reserva')->where('referencia',$datos[0]->referencia)->get();
            if($plazos->count() > 0){
                DB::table('reservas')->where('token',$token)->update([
                   'dia' => $dia,
                    'hora' => $hora,
                    'estado' => 'CONFIRMADO'
                ]);
                DB::table('fechas_reserva')->where('referencia',$datos[0]->referencia)->delete();
                return redirect('/estado');
            } else {
                abort(403);
            }
        } else {
            abort(403);}
    }

    public function diferentePlazo($token,Request $request){
        $datos = DB::table('reservas')->select('referencia')->where('token',$token)->get();
        if($datos->count() > 0){
            $plazos = DB::table('fechas_reserva')->where('referencia',$datos[0]->referencia)->get();
            if($plazos->count() > 0){
                DB::table('reservas')->where('token',$token)->update([
                    'dia' => $request->fecha,
                    'hora' => $request->hora,
                    'estado' => 'CONFIRMADO'
                ]);
                DB::table('fechas_reserva')->where('referencia',$datos[0]->referencia)->delete();
                return redirect('/estado');
            } else {
                abort(403);
            }
        } else {
            abort(403);}
    }
}
