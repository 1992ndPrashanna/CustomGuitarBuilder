<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('brand');
            $table->integer('position');
            $table->integer('type');
            $table->integer('active_passive');
            $table->integer('conductors')->nullable();
            $table->integer('magnet_material')->nullable();
            $table->string('strings');
            $table->integer('covering');
            $table->float('price',5,2);
            $table->text('description')->nullable();
            $table->text('image_urls');
            $table->string('signatures_series')->nullable();
            $table->string('signature_artist')->nullable();
            $table->text('website')->nullable();
            $table->string('stock');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickups');
    }
}
