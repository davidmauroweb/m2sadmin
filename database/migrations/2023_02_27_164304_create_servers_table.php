<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->tinyIncrements('idServer');
            $table->string('marca', 40)->nulleable('false');
            $table->ipAddress('ip')->nulleable('false');
            $table->smallInteger('cap')->nulleable('fales');
            $table->string('nombre', 10)->nulleable('fales');
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
        Schema::dropIfExists('servers');
    }
}
