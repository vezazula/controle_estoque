@extends('layouts.app')
@section('pageTitle', 'Products')
@section('content')
<div class="container">

	<script>
		function goBack() {
		    window.history.back();
		}bySupplier
	</script>

	<div class="row">
		<h3>
			 {{$bySupplier->name}} products, ({{$bySupplier->cnpj}})
		</h3>	
		<a href="#finished">
			<button class="btn btn-danger btn-lg" >
				Finished 
			</button>
		</a>

		<button class="btn btn-warning btn-lg" onclick="goBack()">
			Back
		</button>

		<a href="/product/supplier/{{$bySupplier->id}}">
			<button class="btn btn-primary btn-lg" >
				<i class="fa fa-refresh" aria-hidden="true"></i>
			</button>
		</a>
		</div>
    <div class="row">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Cost</th>
				<th>Quantity</th>
				<th>Actions</th>
			</tr>
			@foreach($products as $product)
			@if($product->quantity > 0)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->description}}</td>
				<td>R${{$product->cost}}</td>
				<td>{{$product->quantity}}</td>
				<td>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#subtractProduct{{$product->id}}">
						Subtract product
					</button>
					<div class="modal fade" id="subtractProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel">Subtract product</h3>
								</div>
								<form action="/product/debit" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<div class="form-group">
											<input type="hidden" name="id" value="{{$product->id}}">
											<label>Quantity</label>
											<input type="number" name="quantity" min="0" max="{{$product->quantity}}" class="form-control" value="0">
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
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProduto{{$product->id}}">Edit</button>

					<!-- MODAL: EDIT PRODUCTS -->
					<div class="modal fade" id="editProduto{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel">Edit product</h3>
								</div>
								<form action="/product/edit" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<div class="form-group">
											<input type="hidden" name="id" value="{{$product->id}}">
											
											<label>Nome</label>
											<input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="Name" autofocus>
											
											<label>Description</label>
											<input type="text" name="description" class="form-control" value="{{$product->description}}" placeholder="Description">
											
											<label>Custo</label>
											<input type="text" name="cost" class="form-control" value="{{$product->cost}}" placeholder="Cost">
											
											<label>Quantity</label>
											<input type="number" name="quantity" min="0" class="form-control" value="{{$product->quantity}}">
											
											<label>Supplier</label>
											<select name="supplier" class="form-control">
												@foreach($suppliers as $supplier)
												<option value="{{$supplier->id}}" {{$product->supplier_id == $supplier->id ? "selected" : ""}}>
													{{$supplier->name}} ({{$supplier->cnpj}})
												</option>
												@endforeach
												
											</select>
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
				</td>
			</tr>
			@endif

			@endforeach
		</table>
	</div>
	<div class="row">
		<div class="row">
			<h3 id="finished" style="float: left; margin-top: 8px;">
				&nbsp;&nbsp;&nbsp;Finished:
			</h3>	
			</div>
	    <div class="row" style="margin-left: 0px">
		<table class="table">
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Cost</th>
							<th>Quantity</th>
							<th colspan="3">Actions</th>
						</tr>
						@foreach($products as $product)
						@if($product->quantity == 0)
						<tr>
							<td>{{$product->name}}</td>
							<td>{{$product->description}}</td>
							<td>R${{$product->cost}}</td>
							<td>{{$product->quantity}}</td>
							<td>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editFinishedProduct{{$product->id}}">
									Edit
								</button>

								<!-- MODAL: EDIT PRODUCTS -->
								<div class="modal fade" id="editFinishedProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h3 class="modal-title" id="myModalLabel">Edit product</h3>
											</div>
											<form action="/produto/editar" method="post">
											{{ csrf_field() }}
												<div class="modal-body">
													<div class="form-group">
														<input type="hidden" name="id" value="{{$product->id}}">
														
														<label>Name</label>
														<input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="Name" autofocus>
														
														<label>Description</label>
														<input type="text" name="description" class="form-control" value="{{$product->description}}" placeholder="Description">
														
														<label>Cost</label>
														<input type="text" name="cost" class="form-control" value="{{$product->cost}}" placeholder="Cost">
														
														<label>Quantity</label>
														<input type="number" name="quantity" min="0" class="form-control" value="{{$product->quantity}}">
														
														<label>Supplier</label>
														<select name="supplier" class="form-control">
															@foreach($suppliers as $supplier)
															<option value="{{$supplier->id}}" {{$product->supplier_id == $supplier->id ? "selected" : ""}}>
																{{$fornecedor->nome}} ({{$fornecedor->cnpj}})
															</option>
															@endforeach
															
														</select>
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
							</td>
						</tr>
						@endif

						@endforeach
					</table>
	</div>

	<div class="modal fade" id="esgotados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Finished products</h3>
				</div>
			</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
				</div>
		</div>
	</div>
	</div>

	<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Register new product</h3>
				</div>
				<form action="/product/insert" method="post">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="Name" autofocus>
							<label>Description</label>
							<input type="text" name="description" class="form-control" placeholder="Description">
							<label>Cost</label>
							<input type="text" name="cost" class="form-control" placeholder="Cost">
							<label>Quantity</label>
							<input type="number" name="quantity" min="0" class="form-control">
							<label>Supplier</label>
							<select name="supplier" class="form-control">
								<option value="" selected>Select</option>

								@foreach($suppliers as $supplier)
								<option value="{{$supplier->id}}">
									{{$supplier->name}} ({{$supplier->cnpj}})
								</option>
								@endforeach

							</select>
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
