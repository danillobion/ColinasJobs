<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $fillable = [ 'empresa_id', 'data_publicacao', 'nome_vaga', 'atribuicoes', 'experiencia', 'descricao', 'quantidade', 'salario', 'vaga_para_pcd', 'tipo_de_vaga', 'tipo_de_remuneracao', 'funcao'];

    // public function user(){
    //     return $this->belongsTo('App\User', 'empresa_id');
    // }
    public function empresa(){
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }
    public function favorito(){
      return $this->hasMany('App\Favorito');
    }
    public function endereco(){ //novo
        return $this->hasOne('App\Endereco', 'vaga_id');
    }

    public function match(){
        return $this->hasMany('App\Match');
      }
}
