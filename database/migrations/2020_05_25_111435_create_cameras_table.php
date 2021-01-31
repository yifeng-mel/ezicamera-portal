<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            
            $table->string('serial_number')->unique();
            $table->string('board_name');
            $table->string('color');
            
            $table->float('price', 8, 2)->nullable();
            $table->string('url')->nullable()->unique();
            $table->text('public_key')->nullable();

            $table->string('user_email')->nullable();
            $table->string('user_date_of_birth')->nullable();

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
        Schema::dropIfExists('cameras');
    }
}
