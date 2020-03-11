<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('client_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->integer('engineer_id')->nullable();
            $table->date('start_date');
            $table->string('job_ref');
            $table->string('description');
            $table->string('material_use');
            $table->string('signature')->nullable();
            $table->string('customer_name');
            $table->date('customer_complete_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
