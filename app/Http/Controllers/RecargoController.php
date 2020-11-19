<?php

namespace App\Http\Controllers;

use App\Recargo;
use App\User;
use App\Turno;
use App\Horario;
use Illuminate\Support\Facades\DB; 
use Redirect, Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class RecargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataTable()
    {
        $recargos=DB::table('recargos')
        ->join('users', 'recargos.porteros', '=', 'users.id')
        ->select('recargos.id as id','users.name as porteros', 'recargos.ordinarioNoc as ordinarioNoc', 'recargos.diurnoFest as diurnoFest', 'recargos.nocturnoFes as nocturnoFes', 'recargos.extraDiurna as extraDiurna',
        'recargos.extraNocturna as extraNocturna', 'recargos.extraDiurnaFest as extraDiurnaFest', 'recargos.extraNocturnaFest as extraNocturnaFest', 'recargos.Total as Total')->get();
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();
        return view('dataTableRecargos',compact("recargos", "turnos", "porteros"));
    }
 
    
    public function index()
     {
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();
        return view('generarLiquidacion', compact('porteros','turnos')); 
     }

    public function create()
    {
        
    }

    public function store(Request $request, Recargo $recargo)
    {  
        $festivos=array("2020-01-1"=>"Año Nuevo",
		"2020-01-6"=>"Día de los Reyes Magos",
		"2020-03-23"=>"Día de San José",
		"2020-04-9"=>"Jueves Santo",
		"2020-04-10"=>"Viernes Santo",
		"2020-05-1"=>"Día del Trabajo",
		"2020-05-25"=>"Día de la Ascensión",
		"2020-06-15"=>"Corpus Christi",
		"2020-06-22"=>"Día del Sagrado Corazón",
		"2020-06-29"=>"San Pedro y San Pablo",
		"2020-07-20"=>"Día de la Independencia de Colombia",
		"2020-08-7"=>"Batalla de Boyacá",
		"2020-08-17"=>"Día de la Asunción",
		"2020-10-12"=>"Día de la Raza",
		"2020-11-2"=>"Día de Todos los Santos",
		"2020-11-16"=>"Independencia de Cartagena",
		"2020-12-8"=>"Inmaculada Concepción",
        "2020-12-25"=>"Navidad");
         
        $diaDeLaSemanaEnNumero=date('w',strtotime(request('fechaInicio'))); //en este caso 0 es Domingo, 1 es Lunes, 
        $diaDeLaSemanaEnNumero;

        $recargo->fechaInicio=request('fechaInicio');
        $recargo->fechaFin=request('fechaFin');
        $recargo->porteros=request('idporteros');
        $fechaFestivos = substr($recargo->fechaInicio, 0,8);
        $diasFestivos = '"'.$fechaFestivos.'"';
        //return $diasFestivos;
        //return $fechaFestivos;
        $mesennumero = substr($recargo->fechaInicio, 5,2);        
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mesLetras = $meses [ $mesennumero-1 ]; 
        $datos = Horario::select('primero')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo = array($datos);  
        //return $arreglo;

        $diaIni=date('d',strtotime(request('fechaInicio')));
        //return $diaIni;
        $diaFinal=date('d',strtotime(request('fechaFin'))); 

        if((date('m',strtotime(request('fechaInicio'))))!=(date('m',strtotime(request('fechaFin'))))){
            //return Response::json("meses diferentes");
        }
        else{
            if(request('fechaInicio')>request('fechaFin')){
                //return Response::json("fechaInferior"); 
            }
        }

        

        $ordinarioNocturno = 0;
        $diurnoFestivo = 0;
        $nocturnoFestivo = 0;
        $extraDiurna = 0;
        $extraNocturna = 0;
        $extraDiurnaFestiva = 0;
        $extraNocturnaFestiva = 0;
        $total = 0;
        $domingos = array();
        //Formatear dias
        $buscarDia=array('01','02','03','04','05','06','07','08','09');
        $remplazarDia=array('1','2','3','4','5','6','7','8','9');
            
        for($i=$diaIni; $i<=$diaFinal; $i++){

            $dia=str_replace($buscarDia,$remplazarDia,$i);
            $fechaAct=date('Y',strtotime(request('fechaFin')))."/".date('m',strtotime(request('fechaFin')))."/".$dia;

            if(date('w',strtotime($fechaAct))==0){
                $domingos[] = $dia;
            }
        }

        //return $domingos;

        function encontrarDomingo($array, $buscarValor){
            foreach ($array as $key => $val) {
                if ($val == $buscarValor) {
                    return $val;
                }
            }
            return 0; //No hay domingo
        }

        // Metodo para encontrar festivos
        function encontrarFestivo($array, $buscarValor){
            foreach ($array as $key => $value) {
                if ($key == $buscarValor) {
                    return 1;
                }
            }
            return 0;
        }

        //$buscarValor="2020-01-1";
        //return encontrarFestivo($festivos, $buscarValor);
        $festivo1=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-1";

        foreach ($arreglo as $key => $value) {
            if(("1" == encontrarDomingo($domingos, "1")) or (1 == encontrarFestivo($festivos, $festivo1))){
               if($value == '[{"primero":"A"}]') {
                   $diurnoFestivo += 8;
                   
               }
               else{
                   if($value == '[{"primero":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"primero":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"primero":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"primero":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"primero":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"primero":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"primero":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"primero":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"primero":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"primero":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"primero":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }  
            //return $extraDiurna;
        } 
        //return $extraDiurna;

        $datos = Horario::select('segundo')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo1 = array($datos);  

        $festivo2=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-2";
        
        foreach ($arreglo1 as $key => $value) {
            if(("2" == encontrarDomingo($domingos, "2")) or (2 == encontrarFestivo($festivos, $festivo2))){
               if($value == '[{"segundo":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"segundo":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"segundo":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"segundo":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"segundo":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"segundo":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"segundo":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"segundo":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"segundo":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"segundo":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"segundo":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"segundo":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
            
        }


        $datos = Horario::select('tercero')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo2 = array($datos);  

        $festivo3=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-2";
        foreach ($arreglo2 as $key => $value) {
            if(("3" == encontrarDomingo($domingos, "3")) or (3 == encontrarFestivo($festivos, $festivo3))){
               if($value == '[{"tercero":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"tercero":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"tercero":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"tercero":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"tercero":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"tercero":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"tercero":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"tercero":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"tercero":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"tercero":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"tercero":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"tercero":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('cuarto')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo3 = array($datos); 

        $festivo4=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-4";
        foreach ($arreglo3 as $key => $value) {
            if(("4" == encontrarDomingo($domingos, "4")) or (4 == encontrarFestivo($festivos, $festivo4))){
               if($value == '[{"cuarto":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"cuarto":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"cuarto":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"cuarto":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"cuarto":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"cuarto":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"cuarto":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"cuarto":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"cuarto":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"cuarto":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"cuarto":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"cuarto":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('quinto')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo4 = array($datos); 
        $festivo5=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-5"; 
        
        foreach ($arreglo4 as $key => $value) {
            if(("5" == encontrarDomingo($domingos, "5")) or (5 == encontrarFestivo($festivos, $festivo5))){
               if($value == '[{"quinto":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"quinto":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"quinto":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"quinto":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"quinto":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"quinto":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"quinto":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"quinto":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"quinto":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"quinto":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"quinto":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"quinto":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $datos = Horario::select('sexto')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo5 = array($datos); 
        $festivo6=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-6";  
        
        foreach ($arreglo5 as $key => $value) {
            if(("6" == encontrarDomingo($domingos, "6")) or (6 == encontrarFestivo($festivos, $festivo6))){
               if($value == '[{"sexto":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"sexto":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"sexto":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"sexto":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"sexto":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"sexto":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"sexto":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"sexto":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"sexto":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"sexto":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"sexto":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"sexto":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $datos = Horario::select('septimo')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo6 = array($datos);
        $festivo7=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-7";    
        
        foreach ($arreglo6 as $key => $value) {
            if(("7" == encontrarDomingo($domingos, "7")) or (7 == encontrarFestivo($festivos, $festivo7))){
               if($value == '[{"septimo":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"septimo":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"septimo":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"septimo":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"septimo":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"septimo":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"septimo":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"septimo":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"septimo":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"septimo":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"septimo":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"septimo":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('octavo')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo7 = array($datos); 
        $festivo8=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-8";     
        
        foreach ($arreglo7 as $key => $value) {
            if(("8" == encontrarDomingo($domingos, "8")) or (8 == encontrarFestivo($festivos, $festivo8))){
               if($value == '[{"octavo":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"octavo":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"octavo":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"octavo":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"octavo":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"octavo":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"octavo":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"octavo":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"octavo":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"octavo":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"octavo":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"octavo":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('noveno')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo8 = array($datos); 
        $festivo9=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-9";     
        
        foreach ($arreglo8 as $key => $value) {
            if(("9" == encontrarDomingo($domingos, "9")) or (9 == encontrarFestivo($festivos, $festivo9))){
               if($value == '[{"noveno":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"noveno":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"noveno":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"noveno":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"noveno":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"noveno":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"noveno":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"noveno":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"noveno":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"noveno":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"noveno":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"noveno":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
  
        $datos = Horario::select('decimo')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo9 = array($datos);  
        $festivo10=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-10";     
        
        foreach ($arreglo9 as $key => $value) {
            if(("10" == encontrarDomingo($domingos, "10")) or (10 == encontrarFestivo($festivos, $festivo10))){
               if($value == '[{"decimo":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"decimo":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"decimo":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"decimo":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"decimo":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"decimo":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"decimo":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"decimo":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"decimo":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"decimo":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"decimo":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"decimo":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('once')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo10 = array($datos); 
        $festivo11=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-11";      
        
        foreach ($arreglo10 as $key => $value) {
            if(("11" == encontrarDomingo($domingos, "11")) or (11 == encontrarFestivo($festivos, $festivo11))){
               if($value == '[{"once":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"once":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"once":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"once":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"once":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"once":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"once":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"once":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"once":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"once":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"once":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"once":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('doce')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo11 = array($datos); 
        $festivo12=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-12";       
        
        foreach ($arreglo11 as $key => $value) {
            if(("12" == encontrarDomingo($domingos, "12")) or (12 == encontrarFestivo($festivos, $festivo12))){
               if($value == '[{"doce":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"doce":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"doce":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"doce":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"doce":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"doce":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"doce":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"doce":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"doce":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"doce":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"doce":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"doce":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        $datos = Horario::select('trece')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo12 = array($datos);  
        $festivo13=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-13";       
        
        foreach ($arreglo12 as $key => $value) {
            if(("13" == encontrarDomingo($domingos, "13")) or (13 == encontrarFestivo($festivos, $festivo13))){
               if($value == '[{"trece":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"trece":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"trece":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"trece":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"trece":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"trece":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"trece":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"trece":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"trece":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"trece":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"trece":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"trece":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        $datos = Horario::select('catorce')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo13 = array($datos); 
        $festivo14=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-14";        
        
        foreach ($arreglo13 as $key => $value) {
            if(("14" == encontrarDomingo($domingos, "14")) or (14 == encontrarFestivo($festivos, $festivo14))){
               if($value == '[{"catorce":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"catorce":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"catorce":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"catorce":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"catorce":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"catorce":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"catorce":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"catorce":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"catorce":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"catorce":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"catorce":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"catorce":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('quince')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo14 = array($datos); 
        $festivo15=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-15";         
        
        foreach ($arreglo14 as $key => $value) {
            if(("15" == encontrarDomingo($domingos, "15")) or (15 == encontrarFestivo($festivos, $festivo15))){
               if($value == '[{"quince":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"quince":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"quince":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"quince":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"quince":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"quince":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"quince":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"quince":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"quince":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"quince":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"quince":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"quince":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('dieciseis')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo15 = array($datos);
        $festivo16=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-16";           
        
        foreach ($arreglo15 as $key => $value) {
            if(("16" == encontrarDomingo($domingos, "16")) or (16 == encontrarFestivo($festivos, $festivo16))){
            if($value == '[{"dieciseis":"A"}]') {
                $diurnoFestivo += 8;
            }
            else{
                if($value == '[{"dieciseis":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                }
                else{
                    if($value == '[{"dieciseis":"C"}]'){
                        $nocturnoFestivo += 8;
                    }
                    else{
                        if($value == '[{"dieciseis":"D"}]'){
                            $diurnoFestivo += 8;
                            $extraDiurnaFestiva += 4;
                        }
                        else{
                            if($value == '[{"dieciseis":"N"}]'){
                                $diurnoFestivo += 3;
                                $nocturnoFestivo += 5;
                                $extraNocturnaFestiva += 4;
                            }
                            else{
                                if($value == '[{"dieciseis":"E"}]'){
                                        $diurnoFestivo += 4;
                                }
                                else{
                                    if($value == '[{"dieciseis":"H"}]'){
                                        $diurnoFestivo += 3;
                                        $nocturnoFestivo += 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            }
            else{
                if($value == '[{"dieciseis":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"dieciseis":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"dieciseis":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"dieciseis":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"dieciseis":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('diecisiete')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo16 = array($datos);
        $festivo17=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-17";  
        
        foreach ($arreglo16 as $key => $value) {
            if(("17" == encontrarDomingo($domingos, "17")) or (17 == encontrarFestivo($festivos, $festivo17))){
               if($value == '[{"diecisiete":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"diecisiete":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"diecisiete":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"diecisiete":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"diecisiete":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"diecisiete":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"diecisiete":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"diecisiete":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"diecisiete":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"diecisiete":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"diecisiete":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"diecisiete":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('diesocho')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo17 = array($datos); 
        $festivo18=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-18";   
        
        foreach ($arreglo17 as $key => $value) {
            if(("18" == encontrarDomingo($domingos, "18")) or (18 == encontrarFestivo($festivos, $festivo18))){
               if($value == '[{"diesocho":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"diesocho":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"diesocho":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"diesocho":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"diesocho":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"diesocho":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"diesocho":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"diesocho":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"diesocho":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"diesocho":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"diesocho":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"diesocho":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('diecinueve')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo18 = array($datos); 
        $festivo19=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-19";

        foreach ($arreglo18 as $key => $value) {
            if(("19" == encontrarDomingo($domingos, "19")) or (19 == encontrarFestivo($festivos, $festivo19))){
               if($value == '[{"diecinueve":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"diecinueve":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"diecinueve":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"diecinueve":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"diecinueve":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"diecinueve":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"diecinueve":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"diecinueve":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"diecinueve":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"diecinueve":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"diecinueve":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"diecinueve":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veinte')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo19 = array($datos);
        $festivo20=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-20";  
        
        foreach ($arreglo19 as $key => $value) {
            if(("20" == encontrarDomingo($domingos, "20")) or (20 == encontrarFestivo($festivos, $festivo20))){
               if($value == '[{"veinte":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veinte":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veinte":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veinte":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veinte":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veinte":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veinte":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veinte":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veinte":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veinte":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veinte":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veinte":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintiuno')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo20 = array($datos);  
        $festivo21=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-21";  
        
        foreach ($arreglo20 as $key => $value) {
            if(("21" == encontrarDomingo($domingos, "21")) or (21 == encontrarFestivo($festivos, $festivo21))){
               if($value == '[{"veintiuno":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintiuno":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintiuno":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintiuno":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintiuno":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintiuno":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintiuno":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintiuno":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintiuno":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintiuno":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintiuno":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintiuno":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintidos')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo21 = array($datos);  
        $festivo22=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-22"; 
        
        foreach ($arreglo21 as $key => $value) {
            if(("22" == encontrarDomingo($domingos, "22")) or (22 == encontrarFestivo($festivos, $festivo22))){
               if($value == '[{"veintidos":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintidos":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintidos":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintidos":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintidos":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintidos":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintidos":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintidos":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintidos":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintidos":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintidos":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintidos":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintitres')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo22 = array($datos); 
        $festivo23=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-23";  
        
        foreach ($arreglo22 as $key => $value) {
            if(("23" == encontrarDomingo($domingos, "23")) or (23 == encontrarFestivo($festivos, $festivo23))){
               if($value == '[{"veintitres":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintitres":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintitres":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintitres":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintitres":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintitres":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintitres":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintitres":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintitres":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintitres":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintitres":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintitres":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veinticuatro')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo23 = array($datos);
        $festivo24=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-24";    
        
        foreach ($arreglo23 as $key => $value) {
            if(("24" == encontrarDomingo($domingos, "24")) or (24 == encontrarFestivo($festivos, $festivo24))){
               if($value == '[{"veinticuatro":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veinticuatro":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veinticuatro":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veinticuatro":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veinticuatro":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veinticuatro":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veinticuatro":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veinticuatro":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veinticuatro":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veinticuatro":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veinticuatro":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veinticuatro":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veinticinco')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo24 = array($datos); 
        $festivo25=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-25";     
        
        foreach ($arreglo24 as $key => $value) {
            if(("25" == encontrarDomingo($domingos, "25")) or (25 == encontrarFestivo($festivos, $festivo25))){
               if($value == '[{"veinticinco":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veinticinco":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veinticinco":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veinticinco":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veinticinco":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veinticinco":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veinticinco":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veinticinco":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veinticinco":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veinticinco":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veinticinco":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veinticinco":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintiseis')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo25 = array($datos);
        $festivo26=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-26";       
        
        foreach ($arreglo25 as $key => $value) {
            if(("26" == encontrarDomingo($domingos, "26")) or (26 == encontrarFestivo($festivos, $festivo26))){
               if($value == '[{"veintiseis":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintiseis":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintiseis":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintiseis":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintiseis":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintiseis":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintiseis":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintiseis":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintiseis":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintiseis":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintiseis":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintiseis":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintisiete')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo26 = array($datos);
        $festivo27=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-27";       
        
        foreach ($arreglo26 as $key => $value) {
            if(("27" == encontrarDomingo($domingos, "27")) or (27 == encontrarFestivo($festivos, $festivo27))){
               if($value == '[{"veintisiete":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintisiete":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintisiete":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintisiete":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintisiete":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintisiete":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintisiete":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintisiete":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintisiete":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintisiete":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintisiete":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintisiete":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintiocho')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo27 = array($datos);
        $festivo28=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-28";       
        
        foreach ($arreglo27 as $key => $value) {
            if(("28" == encontrarDomingo($domingos, "28")) or (28 == encontrarFestivo($festivos, $festivo28))){
               if($value == '[{"veintiocho":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintiocho":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintiocho":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintiocho":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintiocho":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintiocho":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintiocho":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintiocho":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintiocho":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintiocho":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintiocho":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintiocho":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('veintinueve')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo28 = array($datos);
        $festivo29=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-29";       
        
        foreach ($arreglo28 as $key => $value) {
            if(("29" == encontrarDomingo($domingos, "29")) or (29 == encontrarFestivo($festivos, $festivo29))){
               if($value == '[{"veintinueve":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"veintinueve":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"veintinueve":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"veintinueve":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"veintinueve":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"veintinueve":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"veintinueve":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"veintinueve":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"veintinueve":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"veintinueve":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"veintinueve":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"veintinueve":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('treinta')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo29 = array($datos);
        $festivo30=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-30";       
        
        foreach ($arreglo29 as $key => $value) {
            if(("30" == encontrarDomingo($domingos, "30")) or (30 == encontrarFestivo($festivos, $festivo30))){
               if($value == '[{"treinta":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"treinta":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"treinta":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"treinta":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"treinta":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"treinta":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"treinta":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"treinta":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"treinta":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"treinta":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"treinta":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"treinta":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        $datos = Horario::select('treintayuno')
        ->where('mes','=',$mesLetras)->where('porteros', '=', $recargo->porteros)
        ->get();
        $arreglo30 = array($datos);
        $festivo31=date('Y',strtotime(request('fechaInicio')))."-".date('m',strtotime(request('fechaInicio')))."-31";       
        
        foreach ($arreglo30 as $key => $value) {
            if(("31" == encontrarDomingo($domingos, "31")) or (31 == encontrarFestivo($festivos, $festivo31))){
               if($value == '[{"treintayuno":"A"}]') {
                   $diurnoFestivo += 8;
               }
               else{
                   if($value == '[{"treintayuno":"B"}]'){
                        $diurnoFestivo += 7;
                        $nocturnoFestivo += 1;
                   }
                   else{
                       if($value == '[{"treintayuno":"C"}]'){
                           $nocturnoFestivo += 8;
                       }
                       else{
                           if($value == '[{"treintayuno":"D"}]'){
                               $diurnoFestivo += 8;
                               $extraDiurnaFestiva += 4;
                           }
                           else{
                               if($value == '[{"treintayuno":"N"}]'){
                                   $diurnoFestivo += 3;
                                   $nocturnoFestivo += 5;
                                   $extraNocturnaFestiva += 4;
                               }
                               else{
                                   if($value == '[{"treintayuno":"E"}]'){
                                        $diurnoFestivo += 4;
                                   }
                                   else{
                                       if($value == '[{"treintayuno":"H"}]'){
                                           $diurnoFestivo += 3;
                                           $nocturnoFestivo += 1;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
            }
            else{
                if($value == '[{"treintayuno":"B"}]'){
                    $ordinarioNocturno += 1;
                }
                else{
                    if($value == '[{"treintayuno":"C"}]'){
                        $ordinarioNocturno += 8;
                    }
                    else{
                        if($value == '[{"treintayuno":"D"}]'){
                            $extraDiurna += 4;
                        }
                        else{
                            if($value == '[{"treintayuno":"N"}]'){
                                $ordinarioNocturno += 5;
                                $extraNocturna += 4;
                            }
                            else{
                                if($value == '[{"treintayuno":"H"}]'){
                                    $ordinarioNocturno += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        /*
        $horas = array($ordinarioNocturno, $diurnoFestivo, $nocturnoFestivo, $extraDiurna, $extraNocturna,
        $extraDiurnaFestiva, $extraNocturnaFestiva);
        return $horas;
        */

        $precioOrdinarioNocturno = $ordinarioNocturno * 1376;
        $precioDiurnoFestivo = $diurnoFestivo * 2948;
        $precioNocturnoFestivo = $nocturnoFestivo * 4323;
        $precioExtraDiurna = $extraDiurna * 4913;
        $precioExtraNocturna = $extraNocturna * 6878;
        $precioExtraDiurnaFestivo = $extraDiurnaFestiva * 7860;
        $precioExtraNocturnaFestivo = $extraNocturnaFestiva * 9825;

        $total = $precioOrdinarioNocturno+$precioDiurnoFestivo+$precioNocturnoFestivo
        +$precioExtraDiurna+$precioExtraNocturna+$precioExtraDiurnaFestivo+$precioExtraNocturnaFestivo;
        //return $total;

        DB::table('recargos')->insert([
            'porteros' => request('idporteros'),
            'ordinarioNoc' => $ordinarioNocturno,
            'diurnoFest' => $diurnoFestivo,
            'nocturnoFes' => $nocturnoFestivo,
            'extraDiurna' => $extraDiurna,
            'extraNocturna' => $extraNocturna,
            'extraDiurnaFest' => $extraDiurnaFestiva,
            'extraNocturnaFest' => $extraNocturnaFestiva,
            'Total' => $total,
        ]);
            //return Response::json("aqui"); 
            return redirect()->route('recargos.dataTable');  
            //$mensajeChimbo = "Liquidado HIJUEPUTA";
            //return $mensajeChimbo;

    }

    public function show(Recargo $recargo)
    {
        
    }

    public function edit(Recargo $recargo)
    {
        
    }
 
    public function update(Request $request, Recargo $recargo)
    {
        
    }

    public function destroy(Recargo $recargo)
    {
        
    }
}
