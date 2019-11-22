<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolaridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolaridades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidato_id')->nullable();
            $table->string('nivel_de_formacao')->nullable();
            $table->string('instituicao')->nullable();
            $table->string('curso')->nullable();
            $table->string('status')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escolaridades');
    }
}
