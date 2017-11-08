<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;

class ContatosController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contatos = auth()->user()->contato()->get();

        return view('contatos.index', compact('contatos'));
    }

    public function store(Request $request)
    {
        $usuario = auth()->user();
        $usuario->addContato(Contato::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'informacoes' => $request->informacoes
        ]));


        $contatos = auth()->user()->contato()->get();

        return view('contatos.index', compact('contatos'));

    }

    public function destroy(Request $request)
    {
        $contato = Contato::where('id', $request->id)->first();

        if($contato->usuario->id == auth()->id()) {
            $contato->delete();
        } else {
            return response('Nao permitido.', 403);
        }

        $contatos = auth()->user()->contato()->get();
        return view('contatos.index', compact('contatos'));
    }
    

    public function edit($id)
    {
        $contato = Contato::where('id',$id)->first();

        if($contato->usuario->id == auth()->id()) {
            $Dados = array(
                'itens' =>
                Contato::where('id', $id)->get()
            );

            $contatos = auth()->user()->contato()->get();

            return view('contatos.editContacts',$Dados);
        } else {
               return response('Nao permitido.', 403);
            }
    }


    public function update($id)
    {
        $contato = Contato::where('id', $id)->first();

        if($contato->usuario->id == auth()->id()) {
            $contato->nome = request()->nome;
            $contato->email = request()->email;
            $contato->informacoes = request()->informacoes;
            $contato->save();
        } else {
            return response('Nao permitido.', 403);
        }

        $contatos = auth()->user()->contato()->get();

        return view('contatos.index', compact('contatos'));
    }

}

