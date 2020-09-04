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
                                @if(isset($servico)) Editar Servico @else Cadastrar Servico @endif
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Botões -->
                        <div class="col-md-4">
                            <a href="{{ url('home') }}">
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
                            @if(isset($servico))
                                <form role="form" action="{{url("/EServico/$servico->id")}}" method="POST">
                                    @method('PUT')
                            @else
                                <form role="form" action="{{url("/EServico")}}" method="POST">
                            @endif

                                            @csrf
                                            <div class="form-group">

                                                <label for="text">
                                                    Cliente
                                                </label>
                                                <select type="text" class="form-control" id="text" name="id_cliente">
                                                    @if(isset($servico))
                                                        <option value="{{$EclienteId}}">{{$EclienteNomeFantasia}}</option>
                                                    @else
                                                        <option value="">Selecione</option>
                                                    @endif
                                                    @foreach($cliente as $clientes)
                                                        <option value="{{$clientes->id}}">{{$clientes->nm_nomeFantasia}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Endereço
                                                </label>
                                                <input type="text" maxlength="180" class="form-control" id="text" name="nm_endereco" value="{{$servico->nm_endereco ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Serviço
                                                </label>
                                                <input type="text" maxlength="180" class="form-control" id="text" name="nm_servico" value="{{$servico->nm_servico ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Valor Total
                                                </label>
                                                <input type="text" maxlength="20" class="form-control" id="text" name="vl_total" value="{{$servico->vl_total ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Valor Sinal
                                                </label>
                                                <input type="text" maxlength="20" class="form-control" id="text" name="vl_sinal" value="{{$servico->vl_sinal ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Quantidade de Parcelas
                                                </label>
                                                <input type="text" maxlength="3" class="form-control" id="text" name="qt_parcelas" value="{{$servico->qt_parcelas ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Valor das Parcelas
                                                </label>
                                                <input type="text" maxlength="20" class="form-control" id="text" name="vl_parcelas" value="{{$servico->vl_parcelas ?? ''}}"/>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Data de Inicio de Pagamento
                                                </label>
                                                <input type="date"  class="form-control" placeholder="dd/mm/aaaa " id="text" name="dt_iniciopg" value="{{$servico->dt_iniciopg ?? ''}}" />
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Data das Parcelas
                                                </label>
                                                <input type="date" class="form-control" id="text" placeholder="dd/mm/aaaa " name="dt_parcelas" value="{{$servico->dt_parcelas ?? ''}}" />
                                            </div>
                                            <div class="form-group">

                                                <label for="exampleInputFile">
                                                    Anexar Arquivo (PDF ou DOC)
                                                </label>
                                                <input type="file" class="form-control-file" id="exampleInputFile" name="qv_arquivo" value="{{$servico->qv_arquivo ?? ''}}"/>
                                                <p class="help-block">

                                                </p>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">
                                                    Status
                                                </label>
                                                <select type="text" class="form-control" id="text" name="nm_status">
                                                    <option value="{{$servico->nm_status ?? ''}}">{{$servico->nm_status ?? ''}}</option>
                                                    <option value="Aberto">Aberto</option>
                                                    <option value="Fechado">Fechado</option>

                                                </select>
                                            </div>
                                            <div class="form-group">

                                                <label for="text">
                                                    Data da Proposta
                                                </label>
                                                <input type="text" display="false" readonly="true" class="form-control " id="id_01" name="dt_proposta" value="{{$servico->dt_proposta ?? ''}}"/>
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
