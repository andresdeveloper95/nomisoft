<?php

namespace App\Http\Controllers;


use App\Horario;
use App\Turno;
use App\User;
use Redirect, Response;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataTable()
    {
         $horarios=Horario::all();
         $turnos=Turno::all();
         $porteros=User::where("rol","=","P")->get();
         return view('dataTableHorario',compact("horarios", "turnos", "porteros"));
    }
 
    
    public function index()
    {
        $horarios=Horario::all();
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();
        return view('principalHorario', compact("horarios", "turnos", "porteros")); 
    }

    public function consultarHorario()
    {   
        $horarios=Horario::all();
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();
        return view('dataTableHorario', compact("horarios", "turnos", "porteros"));
    }
    
    public function store(Request $request)
    {
        if($request->ajax()){

            $horario = new Horario;
            $horario->porteros     =   $request->porteros;
            $horario->sede    =   $request->sede;
            $horario->mes  =   $request->mes;
            $horario->primero  =   $request->primero;
            $horario->segundo  =   $request->segundo;
            $horario->tercero  =   $request->tercero;
            $horario->cuarto  =   $request->cuarto;
            $horario->quinto  =   $request->quinto;
            $horario->sexto  =   $request->sexto;
            $horario->septimo  =   $request->septimo;
            $horario->octavo  =   $request->octavo;
            $horario->noveno  =   $request->noveno;
            $horario->decimo  =   $request->decimo;
            $horario->once  =   $request->once;
            $horario->doce  =   $request->doce;
            $horario->trece  =   $request->trece;
            $horario->catorce  =   $request->catorce;
            $horario->quince  =   $request->quince;
            $horario->dieciseis  =   $request->dieciseis;
            $horario->diecisiete  =   $request->diecisiete;
            $horario->diesocho  =   $request->diesocho;
            $horario->diecinueve  =   $request->diecinueve;
            $horario->veinte  =   $request->veinte;
            $horario->veintiuno  =   $request->veintiuno;            
	        $horario->veintidos  =   $request->veintidos;
            $horario->veintitres  =   $request->veintitres;
            $horario->veinticuatro  =   $request->veinticuatro;
            $horario->veinticinco  =   $request->veinticinco;
            $horario->veintiseis  =   $request->veintisiete;
            $horario->veintisiete  =   $request->veintisiete;
            $horario->veintiocho  =   $request->veintiocho;
            $horario->veintinueve  =   $request->veintinueve;
            $horario->treinta  =   $request->treinta;
            $horario->treintayuno  =   $request->treintayuno;
            
            $horaPortero = 0;

            if($horario->primero == "A" or $horario->primero == "B" or $horario->primero == "C"){
                $horaPortero +=8;
            }
            elseif($horario->primero == "D" or $horario->primero == "N"){
                $horaPortero +=12;
            }
            elseif($horario->primero == "E" or $horario->primero == "H"){
                $horaPortero +=4;
            }
            elseif($horario->primero == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->segundo == "A" or $horario->segundo == "B" or $horario->segundo == "C"){
                $horaPortero +=8;
            }
            elseif($horario->segundo == "D" or $horario->segundo == "N"){
                $horaPortero +=12;
            }
            elseif($horario->segundo == "E" or $horario->segundo == "H"){
                $horaPortero +=4;
            }
            elseif($horario->segundo == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->tercero == "A" or $horario->tercero == "B" or $horario->tercero == "C"){
                $horaPortero +=8;
            }
            elseif($horario->tercero == "D" or $horario->tercero == "N"){
                $horaPortero +=12;
            }
            elseif($horario->tercero == "E" or $horario->tercero == "H"){
                $horaPortero +=4;
            }
            elseif($horario->tercero == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede"); 
                $horaPortero = 0;
            }
            
            elseif($horario->cuarto == "A" or $horario->cuarto == "B" or $horario->cuarto == "C"){
                $horaPortero +=8;
            }
            elseif($horario->cuarto == "D" or $horario->cuarto == "N"){
                $horaPortero +=12;
            }
            elseif($horario->cuarto == "E" or $horario->cuarto == "H"){
                $horaPortero +=4;
            }
            elseif($horario->cuarto == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->quinto == "A" or $horario->quinto == "B" or $horario->quinto == "C"){
                $horaPortero +=8;
            }
            elseif($horario->quinto == "D" or $horario->quinto == "N"){
                $horaPortero +=12;
            }
            elseif($horario->quinto == "E" or $horario->quinto == "H"){
                $horaPortero +=4;
            }
            elseif($horario->quinto == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->sexto == "A" or $horario->sexto == "B" or $horario->sexto == "C"){
                $horaPortero +=8;
            }
            elseif($horario->sexto == "D" or $horario->sexto == "N"){
                $horaPortero +=12;
            }
            elseif($horario->sexto == "E" or $horario->sexto == "H"){
                $horaPortero +=4;
            }
            elseif($horario->sexto == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->septimo == "A" or $horario->septimo == "B" or $horario->septimo == "C"){
                $horaPortero +=8;
            }
            elseif($horario->septimo == "D" or $horario->septimo == "N"){
                $horaPortero +=12;
            }
            elseif($horario->septimo == "E" or $horario->septimo == "H"){
                $horaPortero +=4;
            }
            elseif($horario->septimo == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->octavo == "A" or $horario->octavo == "B" or $horario->octavo == "C"){
                $horaPortero +=8;
            }
            elseif($horario->octavo == "D" or $horario->octavo == "N"){
                $horaPortero +=12;
            }
            elseif($horario->octavo == "E" or $horario->octavo == "H"){
                $horaPortero +=4;
            }
            elseif($horario->octavo == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->noveno == "A" or $horario->noveno == "B" or $horario->noveno == "C"){
                $horaPortero +=8;
            }
            elseif($horario->noveno == "D" or $horario->noveno == "N"){
                $horaPortero +=12;
            }
            elseif($horario->noveno == "E" or $horario->noveno == "H"){
                $horaPortero +=4;
            }
            elseif($horario->noveno == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->decimo == "A" or $horario->decimo == "B" or $horario->decimo == "C"){
                $horaPortero +=8;
            }
            elseif($horario->decimo == "D" or $horario->decimo == "N"){
                $horaPortero +=12;
            }
            elseif($horario->decimo == "E" or $horario->decimo == "H"){
                $horaPortero +=4;
            }
            elseif($horario->decimo == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->once == "A" or $horario->once == "B" or $horario->once == "C"){
                $horaPortero +=8;
            }
            elseif($horario->once == "D" or $horario->once == "N"){
                $horaPortero +=12;
            }
            elseif($horario->once == "E" or $horario->once == "H"){
                $horaPortero +=4;
            }
            elseif($horario->once == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->doce == "A" or $horario->doce == "B" or $horario->doce == "C"){
                $horaPortero +=8;
            }
            elseif($horario->doce == "D" or $horario->doce == "N"){
                $horaPortero +=12;
            }
            elseif($horario->doce == "E" or $horario->doce == "H"){
                $horaPortero +=4;
            }
            elseif($horario->doce == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                           
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->trece == "A" or $horario->trece == "B" or $horario->trece == "C"){
                $horaPortero +=8;
            }
            elseif($horario->trece == "D" or $horario->trece == "N"){
                $horaPortero +=12;
            }
            elseif($horario->trece == "E" or $horario->trece == "H"){
                $horaPortero +=4;
            }
            elseif($horario->trece == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->catorce == "A" or $horario->catorce  == "B" or $horario->catorce == "C"){
                $horaPortero +=8;
            }
            elseif($horario->catorce == "D" or $horario->catorce == "N"){
                $horaPortero +=12;
            }
            elseif($horario->catorce == "E" or $horario->catorce == "H"){
                $horaPortero +=4;
            }
            elseif($horario->catorce == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->quince == "A" or $horario->quince == "B" or $horario->quince == "C"){
                $horaPortero +=8;
            }
            elseif($horario->quince == "D" or $horario->quince == "N"){
                $horaPortero +=12;
            }
            elseif($horario->quince == "E" or $horario->quince == "H"){
                $horaPortero +=4;
            }
            elseif($horario->quince == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->dieciseis == "A" or $horario->dieciseis == "B" or $horario->dieciseis == "C"){
                $horaPortero +=8;
            }
            elseif($horario->dieciseis == "D" or $horario->dieciseis == "N"){
                $horaPortero +=12;
            }
            elseif($horario->dieciseis == "E" or $horario->quince == "H"){
                $horaPortero +=4;
            }
            elseif($horario->dieciseis == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->diecisiete == "A" or $horario->diecisiete == "B" or $horario->diecisiete == "C"){
                $horaPortero +=8;
            }
            elseif($horario->diecisiete == "D" or $horario->diecisiete == "N"){
                $horaPortero +=12;
            }
            elseif($horario->diecisiete == "E" or $horario->diecisiete == "H"){
                $horaPortero +=4;
            }
            elseif($horario->diecisiete == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->diesocho == "A" or $horario->diesocho == "B" or $horario->diesocho == "C"){
                $horaPortero +=8;
            }
            elseif($horario->diesocho == "D" or $horario->diesocho == "N"){
                $horaPortero +=12;
            }
            elseif($horario->diesocho == "E" or $horario->diesocho == "H"){
                $horaPortero +=4;
            }
            elseif($horario->diesocho == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->diecinueve == "A" or $horario->diecinueve == "B" or $horario->diecinueve == "C"){
                $horaPortero +=8;
            }
            elseif($horario->diecinueve == "D" or $horario->diecinueve == "N"){
                $horaPortero +=12;
            }
            elseif($horario->diecinueve == "E" or $horario->diecinueve == "H"){
                $horaPortero +=4;
            }
            elseif($horario->diecinueve == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veinte == "A" or $horario->veinte == "B" or $horario->veinte == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veinte == "D" or $horario->veinte == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veinte == "E" or $horario->veinte == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veinte == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintiuno == "A" or $horario->veintiuno == "B" or $horario->veintiuno == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintiuno == "D" or $horario->veintiuno == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintiuno == "E" or $horario->veintiuno == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintiuno == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){  
                              
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintidos == "A" or $horario->veintidos == "B" or $horario->veintidos == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintidos == "D" or $horario->veintidos == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintidos == "E" or $horario->veintidos == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintidos == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintitres == "A" or $horario->veintitres == "B" or $horario->veintitres == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintitres == "D" or $horario->veintitres == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintitres == "E" or $horario->veintitres == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintitres == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veinticuatro == "A" or $horario->veinticuatro == "B" or $horario->veinticuatro == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veinticuatro == "D" or $horario->veinticuatro == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veinticuatro == "E" or $horario->veinticuatro == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veinticuatro == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veinticinco == "A" or $horario->veinticinco == "B" or $horario->veinticinco == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veinticinco == "D" or $horario->veinticinco == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veinticinco == "E" or $horario->veinticinco == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veinticinco == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintiseis == "A" or $horario->veintiseis == "B" or $horario->veintiseis == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintiseis == "D" or $horario->veintiseis == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintiseis == "E" or $horario->veintiseis == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintiseis == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintisiete == "A" or $horario->veintisiete == "B" or $horario->veintisiete == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintisiete == "D" or $horario->veintisiete == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintisiete == "E" or $horario->veintisiete == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintisiete == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                
                //return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintiocho == "A" or $horario->veintiocho == "B" or $horario->veintiocho == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintiocho == "D" or $horario->veintiocho == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintiocho == "E" or $horario->veintiocho == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintiocho == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->veintinueve == "A" or $horario->veintinueve == "B" or $horario->veintinueve == "C"){
                $horaPortero +=8;
            }
            elseif($horario->veintinueve == "D" or $horario->veintinueve == "N"){
                $horaPortero +=12;
            }
            elseif($horario->veintinueve == "E" or $horario->veintinueve == "H"){
                $horaPortero +=4;
            }
            elseif($horario->veintinueve == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->treinta == "A" or $horario->treinta == "B" or $horario->treinta == "C"){
                $horaPortero +=8;
            }
            elseif($horario->treinta == "D" or $horario->treinta == "N"){
                $horaPortero +=12;
            }
            elseif($horario->treinta == "E" or $horario->treinta == "H"){
                $horaPortero +=4;
            }
            elseif($horario->treinta == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){ 
                               
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }

            elseif($horario->treintayuno == "A" or $horario->treintayuno == "B" or $horario->treintayuno == "C"){
                $horaPortero +=8;
            }
            elseif($horario->treintayuno == "D" or $horario->treintayuno == "N"){
                $horaPortero +=12;
            }
            elseif($horario->treintayuno == "E" or $horario->treintayuno == "H"){
                $horaPortero +=4;
            }
            elseif($horario->treintayuno == "Z"){
                $horaPortero = 0;
            }
            if($horaPortero > 49){
                return Response::json( "No se puede");
                $horaPortero = 0; 
            }
            $horario->save();
            return Response::json("Se creo");            
            return redirect()->route('horarios.listar'); 
         }             
    }
    
    public function show(Horario $horario)
    {
        
    }
    
    public function edit(Horario $horario)
    {
        
    }
    
    public function update(Request $request, Horario $horario)
    {
            $horario->update([
            'sede'=>request('sede'),
            'mes'=>request('mes'),
            'primero'=>request('primero'),
            'segundo'=>request('segundo'),
            'tercero'=>request('tercero'),
            'cuarto'=>request('cuarto'),
            'quinto'=>request('quinto'),
            'sexto'=>request('sexto'),
            'septimo'=>request('septimo'),
            'octavo'=>request('octavo'),
            'noveno'=>request('noveno'),
            'decimo'=>request('decimo'),
            'once'=>request('once'),
            'doce'=>request('doce'),
            'trece'=>request('trece'),
            'catorce'=>request('catorce'),
            'quince'=>request('quince'),
            'dieciseis'=>request('dieciseis'),
            'diecisiete'=>request('diecisiete'),
            'diesocho'=>request('diesocho'),
            'diecinueve'=>request('diecinueve'),
            'veinte'=>request('veinte'),
            'veintiuno'=>request('veintiuno'),
            'veintidos'=>request('veintidos'),
            'veintidos'=>request('veintidos'),
            'veintidos'=>request('veintidos'),
            'veintidos'=>request('veintidos'),
            'veintitres'=>request('veintitres'),
            'veinticuatro'=>request('veinticuatro'),
            'veinticinco'=>request('veinticinco'),
            'veinticinco'=>request('veinticinco'),
            'veinticinco'=>request('veinticinco'),
            'veintiseis'=>request('veintiseis'),
            'veintisiete'=>request('veintisiete'),
            'veintiocho'=>request('veintiocho'),
            'veintinueve'=>request('veintinueve'),
            'treinta'=>request('treinta'),
            'treintayuno'=>request('treintayuno'),

            ]);
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $horario = Horario::find($request->id);
            $horario->delete();
       } 
    }
}
