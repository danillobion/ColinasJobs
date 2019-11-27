<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('cadastrar_vaga');
});


#Route::get('/', function(){
#  return view('principal');
#});

#Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('tipo_de_usuario');

  ######### NÃO LOGADO #########

    #oportunidade
Route::get('/resultado', 'CandidatoController@buscarNaoLogado')->name('buscarNaoLogado');
    #candidato
Route::get('/resultado2', 'EmpresaController@buscarNaoLogadoCandidato')->name('buscarNaoLogadoCandidato');

  ########## LOGADO #########

Route::group(['middleware' => 'verifica_email'], function(){

        Route::get('/tipo', function(){return view('tipo_de_usuario');})->name('tipo')->middleware('auth');

        #Candidato

        Route::get('/curriculum', 'CandidatoController@cadastrarCurriculo')->name('curriculum');

        Route::get('/adicionarCurriculum', 'CandidatoController@adicionar')->name('adicionarCurriculum');

        Route::get('/abrir_painel_curriculum', function(){return view('painel_curriculum');})->name('abrir_painel_curriculum');

        Route::get('/mini_curriculum', function(){return view('curriculum');})->name('abrirMiniCurriculo');

        Route::get('/adicionarMiniCurriculo', 'CandidatoController@adicionarMiniCurriculo')->name('adicionarMiniCurriculo');

        Route::get('/adicionarEndereco', 'CandidatoController@adicionarEndereco')->name('adicionarEndereco');

        Route::get('/adicionarEscolaridade', 'CandidatoController@adicionarEscolaridade')->name('adicionarEscolaridade');

        Route::get('/adicionarExperiencias', 'CandidatoController@adicionarExperiencias')->name('adicionarExperiencias');

        Route::get('/editarMiniCurriculo', 'CandidatoController@editarMiniCurriculo')->name('editarMiniCurriculo');

        Route::get('/editarEndereco', 'CandidatoController@editarEndereco')->name('editarEndereco');

        Route::get('/editarExperiencia', 'CandidatoController@editarExperiencia')->name('editarExperiencia');

        Route::get('/editarEscolaridade', 'CandidatoController@editarEscolaridade')->name('editarEscolaridade');

        Route::get('/atualizarMiniCurriculo', 'CandidatoController@atualizarMiniCurriculo')->name('atualizarMiniCurriculo');

        Route::get('/atualizarEndereco', 'CandidatoController@atualizarEndereco')->name('atualizarEndereco');

        Route::get('/atualizarEscolaridade', 'CandidatoController@atualizarEscolaridade')->name('atualizarEscolaridade');

        Route::get('/adicionarEAtualizarEscolaridade', 'CandidatoController@adicionarEAtualizarEscolaridade')->name('adicionarEAtualizarEscolaridade');

        Route::get('/deletarEscolaridade', 'CandidatoController@deletarEscolaridade')->name('deletarEscolaridade');

        Route::get('/atualizarExperiencia', 'CandidatoController@atualizarExperiencia')->name('atualizarExperiencia');

        Route::get('/resultadoOportunidade', 'EmpresaController@buscarOportunidade')->name('buscarOportunidade');

        Route::get('/adicionarMatch', 'CandidatoController@adicionarMatch')->name('adicionarMatch');

        Route::get('/removerInteresseNaVaga', 'CandidatoController@removerInteresseNaVaga')->name('removerInteresseNaVaga');

        Route::get('/removerInteresseNaVagaViewLista', 'CandidatoController@removerInteresseNaVagaViewLista')->name('removerInteresseNaVagaViewLista');

        Route::get('/listar_tenho_interesse', 'CandidatoController@listarMeuInteresse')->name('listarMeuInteresse');


        #Empresa

        Route::get('/oportunidade', 'EmpresaController@cadastrarVaga')->name('oportunidade');

        Route::post('/adicionarOportunidade', 'EmpresaController@adicionar')->name('adicionarOportunidade');

        Route::post('/adicionarEmpresa', 'EmpresaController@adicionarEmpresa')->name('adicionarEmpresa');

        Route::get('/vaga', function(){return view('cadastrar_vaga');})->name('vaga');

        Route::post('/adicionarVaga', 'EmpresaController@adicionarVaga')->name('adicionarVaga');

        Route::get('/resultadoCandidato', 'CandidatoController@buscarCandidato') ->name('buscarCandidato');

        Route::post('/interessenocandidato', 'EmpresaController@interesseNoCandidato')->name('interesseNoCandidato');

        Route::get('/principalempresa', 'EmpresaController@principalEmpresa')->name('principal_empresa');

        Route::post('/enviar/mail', 'EmailController@enviarEmail')->name('enviar_email');

});
