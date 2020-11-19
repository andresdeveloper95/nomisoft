<?php

namespace App\Http\Controllers;

use App\User;
use App\Turno;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    

    public function __construct()
    {
        $this->middleware('auth');
    }

   public function dataTable()
   {
        
        //$usuarios=User::all();
        $porteros=User::where("rol","=","P")->get();
        return view('dataTable',compact("porteros"));
   }

    public function index()
    {   
        $turnos=Turno::all();
        $porteros=User::where("rol","=","P")->get();        
        return view('principal', compact('turnos', 'porteros')); 
    }

    public function show(User $usuario)
    {
        //$usuarios=User::all();
        $porteros=User::where("rol","=","P")->get();
        return view('dataTable', compact('porteros')); 
    }

    public function create()
    {
        
    }

    public function store(Request $request)
        {
            $validatorNormal = \Validator::make($request->all(), [
                'email' => 'required|unique:users,email'
            ]);  
        
            if ($validatorNormal->fails()) {
                $message = "El email ". $request->email." del portero ya existe";
             return Response::json("no se pudo");
            }     

            $pass = Hash::make("univalle123");
            if($request->ajax()){

                $portero = new User;
                $portero->cedula     =   $request->cedula;
                $portero->name    =   $request->name;
                $portero->apellidos  =   $request->apellidos;
                $portero->direccion  =   $request->direccion;
                $portero->telefono  =   $request->telefono;
                $portero->email  =   $request->email;
                $portero->rol = "P";
                $portero->password = $pass;
                $portero->save();
                return Response::json("Se creo");   
                return redirect()->route('porteros.listar');
            }       
    }

    public function edit(User $user)
    {
        return view('editar',compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name'=>request('name'),
            'apellidos'=>request('apellidos'),
            'direccion'=>request('direccion'),
            'telefono'=>request('telefono'),
        ]);
    }


    public function destroy(Request $request)
    {
        if($request->ajax()){
             $portero = User::find($request->id);
             $portero->delete();
        }
    }
}