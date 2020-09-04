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
                                Editar Cliente
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Botões -->
                        <div class="col-md-4">
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
                        <!-- Listagem -->
                        <div class="col-md-8">
                            @include('error')
                            @csrf
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome Fantasia</th>
                                    <th scope="col">Responsavel</th>
                                    <th scope="col">Email</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cliente as $clientes)
                                    <tr>
                                        <th scope="row">{{$clientes->id}}</th>
                                        <td>{{$clientes->nm_nomeFantasia}}</td>
                                        <td>{{$clientes->nm_nomeResponsavel}}</td>
                                        <td>{{$clientes->nm_email}}
                                        <td>
                                            <a href="{{ url("/ECliente/$clientes->id/edit") }}" ><button class="btn btn-primary">Editar</button> </a>
                                            <a href="{{ route('mostrarPropostas',$clientes->id) }}" ><button class="btn btn-secondary">Propostas</button> </a>
                                            <a href="{{ url("/ECliente/$clientes->id") }}" class="js-del"><button class="btn btn-danger">Deletar</button> </a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
@endsection
