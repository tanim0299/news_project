<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilaInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upazila_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('country_information');
            $table->bigInteger('division_id')->unsigned();
            $table->foreign('division_id')->references('id')->on('division_information');
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('district_information');
            $table->string('upazila_name',200);
            $table->string('status',10);
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
        Schema::dropIfExists('upazila_informations');
    }
}
