
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Contatos</div>
                    <div class="panel-body">

                            @if($contatos != null)

                            <table class="table table-bordered ">
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Informacoes</th>
                                    <th>Opcoes</th>
                                </tr>
                                @foreach($contatos as $contato)
                                        <tr>
                                            <td>{{ $contato->nome }}</td>
                                            <td>{{ $contato->email }} </td>
                                            <td>{{ $contato->informacoes }}</td>
                                            <td>
                                                <form method="get" action="{{url('contatos/'.$contato->id)}}">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="PUT">
                                                    <input type="button" class="btn btn-warning" value="Atualizar">
                                                </form>

                                                <form method="post" action="{{url('contatos')}}">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input type="hidden" name="id" value="{{ $contato->id }}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-danger" value="Excluir">
                                                </form>

                                            </td>
                                        </tr>
                                @endforeach
                            </table>

                            @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro contato</div>

                    <div class="panel-body">
                        <form method="post" action="{{url('contatos')}}">

                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" name="nome">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <label for="informacoes">Informacoes:</label>
                                    <input type="text" class="form-control" name="informacoes">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-success" style="margin-left:38px">Adicionar contato</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
