<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nm_endereco');
            $table->string('nm_servico');
            $table->float('vl_total',10,2);
            $table->float('vl_sinal',10,2);
            $table->integer('qt_parcelas');
            $table->float('vl_parcelas',10,2);
            $table->date('dt_iniciopg');
            $table->date('dt_proposta');
            $table->date('dt_parcelas');
            $table->binary('qv_arquivo')->nullable();
            $table->string('nm_status');
            $table->rememberToken();
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
        Schema::dropIfExists('servicos');
    }
}
