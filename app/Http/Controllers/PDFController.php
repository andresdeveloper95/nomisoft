<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function downloadd()
    {
        $pdf = PDF::loadView('guiaTurnos');
        return $pdf->stream('ayuda.pdf');
    }

    public function jenifer() 
    {
        $pdff = PDF::loadView('guiaLogin');
        return $pdff->download('ayudaLogin.pdf');
    }

    public function ayudaPortero()
    {
        $pdf = PDF::loadView('guiaPorteros');
        return $pdf->stream('ayudaPorteros.pdf');
    }

    public function ayudaliquidacion()
    {
        $pdf = PDF::loadView('guiaLiquidacion');
        return $pdf->stream('ayudaLiquidacion.pdf');
    }

    public function ayudaRecargos()
    {
        $pdf = PDF::loadView('guiaMostrarRecargos');
        return $pdf->stream('ayudaRecargos.pdf');
    }

    public function ayudaHorario()
    {
        $pdf = PDF::loadView('guiaHorario');
        return $pdf->stream('ayudaHorario.pdf');
    }

    public function ayudaconsultarHorario()
    {
        $pdf = PDF::loadView('guiaconsultarhorario');
        return $pdf->stream('ayudaConsultarHorario.pdf');
    }
}
