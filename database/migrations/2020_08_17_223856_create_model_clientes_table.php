<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_RazaoSocial');
            $table->string('nm_nomeFantasia');
            $table->string('cd_cnpj',18);
            $table->string('nm_endereco');
            $table->string('cd_telefone');
            $table->string('nm_email');
            $table->string('nm_nomeResponsavel');
            $table->string('cd_cpf',15);
            $table->string('cd_celular');
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
        Schema::dropIfExists('clientes');
    }
}
