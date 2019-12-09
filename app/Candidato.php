<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model{

  protected $fillable = [ 'nome_completo', 'cpf', 'email', 'data_de_nascimento', 'user_id', 'telefone', 'celular', 'nivel_de_formacao','tipo_de_deficiencia', 'funcao'];

  public function user(){
    return $this->belongsTo('App\User', 'user_id');
  }
  public function favorito(){
    return $this->hasMany('App\Favorito');
  }
  // public function endereco(){
  //   return $this->belongsTo('App\Endereco', 'user_id');
  // }
  public function endereco(){
    return $this->hasOne('App\Endereco');
  }
  public function escolaridade(){
    return $this->hasMany('App\Escolaridade');
  }
  public function experiencia(){
    return $this->hasMany('App\Experiencia');
  }



}
