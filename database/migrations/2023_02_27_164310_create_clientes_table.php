<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->smallIncrements('idCliente')->nulleable('false');
            $table->tinyText('nombre')->nulleable('false');
            $table->tinyText('direccion')->nulleable('false');
            $table->tinyText('telefono')->nulleable('false');
            $table->tinyText('mail')->nulleable('false');
            $table->text('detalle')->nulleable('true');
            $table->unsignedTinyInteger('idPlan')->nulleable('false');
            $table->unsignedTinyInteger('idServer')->nulleable('false');
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
        Schema::dropIfExists('clientes');
    }
}
