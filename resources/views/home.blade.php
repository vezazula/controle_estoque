@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div align="center">
                        <input type="button" class="btn btn-default" value="Contatos" onclick="javascript: location.href='contatos';" />
                    </div>  
                    <br>
                

                    @if($permission == 1)
                    
                    <div align="center">
                        <input type="button" class="btn btn-default" value="Access Dashboard"  onclick="javascript: location.href='dashboard';">
                    </div>
                    <br>

                    <div align="center">
                        <input type="button" class="btn btn-default" value="Manage Users"  onclick="javascript: location.href='user';">
                    </div>

                @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
