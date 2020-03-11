<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('first_name');
            $table->string('surname');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('county');
            $table->string('postcode');
            $table->string('country');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('website')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('logo1')->nullable();
            $table->string('logo2')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
