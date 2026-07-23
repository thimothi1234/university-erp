<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbsubs', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('invoice');
            $table->string('firm');
            $table->string('purpose');
            $table->string('amount');
            $table->string('rimbid');
            
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
        Schema::dropIfExists('reimbsubs');
    }
}
