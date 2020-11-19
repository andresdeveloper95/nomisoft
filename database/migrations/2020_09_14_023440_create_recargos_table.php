<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recargos', function (Blueprint $table) {
            $table->id();
            $table->string('porteros', 10);
            $table->bigInteger('ordinarioNoc');
            $table->bigInteger('diurnoFest');
            $table->bigInteger('nocturnoFes');
            $table->bigInteger('extraDiurna');
            $table->bigInteger('extraNocturna');
            $table->bigInteger('extraDiurnaFest');
            $table->bigInteger('extraNocturnaFest');
            $table->bigInteger('Total');
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
        Schema::dropIfExists('recargos');
    }
}
