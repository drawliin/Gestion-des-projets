<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id('id_commune');
            $table->string('code_commune', 100);
            $table->string('nom_fr', 400);
            $table->string('nom_ar', 400);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('communes');
    }
}

