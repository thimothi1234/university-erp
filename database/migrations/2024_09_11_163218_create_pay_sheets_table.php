<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->string('month_with_year'); // e.g., "June 2024"
            $table->string('pay_id');
            $table->string('designation');
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
        Schema::dropIfExists('pay_sheets');
    }
}
