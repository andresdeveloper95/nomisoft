<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('porteros', 10)->unsigned();
            $table->string('sede', 45);
            $table->string('mes', 30);
            $table->string('primero', 1);
            $table->string('segundo', 1);
            $table->string('tercero', 1);
            $table->string('cuarto', 1);
            $table->string('quinto', 1);
            $table->string('sexto', 1);
            $table->string('septimo', 1);
            $table->string('octavo', 1);
            $table->string('noveno', 1);
            $table->string('decimo', 1);
            $table->string('once', 1);
            $table->string('doce', 1);
            $table->string('trece', 1);
            $table->string('catorce', 1);
            $table->string('quince', 1);
            $table->string('dieciseis', 1);
            $table->string('diecisiete', 1);
            $table->string('diesocho', 1);
            $table->string('diecinueve', 1);
            $table->string('veinte', 1);
            $table->string('veintiuno', 1);
            $table->string('veintidos', 1);
            $table->string('veintitres', 1);
            $table->string('veinticuatro', 1);
            $table->string('veinticinco', 1);
            $table->string('veintiseis', 1);
            $table->string('veintisiete', 1);
            $table->string('veintiocho', 1);
            $table->string('veintinueve', 1);
            $table->string('treinta', 1);
            $table->string('treintayuno', 1);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
