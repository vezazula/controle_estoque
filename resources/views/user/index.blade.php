@extends('layouts.app')

@section('content')
<div class="container">

	<h3>
		Manage users:
	</h3>

	<div class="row" align="right">
		<a href="/user"></a>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#newUser">
			<i class="fa fa-plus" aria-hidden="true">New user</i>
		</button>	
	</div>
	<br>

    <div class="row">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Permission</th>
				<th>Status</th>
				<th colspan="2">Actions</th>
			</tr>
			@foreach($showUsers as $dataUser)
			@if($dataUser->id == $user->id)
			<tr>
				<td>{{$dataUser->name}}</td>	
				<td>{{$dataUser->email}}</td>
				
				@if($dataUser->permission == true)
					<td>{{$dataUser->permission}}</td>
				@endif

				@if($dataUser->status ==true)
				<td>
						<span class="label label-success">Active</span>
				</td>
				@else
						<td>
						<span class="label label-danger">Inactive</span>
				</td>
				@endif
				

				<td>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#editUser{{$dataUser->id}}">
						Edit
					</button>
				<div class="modal fade" id="editUser{{$dataUser->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h3 class="modal-title" id="myModalLabel">Edit user: {{$dataUser->name}}</h3>
								</div>
								<form action="/user/update" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<div class="form-group">
											<input type="hidden" name="id" value="{{$dataUser->id}}">
											<label>Name</label>
											<input type="text" name="name" class="form-control" value="{{$dataUser->name}}" placeholder="Name" autofocus>
											<label>Email</label>
											<input type="email" name="email" class="form-control" value="{{$dataUser->email}}" placeholder="Email">
											<br>
											
											<label>Status</label>
											<div class="radio">
											  	<label><input type="radio" name="status" value="Active" checked>Active</label>&nbsp;
											  	<label><input type="radio" name="status" value="Inactive" >Inactive</label>
											</div>
											
											
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
			@foreach($showUsers as $dduser)
			@if($dduser->id != $user->id)
			<tr>
				<td>{{$dduser->name}}</td>
				<td>{{$dduser->email}}</td>
				<td>{{$dduser->permission}}</td>
				@if($dduser->status ==true)
				<td>
						<span class="label label-success">Active</span>
				</td>
				@else
						<td>
						<span class="label label-danger">Inactive</span>
				</td>
				@endif
					
				<td>
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#editUser{{$dduser->id}}">
						Edit
					</button>
					<div class="modal fade" id="editUser{{$dduser->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h3 class="modal-title" id="myModalLabel">Edit user: {{$dduser->name}}</h3>
								</div>
								<form action="/user/update" method="post">
								{{ csrf_field() }}
									<div class="modal-body">
										<div class="form-group">
											<input type="hidden" name="id" value="{{$dduser->id}}">
											
											<label>Name</label>
											<input type="text" name="name" class="form-control" value="{{$dduser->name}}" placeholder="Name" autofocus>
											
											<label>Email</label>
											<input type="email" name="email" class="form-control" value="{{$dduser->email}}" placeholder="Email">
											<br>
											
										@if($dduser->id != $user->id)
											@if($dduser->permission == 1)
											<label>Administrator</label>
											<div class="radio">
											  	<label><input type="radio" name="status" value="1" checked>Active</label>&nbsp;
											  	<label><input type="radio" name="status" value="0" >Inactive</label>
											</div>
											@else
											<div class="radio">
											  	<label><input type="radio" name="status" value="1">Active</label>&nbsp;
											  	<label><input type="radio" name="status" value="0" checked>Inactive</label>
											</div>
											@endif
										@endif
											
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
	<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Register new user</h3>
				</div>
				<form action="/user/register" method="post">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="Name" autofocus>
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
							<label>Password confirm</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Password">
							<br>
							
							<label>Status</label>
							<div class="radio">
							  	<label><input type="radio" name="status" value="active">Active</label>&nbsp;
							  	<label><input type="radio" name="status" value="inactive" checked>Inactive</label>
							</div>
							
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


