@extends('layouts.app')
@section('pageTitle', 'Manage Products')
@section('content')
<div class="container">

	<div class="row">
		<h3 style="float: left; margin-top: 8px">
			Data and information:
		</h3>
		
	</div>
    <div class="row">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Cost</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			@foreach($products as $product)
			@if($product->quantity > 0)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->description}}</td>
				<td>R${{$product->cost}}</td>
				<td>{{$product->quantity}}</td>
				<td>
					<b>R${{($product->cost * $product->quantity)}}</b>
				</td>
			</tr>
			@endif

			@endforeach
		</table>
		<h3> Total price of products: R${{$total}}</h3>
	</div>

</div>
@endsection
