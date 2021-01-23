<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wood', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('is_body')->nullable();//body, top, neck, fretboard, etc
            $table->string('is_top')->nullable();
            $table->string('is_neck')->nullable();
            $table->string('is_fretboard')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('wood');
    }
}
