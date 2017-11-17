@extends('layouts.app')
@section('pageTitle', 'Manage Products')
@section('content')
<div class="container">
	<h3>
		Manage Products:
	</h3>
	<div class="row" align="right">
			
		<a href="#finished">
			<button class="btn btn-danger" >
				Out of Stock
			</button>
		</a>
		
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newProduct" href="" >
			<i class="fa fa-plus" aria-hidden="true"> New Product</i>
		</button>
		
		</div>
		<br>

    <div class="row">
    	<form action="product/seach" method="get">
		{{ csrf_field()}}
			<div class="input-group">
				<input type="text" name="name" class="form-control" placeholder="Search for product by name ...">
				<span class="input-group-btn">
				<input type="submit" class="btn btn-info" type="button" value="Seach">
				</span>
			</div>
		</form>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Cost</th>
				<th>Quantity</th>
				<th>Supplier</th>
				<th colspan="2">Actions</th>
			</tr>
			@foreach($products as $product)
			@if($product->quantity > 0)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->description}}</td>

				<td>R${{$product->cost}}</td>
				<td>{{$product->quantity}}</td>
				<td>
				@foreach($suppliers as $supplier)
					@if($product->suppliers_id == $supplier->id)
							{{$supplier->name}}
					@endif 
				@endforeach
				</td>
				<td colspan="2">
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#finisheProducts{{$product->id}}">
						End
					</button>
					<div class="modal fade" id="finisheProducts{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel"> product</h3>
								</div>
								<form action="product/debit" method="post">
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
				</td><td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProduct{{$product->id}}">Edit</button>

					<!-- MODAL: EDIT PRODUCTS -->
					<div class="modal fade" id="editProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h3 class="modal-title" id="myModalLabel">Edit product</h3>
								</div>
								<form action="product/edit" method="post">
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
			<h3 id="finished">
				&nbsp;&nbsp;&nbsp; Out of stock:
			</h3>	
			</div>
	    <div class="row">
		<table class="table">
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Cost</th>
							<th>Quantity</th>
							<th>Supplier</th>
							<th colspan="2">Actions</th>
						</tr>
						@foreach($products as $product)
						@if($product->quantity == 0)
						<tr>
							<td>{{$product->name}}</td>
							<td>{{$product->description}}</td>
							<td>R${{$product->cost}}</td>
							<td>{{$product->quantity}}</td>
							<td>{{$product->supplier_id}}</td>
							<td>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProductoutStock{{$product->id}}">
									Edit
								</button>

								<!-- MODAL: EDIT PRODUCTS -->
								<div class="modal fade" id="editProductoutStock{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h3 class="modal-title" id="myModalLabel">Edit product</h3>
											</div>
											<form action="product/edit" method="post">
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

	<div class="modal fade" id="outOfStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Out of stock products</h3>
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
				<form action="product/insert" method="post">
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
