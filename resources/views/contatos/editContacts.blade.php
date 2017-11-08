<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
?>
@extends('layouts.app')
@section('content')
    <section class="content-header">
              <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Editar Contato</li>
        </ol>
    </section>
 
 <section class="content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Alterar informações de Contato</h3>
                            </div>
@foreach ($itens as $Dados)                        
<form id="formContatoEdit" name="formContatoEdit" action="{{ url('/updatecontatos/') . '/' . $Dados->id}}"> 
                                {{ csrf_field() }}                               
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="nome" class="form-control required" id="nome" name="nome" placeholder="nome" value="{{ $Dados->nome }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                 <input type="email" class="form-control required" id="email" name="email" placeholder="email" value="{{ $Dados->email }}">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="informacoes">Informações</label>
                                                <input type="text" class="form-control required" id="informacoes" name="informacoes" placeholder="Informações" value="{{ $Dados->informacoes }}">
                                            </div>
                                        </div>                                       
                                        <div>
                                            <input type="hidden" name="id" value="{{$Dados->id}}">
                                        </div>
                                        <div class="box-footer" align="center">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                            </div>
                    </div>
                </div>
            </section>
        
@endsection