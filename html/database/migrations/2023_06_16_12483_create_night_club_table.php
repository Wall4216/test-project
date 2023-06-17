<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNightClubTable extends Migration
{
    public function up()
    {
        Schema::create('night_club', function (Blueprint $table) {
            $table->id();
            $table->string('music_genre');
            $table->integer('people_count')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('night_club');
    }
}

