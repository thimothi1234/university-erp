<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalsubs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('invoice');
            $table->string('date');
            $table->string('quantity');
            $table->string('amount');
            $table->string('pid');

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
        Schema::dropIfExists('medicalsubs');
    }
}
