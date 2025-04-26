<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainesTable extends Migration
{
    public function up()
    {
        Schema::create('domaines', function (Blueprint $table) {
            $table->id('id_domaine');
            $table->integer('code_du_domaine');
            $table->text('description_fr')->nullable();
            $table->text('description_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domaines');
    }
}

