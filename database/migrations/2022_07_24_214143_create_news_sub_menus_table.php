<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_sub_menu', function (Blueprint $table) {
            $table->id();
            $table->string('sl');
            $table->bigInteger('news_menuid')->unsigned();
            $table->foreign('news_menuid')->references('id')->on('news_menu');
            $table->string('news_submenu_name',100);
            $table->string('status',10);
            $table->string('admin_id',20);
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
        Schema::dropIfExists('news_sub_menus');
    }
}
