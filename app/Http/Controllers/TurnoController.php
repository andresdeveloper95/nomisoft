<?php

namespace App\Http\Controllers;

use App\Turno;
use App\User;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dataTable()
    {
         $turnos=Turno::all();
         return view('dataTableTurno',compact("turnos"));
    }
 
     public function index()
     {
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();
         return view('principal1', compact('turnos', 'porteros')); 
     }
 

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $validatorNormal = \Validator::make($request->all(), [
            'codigo' => 'required|unique:turnos,codigo'
        ]);  
    
        if ($validatorNormal->fails()) {
            $message = "El codigo ". $request->codigo." del turno ya existe";
         return Response::json("turnoMalo");
        }     
        if($request->ajax()){

            $turno = new Turno;
            $turno->codigo     =   $request->codigo;
            $turno->horaInicio    =   $request->horaInicio;
            $turno->horaFin  =   $request->horaFin;
            $turno->save();
            return Response::json("turnoBueno");   
            return redirect()->route('turnos.listar');
         }        
    }

    public function show(Turno $turno)
    {
        
    }
 
    public function edit(Turno $turno)
    {
        return view('editar',compact("turno"));
    }
   
    public function update(Request $request, Turno $turno)
    {
        $turno->update([
            'horaInicio'=>request('horaInicio'),
            'horaFin'=>request('horaFin'),        
        ]);
    }
 
    public function destroy(Request $request)
    {
        if($request->ajax()){
            $turno = Turno::find($request->id);
            $turno->delete();
       } 
    }
}
