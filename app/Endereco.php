<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['candidato_id', 'empresa_id', 'uf', 'cidade', 'bairro', 'rua', 'numero','complemento', 'vaga_id'];

    public function user(){
        return $this->belongsTo('App\User', 'empresa_id');
    }
    public function empresa(){
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }
    public function vaga(){ //novo
        return $this->hasOne('App\Vaga', 'id');
    }
    public function candidato(){
        return $this->belongsTo('App\Endereco', 'user_id');
    }

}
