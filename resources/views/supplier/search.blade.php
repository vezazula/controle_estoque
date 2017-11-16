@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<h3>
			Suppliers found:
		</h3>	
		<a href="/supplier">
			<button class="btn btn-warning btn-lg" >
				Back
			</button>
		</a>
		
		</div>
    <div class="row">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>CNPJ</th>
				<th>Adress</th>
				<th>Actions</th>
			</tr>
			@foreach($suppliers as $supplier)
			<tr>
				<td>{{$supplier->name}}</td>
				<td>{{$supplier->cnpj}}</td>
				<td>{{$supplier->adress}}</td>
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSupplier{{$supplier->id}}">Edit</button>

					<!-- MODAL: Edit Supplier -->
					<div class="modal fade" id="editSupplier{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel">Edit supplier</h3>
								</div>
								<form action="/supplier/edit" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<div class="form-group">
											<input type="hidden" name="id" value="{{$supplier->id}}">
											<label>Name</label>
											<input type="text" name="name" class="form-control" value="{{$supplier->name}}" placeholder="Name" autofocus>
											<label>CNPJ</label>
											<input type="text" name="cnpj" class="form-control" value="{{$supplier->cnpj}}" placeholder="Description">
											<label>Adress</label>
											<input type="text" name="adress" class="form-control" value="{{$supplier->adress}}" placeholder="Cost">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<input type="submit" class="btn btn-primary" value="Confirm">
									</div>
								</form>
							</div>
						</div>
					</div>

					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSupplier{{$supplier->id}}">Delete</button>

					<div class="modal fade" id="deleteSupplier{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel">Edit supplier</h3>
								</div>
								<form action="/supplier/delete" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<p>Do you want to delete? (will be deleted only if nonexistent products linked to it)</p>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="id" value="{{$fornecedor->id}}">
										<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
										<input type="submit" class="btn btn-primary" value="Yes">
									</div>
								</form>
							</div>
						</div>
					</div>
					<a href="/product/supplier/{{$supplier->id}}">
						<button type="button" class="btn btn-success">
							Products
						</button>
					</a>
					
				</td>
			</tr>

			@endforeach
		</table>
	</div>
	<div class="modal fade" id="newSupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Register new supplier</h3>
				</div>
				<form action="/supplier/insert" method="post">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="Name" autofocus>
							<label>CNPJ</label>
							<input type="text" name="cnpj" class="form-control" placeholder="CNPJ">
							<label>Adress</label>
							<input type="text" name="adress" class="form-control" placeholder="adress">
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-primary" value="Confirm">
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>
@endsection
