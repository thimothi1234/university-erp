<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeTaxDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_tax_data', function (Blueprint $table) {
    $table->id();
    $table->integer('month_index');
    $table->decimal('basic', 10, 2)->nullable();
    $table->decimal('da', 10, 2)->nullable();
    $table->decimal('hra', 10, 2)->nullable();
    $table->decimal('ta', 10, 2)->nullable();
    $table->decimal('tada', 10, 2)->nullable();
    $table->decimal('total', 10, 2)->nullable();
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
        Schema::dropIfExists('income_tax_data');
    }
}
