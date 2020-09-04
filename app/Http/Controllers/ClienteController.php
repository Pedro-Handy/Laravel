<?php

namespace App\Http\Controllers;

use App\Models\ModelCliente;
use App\Models\ModelServicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = $this->objCliente->all();
        return view('Listar_Cliente',compact('cliente'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $objCliente;
    private $objServicos;

    public function __construct()
    {
        $this->middleware('auth');
        $this->objCliente=new ModelCliente();
        $this->objServicos=new ModelServicos();


    }
    public function create()
    {
        $cliente=$this->objCliente->all();
        return view('Listar_Cliente',compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = Validator::make($request->all(),
            [
                'RazaoSocial'=>'required|max:80',
                'nomeFantasia'=>'required|max:80',
                'nomeResponsavel'=>'required|max:80',
                'cnpj'=>'required|unique:clientes,cd_cnpj|min:18',
                'cpf'=>'required|unique:clientes,cd_cpf|min:14',
                'endereco'=>'required|max:150',
                'telefone'=>'required|max:20',
                'celular'=>'required|max:20',
                'email'=>'required|email|',

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

        return redirect('/ECliente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servico = ModelServicos::select('*')->where('id_cliente','LIKE',''.$id.'')->get();
        return view('Listar_Servico',compact('servico'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente=$this->objCliente->find($id);
        $servico=$this->objServicos->find($id);
        return view('Cadastro_Editar_Cliente',compact('cliente','servico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validacao = Validator::make($request->all(),
            [
                'RazaoSocial'=>'required|max:80',
                'nomeFantasia'=>'required|max:80',
                'nomeResponsavel'=>'required|max:80',
                'cnpj'=>'required|unique:clientes,cd_cnpj|min:18',
                'cpf'=>'required|unique:clientes,cd_cpf|min:14',
                'endereco'=>'required|max:150',
                'telefone'=>'required|max:20',
                'celular'=>'required|max:20',
                'email'=>'required|email|',

            ]);
        if($validacao->fails()){
            return redirect('/ECliente')

                ->withErrors($validacao);

        }

        $this->objCliente->where(['id'=>$id])->update([
            'nm_RazaoSocial' => $request->RazaoSocial,
            'nm_nomeFantasia' => $request->nomeFantasia,
            'nm_nomeResponsavel' => $request->nomeResponsavel,
            'cd_cnpj' => $request->cnpj,
            'cd_cpf' => $request->cpf,
            'nm_endereco' => $request->endereco,
            'cd_telefone' => $request->telefone,
            'cd_celular' => $request->celular,
            'nm_email' => $request->email


        ]);
        return redirect('/ECliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objCliente->destroy($id);
        return($del)?"sim":"não";
    }
}
