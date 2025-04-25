<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsPrincipauxTable extends Migration
{
    public function up()
    {
        Schema::create('projets_principaux', function (Blueprint $table) {
            $table->id('id_projet');
            $table->string('code_du_projet');
            $table->string('nom_du_projet', 100);
            $table->decimal('cout_cro', 20, 2)->nullable();
            $table->decimal('cout_total_du_projet', 20, 2)->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin_prevue')->nullable();
            $table->string('etat_d_avancement_physique', 50)->nullable();
            $table->string('etat_d_avancement_financier', 50)->nullable();
            $table->text('commentaires')->nullable();

            $table->unsignedBigInteger('id_domaine');
            $table->unsignedBigInteger('id_chantier');
            $table->unsignedBigInteger('id_programme');

            $table->timestamps();

            // Foreign keys
            $table->foreign('id_domaine')->references('id_domaine')->on('domaines_thematiques');
            $table->foreign('id_chantier')->references('id_chantier')->on('chantiers_de_travail');
            $table->foreign('id_programme')->references('id_programme')->on('programmes_rattaches_aux_chantiers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projets_principaux');
    }
}
