<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempadvsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempadvsubs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('firm');
            $table->string('details');
            $table->string('qty');
            $table->string('rate');
            $table->string('amount');
            $table->string('rid');
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
        Schema::dropIfExists('tempadvsubs');
    }
}
