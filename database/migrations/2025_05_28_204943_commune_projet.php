<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commune_projet', function (Blueprint $table) {
            $table->unsignedBigInteger('projet_id_projet');
            $table->unsignedBigInteger('commune_id_commune');

            $table->foreign('projet_id_projet')->references('id_projet')->on('projets')->onDelete('cascade');
            $table->foreign('commune_id_commune')->references('id_commune')->on('communes')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("commune_projet");
    }
};
