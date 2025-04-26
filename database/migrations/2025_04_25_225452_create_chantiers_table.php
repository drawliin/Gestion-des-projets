<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiersTable extends Migration
{
    public function up()
    {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->id('id_chantier');
            $table->integer('code_du_chantier');
            $table->text('description_du_chantier')->nullable();
            $table->unsignedBigInteger('id_domaine');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_domaine')->references('id_domaine')->on('domaines');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chantiers');
    }
}

