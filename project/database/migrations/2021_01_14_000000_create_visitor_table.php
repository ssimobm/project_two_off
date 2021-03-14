<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->string('type');
            $table->string('type_id');
            $table->string('visitor');
            $table->string('ip');
            $table->string('Agent');
            $table->string('referrer')->nullable();
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
        Schema::dropIfExists('visitor');
    }
}
