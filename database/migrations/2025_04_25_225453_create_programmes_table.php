<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id('id_programme');
            $table->string('code_du_programme');
            $table->text('description_du_programme')->nullable();
            $table->unsignedBigInteger('id_chantier');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_chantier')->references('id_chantier')->on('chantiers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programmes');
    }
}
