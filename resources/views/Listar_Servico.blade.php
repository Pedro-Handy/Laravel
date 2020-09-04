@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @guest

            @else
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">
                                Editar Cliente
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Botões -->
                        <div class="col-md-4" >
                            <a href="{{ url('/home') }}">
                                <button type="button" class="btn btn-md btn-block btn-secondary"  >
                                    Cadastro Cliente
                                </button></a>
                            <a href="{{ url('/ECliente') }}">
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
                        <!-- Busca -->
                        <div class="col-md-8">
                            <form role="form" action="{{ route('buscar') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="text">
                                        Buscar por Status:
                                    </label>
                                    <!-- <input type="text" class="form-control" id="text" name="criterio"/> -->
                                    <select type="text" class="form-control" id="text" name="criterio">
                                        <option value="Aberto">Aberto</option>></option>
                                        <option value="Fechado">Fechado</option>></option>
                                        <option value="Aprovado">Aprovado</option>></option>
                                    </select>
                                </div>

                                <a><button type="submit" class="btn btn-primary">Filtrar</button></a>
                            </form>
                            @include('error')
                        </div>
                    </div>
                    <div class="row">
                        <!-- Listagem -->
                        <div class="col-md-12">
                            @csrf
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Data da Proposta</th>
                                    <th scope="col">Inicio do Pgto.</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Parcelas</th>
                                    <th scope="col">Sinal</th>
                                    <th scope="col">Valor da Parcela</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($servico as $servicos)
                                    <form role="form" action="{{ route('editarStatus',$servicos->id) }}" method="POST">

                                        @csrf
                                        <tr>
                                            <th scope="row">{{$servicos->id}}</th>
                                            <td>{{$servicos->nm_RazaoSocial}}</td>
                                            <td>{{$servicos->dt_proposta}}</td>
                                            <td>{{$servicos->dt_iniciopg}}</td>
                                            <td>{{$servicos->nm_servico}}</td>
                                            <td>{{$servicos->qt_parcelas}}</td>
                                            <td>R$ {{$servicos->vl_sinal}}</td>
                                            <td>R$ {{$servicos->vl_parcelas}}</td>
                                            <td>R$ {{$servicos->vl_total}}</td>
                                            <td>
                                                <!-- 'servicos.dt_proposta','servicos.dt_iniciopg','servicos.nm_servico','servicos.qt_parcelas','servicos.vl_sinal',
                                                'servicos.vl_parcelas','servicos.vl_total'
                                                 -->
                                                <select type="text" class="form-control" id="text" name="nm_status">
                                                    <option value="{{$servicos->nm_status}}">{{$servicos->nm_status}}</option>
                                                    <option value="Aberto">Aberto</option>
                                                    <option value="Fechado">Fechado</option>
                                                    <option value="Aprovado">Aprovado</option>

                                                </select></td>
                                            <td>
                                                <button type="submit" class="btn btn-secondary">Salvar</button>


                                                <a href="{{ url("/EServico/$servicos->id") }}" class="js-del"><button class="btn btn-danger">Deletar</button> </a>
                                    </form>

                                    <a href="{{ url("/EServico/$servicos->id/edit") }}" ><button class="btn btn-primary">Editar</button> </a>

                                            </td>


                                        </tr>




                                @endforeach
                                <a  href="{{route('excel')}}"><button class="btn btn-primary">Exportar</button> </a>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
@endsection
