<?php

use Illuminate\Support\Facades\Route;



//ruta principal login
Auth::routes();

Route::get('/', function () {
   return redirect()->route('login');
});

Auth::routes();

Auth::routes(['verify' => true]);//aut por correo

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //autenticacion con correo;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //autenticacion con correo;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //autenticacion con correo;

/* Ayuda login*/
Route::get('/pdflogin', 'PDFController@jenifer')->name('ayuda.login')->middleware('verified');


/* Rutas de los Porteros */ 
Auth::routes();

Route::get('/dataTablePorteros', 'UsuarioController@dataTable')->name('porteros.dataTable')->middleware('verified');

Route::get('/porteros', 'UsuarioController@index')->name('porteros.listar')->middleware('verified');

Route::POST('/porteros', 'UsuarioController@store')->name('porteros.crear')->middleware('verified');

Route::get('/pdfpor', 'PDFController@ayudaPortero')->name('porteros.ayuda')->middleware('verified');

Route::get('/pdfporHorario', 'PDFController@ayudaconsultarHorario')->name('porterosConsultarHorario.ayuda')->middleware('verified');

Route::DELETE('/porteros/eliminar/{usuario}', 'UsuarioController@destroy')->name('porteros.eliminar')->middleware('verified');

Route::get('/porteros/{usuario}', 'UsuarioController@edit')->name('porteros.editar')->middleware('verified');

Route::PATCH('/porteros/actualizar/{user}', 'UsuarioController@update')->name('porteros.actualizar')->middleware('verified');

/* Rutas de los Turnos */

Route::get('/dataTable', 'TurnoController@dataTable')->name('turnos.dataTable')->middleware('verified');

Route::get('/turnos', 'TurnoController@index')->name('turnos.listar')->middleware('verified');

Route::POST('/turnos', 'TurnoController@store')->name('turnos.crear')->middleware('verified');

Route::get('/pdf', 'PDFController@downloadd')->name('turnos.ayuda')->middleware('verified');

//Route::get('/pdf', 'PDFController@ayudaPortero')->name('porteros.ayuda')->middleware('verified');

Route::DELETE('/turnos/eliminar/{turno}', 'TurnoController@destroy')->name('turnos.eliminar')->middleware('verified');

Route::get('/turnos/{turno}', 'TurnoController@edit')->name('turnos.editar')->middleware('verified');

Route::PATCH('/turnos/actualizar/{turno}', 'TurnoController@update')->name('turnos.actualizar')->middleware('verified');

/* Rutas de los Horarios */

Route::get('/dataTable', 'HorarioController@dataTable')->name('horarios.dataTable')->middleware('verified');

Route::get('/horarios', 'HorarioController@index')->name('horarios.listar')->middleware('verified');

Route::POST('/horarios', 'HorarioController@store')->name('horarios.crear')->middleware('verified');

Route::DELETE('/horarios/eliminar/{horario}', 'HorarioController@destroy')->name('horarios.eliminar')->middleware('verified');

Route::get('/horarios/{horarios}', 'HorarioController@edit')->name('horarios.editar')->middleware('verified');

Route::PATCH('/horarios/actualizar/{horario}', 'horarioController@update')->name('horarios.actualizar')->middleware('verified');

Route::get('/pdfHorario', 'PDFController@ayudaHorario')->name('ayuda.horario')->middleware('verified');

Route::get('/dataTableHorario', 'HorarioController@consultarHorario')->name('horarios.portero')->middleware('verified');


/* Rutas de los recargos*/

Route::get('/dataTableRecargos', 'RecargoController@dataTable')->name('recargos.dataTable')->middleware('verified');

Route::get('/generarLiquidacion', 'RecargoController@index')->name('recargos.mostrar')->middleware('verified');

Route::POST('/generarLiquidacion', 'RecargoController@store')->name('recargos.generar')->middleware('verified');

Route::get('/pdfliquidacion', 'PDFController@ayudaliquidacion')->name('ayuda.liquidacion')->middleware('verified');

Route::get('/pdfRecargos', 'PDFController@ayudaRecargos')->name('ayuda.recargos')->middleware('verified');

/* Ruta pfd recargos*/



