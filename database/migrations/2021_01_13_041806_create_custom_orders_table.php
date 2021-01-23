<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string("orderUUID");
            $table->integer("shape");
            $table->integer("body_wood");
            $table->integer("top_wood")->nullable();
            $table->integer("neck_pieces")->nullable();
            $table->integer("neck_woods")->nullable();
            $table->integer("fret_wood")->nullable();
            $table->integer("neck_type")->nullable();
            $table->integer("frets_type")->nullable();  //stainless or nickle etc..
            $table->integer("inlays")->nullable();
            $table->string("custom_inlay_option")->nullable();
            $table->integer("fret_count");
            $table->integer("fret_radius")->nullable();
            $table->integer("scale_length")->nullable();
            $table->integer("pickup_configuration")->nullable();
            $table->integer("neck_pickup")->nullable();
            $table->integer("middle_pickup")->nullable();
            $table->integer("bridge_pickup");
            $table->integer("bridge")->nullable();
            $table->integer("electronics")->nullable();
            $table->integer("nut")->nullable();
            $table->integer("pickup_selector")->nullable();
            $table->integer("body_finish")->nullable();
            $table->integer("top_finish")->nullable();
            $table->integer("neck_finish")->nullable();
            $table->text("image_urls")->nullable();
            $table->integer("natural_finish")->nullable();
            $table->integer("standard_color")->nullable();
            $table->integer("translucent_color")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('custom_orders');
    }
}
