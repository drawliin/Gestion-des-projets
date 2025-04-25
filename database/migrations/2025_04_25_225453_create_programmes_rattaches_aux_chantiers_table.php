<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesRattachesAuxChantiersTable extends Migration
{
    public function up()
    {
        Schema::create('programmes_rattaches_aux_chantiers', function (Blueprint $table) {
            $table->id('id_programme');
            $table->integer('code_du_programme');
            $table->text('description_du_programme')->nullable();
            $table->unsignedBigInteger('id_chantier');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_chantier')->references('id_chantier')->on('chantiers_de_travail');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programmes_rattaches_aux_chantiers');
    }
}
