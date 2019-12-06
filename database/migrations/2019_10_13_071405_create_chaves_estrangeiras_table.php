<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChavesEstrangeirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('empresas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('escolaridades', function (Blueprint $table){
            $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
        Schema::table('experiencias', function (Blueprint $table){
          $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
        Schema::table('cargos', function (Blueprint $table){
          $table->foreign('experiencia_id')->references('id')->on('candidatos');
        });
        Schema::table('vagas', function (Blueprint $table){
          $table->foreign('empresa_id')->references('id')->on('empresas');
        });
        Schema::table('favoritos', function (Blueprint $table){
          $table->foreign('vaga_id')->references('id')->on('vagas');
          $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
        Schema::table('empresas', function (Blueprint $table){
          $table->foreign('endereco_id')->references('id')->on('enderecos');
        });
        // Schema::table('vagas', function (Blueprint $table){ //novo
        //     $table->foreign('endereco_id')->references('id')->on('enderecos');
        // });
        Schema::table('enderecos', function (Blueprint $table){ //novo
            $table->foreign('vaga_id')->references('id')->on('vagas');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chaves_estrangeiras');
    }
}
