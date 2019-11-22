<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    protected $fillable = [ 'candidato_id', 'nivel_de_formacao','instituicao','status', 'curso', 'data_inicio', 'data_conclusao'];

  public function candidato(){
    return $this->belongsTo('App\Candidato', 'candidato_id');
  }
}
