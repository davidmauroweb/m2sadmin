<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->smallIncrements('idPresupuesto')->nulleable('false');
            $table->tinyText('nom')->nulleable('false');
            $table->text('esc')->nulleable('false');
            $table->text('sol')->nulleable('false');
            $table->text('pro')->nullable();
            $table->integer('valor')->nullable();
            $table->boolean('ok')->default('0');
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
        Schema::dropIfExists('presupuestos');
    }
}
