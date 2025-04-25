<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousProjetsLocalisesTable extends Migration
{
    public function up()
    {
        Schema::create('sous_projets_localises', function (Blueprint $table) {
            $table->unsignedBigInteger('id_province');
            $table->unsignedBigInteger('id_commune');
            $table->unsignedBigInteger('id_projet');

            $table->string('code_du_sous_projet');
            $table->string('nom_du_sous_projet', 100)->nullable();
            $table->string('secteur_concerne', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('centre', 100)->nullable();
            $table->string('surface', 50)->nullable();
            $table->string('statut', 50)->nullable();
            $table->string('lineaire', 100)->nullable();
            $table->text('douars_desservis')->nullable();
            $table->text('source_de_financement')->nullable();
            $table->text('nature_de_l_intervention')->nullable();
            $table->text('beneficiaire')->nullable();
            $table->decimal('estimation_initiale', 20, 2)->nullable();
            $table->string('avancement_physique', 50)->nullable();
            $table->string('avancement_financier', 50)->nullable();
            $table->text('commentaires')->nullable();
            $table->text('localite')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_province')->references('id_province')->on('provinces');
            $table->foreign('id_commune')->references('id_commune')->on('communes');
            $table->foreign('id_projet')->references('id_projet')->on('projets_principaux');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sous_projets_localises');
    }
}

