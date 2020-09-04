<?php

namespace App\Http\Controllers;

use App\Models\ModelCliente;
use App\Models\ModelServicos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $objCliente;
    private $objServicos;

    public function __construct()
    {
        $this->middleware('auth');
        $this->objCliente=new ModelCliente();
        $this->objServicos=new ModelServicos();


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('Cadastro_Editar_Cliente');

    }

    public function CCliente(Request $request)
    {
        $validacao = Validator::make($request->all(),
            [
                'RazaoSocial'=>'required|max:60',
                'nomeFantasia'=>'required|max:60',
                'nomeResponsavel'=>'required|max:60',
                'cnpj'=>'required',
                'cpf'=>'required',
                'endereco'=>'required',
                'telefone'=>'required',
                'celular'=>'required',
                'email'=>'required|email|unique:clientes',

            ]);
        if($validacao->fails()){
            return redirect('/home')
                ->withInput()
                ->withErrors($validacao);

        }
        $cliente = new ModelCliente();
        $cliente->nm_RazaoSocial = $request->RazaoSocial;
        $cliente->nm_nomeFantasia = $request->nomeFantasia;
        $cliente->nm_nomeResponsavel = $request->nomeResponsavel;
        $cliente->cd_cnpj = $request->cnpj;
        $cliente->cd_cpf = $request->cpf;
        $cliente->nm_endereco = $request->endereco;
        $cliente->cd_telefone = $request->telefone;
        $cliente->cd_celular = $request->celular;
        $cliente->nm_email = $request->email;
        $cliente->save();
        return redirect('/home');


    }


    public function ECliente()
    {

        $cliente = $this->objCliente->all();
        return view('Listar_Cliente',compact('cliente'));
    }



}
