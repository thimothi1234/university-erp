<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaySheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_sheet_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pay_sheet_id'); // Foreign key to PaySheet
            $table->string('head_name'); // Name of head
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['allowance', 'deduction']); // Deduction or Allowance
            $table->timestamps();
    
            $table->foreign('pay_sheet_id')->references('id')->on('pay_sheets')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_sheet_details');
    }
}
