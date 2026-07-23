<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date');
            $table->string('designation');
            $table->string('paylevel');
            $table->string('type');
            $table->string('idno');
            $table->string('department');
            $table->string('purpose');
            $table->string('proposeddate');
            $table->string('todate');
            $table->string('class');
            $table->string('project');
            $table->string('head');
            $table->string('to');
            $table->string('total');


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
        Schema::dropIfExists('tas');
    }
}
