<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Clientes;
use App\Models\Anuncio;

class clienteController extends Controller
{
    public function index(){

        $valor = session('login');
        $clientes = Clientes::all();
        $anuncios = Anuncio::all();

        if($valor){
            return view('cliente.index',['clientes' => $clientes, 'anuncios' => $anuncios]);
        }else{
            //Para limpar a sessão
            session()->flush();
            return redirect('login');
        }
    }

    public function store(Request $request){
        $valor = session('login');

        if($valor){
            $imoveis = DB::table('catalogos')
                    ->select('cod_imovel', 'id')
                    ->where('cod_imovel', '=', $request->cod_imovel)
                    ->first();

            if($imoveis != null) {

                $clientes = new Clientes;

                $clientes->nome = $request->nome;
                $clientes->email = $request->email;
                $clientes->telefone = $request->telefone;
                $clientes->tp_cliente = $request->tp_cliente;
                $clientes->idImovel = $imoveis->id;
                $clientes->cod_imovel = $request->cod_imovel;

                $clientes->save();

                Session::flash('success', 'Cliente cadastrado com sucesso');
            }else{
                Session::flash('warning', 'O imovel com o código '.$request->cod_imovel.' não existe');
            }

            return redirect()->back();
        }
    }

    public function destroy(Request $request){

        $anuncio = Anuncio::findOrFail($request->deletar);

        $anuncio->delete();

        return redirect()->back();
    }

    public function solucionar(Request $request){

        $anuncio = Anuncio::findOrFail($request->solucionar);



        return redirect()->back();
    }
}
