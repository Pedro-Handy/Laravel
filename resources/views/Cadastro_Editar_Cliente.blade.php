@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @guest

        @else
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">
                            @if(isset($cliente)) Editar Cliente @else Cadastrar Cliente @endif
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <!-- Botões -->
                    <div class="col-md-4">
                        <a href="{{ route('home') }}">
                        <button type="button" class="btn btn-md btn-block btn-secondary"  >
                            Cadastro Cliente
                        </button></a>
                        <a href="{{ url('ECliente') }}">
                        <button type="button" class="btn btn-block btn-secondary">
                            Editar Cliente
                        </button></a>
                        <a href="{{ url('/EServico/create') }}">
                        <button type="button" class="btn btn-block btn-secondary">
                            Cadastro Proposta
                        </button></a>
                        <a href="{{ url('/EServico') }}">
                        <button type="button" class="btn btn-block btn-secondary">
                            Buscar/Editar Proposta
                        </button></a>

                    </div>
                    <!-- Formulario -->
                    <div class="col-md-8" >
                        @include('error')
                        @if(isset($cliente))
                            <form role="form" action="{{url("/ECliente/$cliente->id")}}" method="POST">
                                @method('PUT')

                        @else
                            <form role="form" action="{{url("/ECliente")}}" method="POST">

                        @endif



                                @csrf
                                <div class="form-group">

                                    <label for="text">
                                        Razão Social
                                    </label>
                                    <input type="text" maxlength="180" class="form-control" id="text" name="RazaoSocial" value="{{$cliente->nm_RazaoSocial ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        Nome Fantasia
                                    </label>
                                    <input type="text" maxlength="180" class="form-control" id="text" name="nomeFantasia" value="{{$cliente->nm_nomeFantasia ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        Nome do Responsavel
                                    </label>
                                    <input type="text" maxlength="180" class="form-control" id="text" name="nomeResponsavel" value="{{$cliente->nm_nomeResponsavel ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        CNPJ
                                    </label>
                                    <input type="text" class="form-control" id="text" name="cnpj" onkeypress="$(this).mask('00.000.000/0000-00')" value="{{$cliente->cd_cnpj ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        CPF
                                    </label>
                                    <input type="text"  class="form-control" id="text" name="cpf" onkeypress="$(this).mask('000.000.000-00') ;" value="{{$cliente->cd_cpf ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        Endereço
                                    </label>
                                    <input type="text" maxlength="180" class="form-control" id="text" name="endereco" value="{{$cliente->nm_endereco ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        Telefone
                                    </label>
                                    <input type="text" class="form-control" id="text" name="telefone" onkeypress="$(this).mask('(00) 0000-00009')" value="{{$cliente->cd_telefone ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="text">
                                        Celular
                                    </label>
                                    <input type="text" class="form-control" id="text" name="celular" onkeypress="$(this).mask('(00) 0000-00009')" value="{{$cliente->cd_celular ?? ''}}"/>
                                </div>
                                <div class="form-group">

                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" maxlength="180" class="form-control" id="text" name="email" value="{{$cliente->nm_email ?? ''}}"/>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </form>

                            </form>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</div>
@endsection
