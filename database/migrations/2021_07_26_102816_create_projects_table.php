<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('funding_agency');
            $table->string('whether');
            $table->string('start_date');
            $table->string('agreement');
            $table->string('sanctioned');
            $table->string('type');
            $table->string('date');
            $table->string('duration');
            $table->string('end_date');
            $table->string('project_no');
            $table->string('pfms');
            $table->string('remarks');
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
        Schema::dropIfExists('projects');
    }
}
