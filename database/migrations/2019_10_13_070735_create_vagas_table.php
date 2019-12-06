<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('empresa_id');
            $table->integer('endereco_id')->nullable(); //novo
            $table->date('data_publicacao')->nullable();
            $table->string('nome_vaga')->nullable();
            $table->string('atribuicoes')->nullable();
            $table->string('experiencia')->nullable();
            $table->string('descricao')->nullable();
            $table->integer('quantidade')->nullable();
            $table->float('salario');
            $table->boolean('vaga_para_pcd')->nullable();
            $table->string('tipo_de_vaga')->nullable();
            $table->string('tipo_de_remuneracao')->nullable();
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
        Schema::dropIfExists('vagas');
    }
}
