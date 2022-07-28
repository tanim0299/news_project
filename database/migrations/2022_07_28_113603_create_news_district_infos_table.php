<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsDistrictInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_district_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news_information');
            $table->bigInteger('news_division_id')->unsigned();
            $table->foreign('news_division_id')->references('id')->on('division_information');
            $table->bigInteger('news_district_id')->unsigned();
            $table->foreign('news_district_id')->references('id')->on('district_information');
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
        Schema::dropIfExists('news_district_infos');
    }
}
