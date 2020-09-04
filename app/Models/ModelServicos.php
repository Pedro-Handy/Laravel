<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelServicos extends Model
{
    protected $table='servicos';
    protected $fillable=[

        'nm_endereco'=>'required',
        'nm_servico'=>'required',
        'vl_total'=>'required|numeric',
        'vl_sinal'=>'required|numeric',
        'qt_parcelas'=>'required|numeric',
        'vl_parcelas'=>'required|numeric',
        'dt_iniciopg'=>'required|date|after_or_equal:tomorrow',
        'dt_parcelas'=>'required|date|after:tomorrow',
        'nm_status'=>'required'

    ];

    public function relCliente()
    {
        return $this->hasOne('App\Models\ModelCliente','id','id_cliente');
    }

}
