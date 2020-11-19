<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Horario;
use DB as DBS;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/turno', function (Request $request) {
    return $request->turno();
});

Route::middleware('auth:api')->get('/horario', function (Request $request) {
    return $request->horario();
});

Route::get('porteros',function(){
	return datatables(DB::table('users')->where('rol', '=', 'P')
	->select('id', 'cedula', 'name', 'apellidos', 'direccion', 'telefono', 'email'))
	->addColumn('btn','actions')
	->rawColumns(['btn'])	
	->toJson();
});

Route::get('turnos',function(){
	return datatables()
	->eloquent(App\Turno::query())
	->addColumn('btn','actions')
	->rawColumns(['btn'])	
	->toJson();
});

Route::get('horarios',function(){
	return datatables(DBS::table('horarios')
	->join('users', 'horarios.porteros', '=', 'users.id')
	->select('users.name as porteros', 'horarios.sede as sede', 'horarios.mes as mes', 'horarios.primero as primero', 'horarios.segundo as segundo', 'horarios.tercero as tercero', 'horarios.cuarto as cuarto', 'horarios.quinto as quinto', 
	'horarios.sexto as sexto', 'horarios.septimo as septimo', 'horarios.octavo as octavo', 'horarios.noveno as noveno', 'horarios.decimo as decimo', 'horarios.once as once', 'doce as doce', 'trece as trece', 'horarios.catorce as catorce', 'horarios.quince as quince', 'horarios.dieciseis as dieciseis',
	'horarios.diecisiete as diecisiete', 'horarios.diesocho as diesocho', 'horarios.diecinueve as diecinueve', 'horarios.veinte as veinte', 'horarios.veintiuno as veintiuno', 'horarios.veintidos as veintidos', 'horarios.veintitres as veintitres',
	'horarios.veinticuatro as veinticuatro', 'horarios.veinticinco as veinticinco', 'horarios.veintiseis as veintiseis', 'horarios.veintisiete as veintisiete', 'horarios.veintiocho as veintiocho', 'horarios.veintinueve as veintinueve', 
	'horarios.treinta as treinta', 'horarios.treintayuno as treintayuno'))
	->addColumn('btn','actions')
	->rawColumns(['btn'])	
	->toJson();
});

//select name from users whrere 
