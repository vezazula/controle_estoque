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

                    @if($permission == 1)
                    
                    <div align="center">
                        <input type="button" class="btn btn-default" value="Access Dashboard"  onclick="javascript: location.href='dashboard';">
                    </div>
                    <br>

                    <div align="center">
                        <input type="button" class="btn btn-default" value="Manage Users"  onclick="javascript: location.href='user';">
                    </div>
                    <br>
                    
                    @endif

                    <div align="center">
                        <input type="button" class="btn btn-default" value="Contatos" onclick="javascript: location.href='contatos';" />
                    </div>  
                    <br>
                     <div align="center">
                        <input type="button" class="btn btn-default" value="Products" onclick="javascript: location.href='product';" />
                    </div> 
                    <br> 
 <div align="center">
                    <div align="center">
                        <input type="button" class="btn btn-default" value="Suppliers" onclick="javascript: location.href='supplier';" />
                    </div> 
                    <br> 

                 


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
