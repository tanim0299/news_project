<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsSubMenuInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_sub_menu_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news_information');
            $table->bigInteger('news_menu_id')->unsigned();
            $table->foreign('news_menu_id')->references('id')->on('news_menu');
            $table->bigInteger('news_submenu_id')->unsigned();
            $table->foreign('news_submenu_id')->references('id')->on('news_sub_menu');
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
        Schema::dropIfExists('news_sub_menu_infos');
    }
}
