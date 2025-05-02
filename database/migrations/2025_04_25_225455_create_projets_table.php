<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
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

            $table->unsignedBigInteger('id_province')->nullable();
            $table->unsignedBigInteger('id_commune')->nullable();
            $table->unsignedBigInteger('id_programme');

            $table->timestamps();

            // Foreign keys
            $table->foreign('id_programme')->references('id_programme')->on('programmes');
            $table->foreign('id_province')->references('id_province')->on('provinces');
            $table->foreign('id_commune')->references('id_commune')->on('communes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
