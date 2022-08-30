<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_infos', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',100);
            $table->string('email',100);
            $table->string('password',200);
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('country_information');
            $table->string('phone',20)->nullable();
            $table->string('gender',20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('image',30)->nullable();
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
        Schema::dropIfExists('guest_infos');
    }
}
