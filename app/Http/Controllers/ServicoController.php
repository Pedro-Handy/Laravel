<?php

namespace App\Http\Controllers;

use App\Models\ModelCliente;
use App\Models\ModelServicos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\dbcs;
use Illuminate\Support\Facades\Validator;
use App\Exports\ServicosFromView;
use Maatwebsite\Excel\Facades\Excel;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $objCliente;
    private $objServicos;

    public function index()
    {
        //dd($this->objServicos->find(1)->relCliente);
        //$servico = $this->objServicos->relCliente->nm_razaoSocial;
        $servico = ModelServicos::select('servicos.id','servicos.dt_proposta','servicos.dt_iniciopg',
            'servicos.nm_servico','servicos.qt_parcelas','servicos.vl_sinal',
            'servicos.vl_parcelas','servicos.vl_total','servicos.nm_status','clientes.nm_RazaoSocial')
            ->join('clientes','servicos.id_cliente','clientes.id')->get();

        return view('Listar_Servico',compact('servico'));



    }

    public function export(){

        return Excel::download(new ServicosFromView(),'propostas.xlsx');
    }


    public function __construct()
    {
        $this->middleware('auth');
        $this->objCliente=new ModelCliente();
        $this->objServicos=new ModelServicos();


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cliente = $this->objCliente->all();

        return view('Cadastro_Editar_Servico',compact('cliente'));
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
                'id_cliente'=>'required',
                'nm_endereco'=>'required',
                'nm_servico'=>'required',
                'vl_total'=>'required|numeric',
                'vl_sinal'=>'required|numeric',
                'qt_parcelas'=>'required|numeric',
                'vl_parcelas'=>'required|numeric',
                'dt_iniciopg'=>'required|date|after_or_equal:tomorrow',
                'dt_parcelas'=>'required|date|after:tomorrow',
                'nm_status'=>'required'


            ]);
        if($validacao->fails()){
            return redirect('/EServico/create')
                ->withInput()
                ->withErrors($validacao);

        }
        $servico = new ModelServicos();
        $servico->id_cliente = $request->id_cliente;
        $servico->nm_endereco = $request->nm_endereco;
        $servico->nm_servico = $request->nm_servico;
        $servico->vl_total = $request->vl_total;
        $servico->vl_sinal = $request->vl_sinal;
        $servico->qt_parcelas = $request->qt_parcelas;
        $servico->vl_parcelas = $request->vl_parcelas;
        $servico->dt_iniciopg = $request->dt_iniciopg;
        $servico->dt_proposta = $request->dt_proposta;
        $servico->dt_parcelas = $request->dt_parcelas;
        $servico->qv_arquivo = $request->qv_arquivo;
        $servico->nm_status = $request->nm_status;


        $servico->save();

        return redirect('/EServico');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    public function Busca(Request $request)
    {
        //SELECT * FROM `servicos` INNER JOIN clientes ON clientes.id = servicos.id_cliente
        // WHERE clientes.nm_RazaoSocial LIKE '%fg%'
        // OR servicos.nm_status LIKE '%Abe%'
        // OR servicos.nm_servico LIKE '%serv%'

        //$servico = ModelServicos::select('*')->where('nm_status','LIKE','%'.$request->criterio.'%')->get();
        //$servico = ModelServicos::select('*')->join('clientes','clientes.id','servicos.id_cliente')
         //   ->where('servicos.nm_servico',' LIKE ','%'.$request->criterio.'%')
         //   ->orWhere('clientes.nm_RazaoSocial',' LIKE', '%'.$request->criterio.'%')
          //  ->orWhere('servicos.nm_status','LIKE','%'.$request->criterio.'%')->get();

        //$servico = ModelServicos::select('*')->get();
        $servico = ModelServicos::select('servicos.id','servicos.dt_proposta','servicos.dt_iniciopg',
            'servicos.nm_servico','servicos.qt_parcelas','servicos.vl_sinal',
            'servicos.vl_parcelas','servicos.vl_total','servicos.nm_status','clientes.nm_RazaoSocial')
            ->join('clientes','servicos.id_cliente','clientes.id')
            ->where('servicos.nm_status','LIKE','%'.$request->criterio.'%')->get();
        return view('Listar_Servico',compact('servico'));
    }

    public function EditP(Request $request,$id)
    {
        $this->objServicos->where(['id'=>$id])->update([

            'nm_status' => $request->nm_status
        ]);

        return redirect('/EServico');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente=$this->objCliente->all();
        $servico=$this->objServicos->find($id);
        $EclienteId = $servico->find($servico->id)->relCliente->id;
        $EclienteNomeFantasia = $servico->find($servico->id)->relCliente->nm_nomeFantasia;
        return view('Cadastro_Editar_Servico',compact('servico','EclienteId','EclienteNomeFantasia','cliente'));
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
                'id_cliente'=>'required',
                'nm_endereco'=>'required',
                'nm_servico'=>'required',
                'vl_total'=>'required|numeric',
                'vl_sinal'=>'required|numeric',
                'qt_parcelas'=>'required|numeric',
                'vl_parcelas'=>'required|numeric',
                'dt_iniciopg'=>'required|date|after_or_equal:tomorrow',
                'dt_parcelas'=>'required|date|after:tomorrow',
                'nm_status'=>'required'


            ]);
        if($validacao->fails()){
            return redirect('/EServico')

                ->withErrors($validacao);

        }
        $this->objServicos->where(['id'=>$id])->update([
            'id_cliente' => $request->id_cliente,
            'nm_endereco' => $request->nm_endereco,
            'nm_servico' => $request->nm_servico,
            'vl_total' => $request->vl_total,
            'vl_sinal' => $request->vl_sinal,
            'qt_parcelas' => $request->qt_parcelas,
            'vl_parcelas' => $request->vl_parcelas,
            'dt_iniciopg' => $request->dt_iniciopg,
            'dt_proposta' => $request->dt_proposta,
            'dt_parcelas' => $request->dt_parcelas,
            'qv_arquivo' => $request->qv_arquivo,
            'nm_status' => $request->nm_status


        ]);
        return redirect('/EServico');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objServicos->destroy($id);
        return($del)?"sim":"não" ;
        return view('Listar_Servico');
    }
}
