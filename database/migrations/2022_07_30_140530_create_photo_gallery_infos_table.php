<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoGalleryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_gallery_info', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('photo_gallery_id')->unsigned();
            $table->foreign('photo_gallery_id')->references('id')->on('photo_gallery');
            $table->longText('caption')->nullable();
            $table->string('click_by',200)->nullable();
            $table->string('image');
            $table->integer('status')->default(1)->nullable();
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
        Schema::dropIfExists('photo_gallery_infos');
    }
}
