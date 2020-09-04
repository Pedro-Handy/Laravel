<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCliente extends Model
{
    protected $table='clientes';
    protected $fillable = [
            'RazaoSocial',
            'nomeFantasia',
            'nomeResponsavel',
            'cnpj',
            'cpf' ,
            'endereco',
            'telefone',
            'celular',
            'email'
    ];

    public function relServico()
    {
        return $this->hasMany('App\Models\ModelServicos','id_cliente','id');
    }
}
