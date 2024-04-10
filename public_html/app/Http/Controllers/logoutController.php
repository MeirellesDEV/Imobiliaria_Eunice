<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class logoutController extends Controller
{
    public function index(){
        session()->flush();
        return redirect('login');
    }

    public function filtro(){
        Session::forget('search');
        return redirect('/imoveis');
    }

    public function limpaFiltro(Request $request){

        $search = session('search');
        $filtro = $request->filtro;

        // dd($filtro);

        if($filtro == 'titulo'){
            if(isset($search[0])){
                $search[0]->titulo = null;
            }else{
                $search = null;
            }
        }

        if($filtro == 'código'){
            $search[0]->cod_imovel = null;
        }

        if($filtro == 'localidade'){
            $search[0]->localidade = null;
        }

        if($filtro == 'Em condominio'){
            $search[0]->condominio = null;
        }

        if($filtro == 'bairro'){
            $search[0]->bairro = null;
        }

        if($filtro == 'Tipo de contrato'){
            $search[0]->tp_contrato = "Todos";
        }

        if($filtro == 'Tipo de imóvel'){
            $search[0]->id_tp_produto = null;
        }

        if($filtro == 'quartos'){
            $search[0]->quartos = null;
        }

        if($filtro == 'banheiros'){
            $search[0]->banheiros = null;
        }

        if($filtro == 'vagas'){
            $search[0]->vagas = null;
        }

        if($filtro == 'valor'){
            $search[0]->valor = null;
        }

        if($filtro == 'area'){
            $search[0]->area = null;
        }

        if($filtro == 'mobiliado'){
            $search[0]->mobiliado = "Vazio";
        }

        if(
            $search[0]->titulo == null and $search[0]->localidade == null and
            $search[0]->quartos == null and $search[0]->banheiros == null and
            $search[0]->vagas == null and $search[0]->valor == null and $search[0]->area == null and
            $search[0]->tp_contrato == "Todos" and $search[0]->bairro == null and
            $search[0]->condominio == null and $search[0]->cod_imovel == null and
            $search[0]->id_tp_produto == null and $search[0]->mobiliado == "Vazio"
        ){
            Session::forget('search');
        }

        return redirect('/imoveis');
    }
}
