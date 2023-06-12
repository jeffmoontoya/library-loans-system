<x-app>
	<div class="card mx-5 my-5">

		<div class="card-header d-flex justify-content-between">
			<h2>Users</h2>
			<a href="{{route('user.create')}}" class="btn btn-primary">Crear usuario</a>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
				  <tr>
					<th scope="col">CC</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Correo</th>
				  </tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<th>{{$user->number_id}}</th>
							<td>{{$user->name}}</td>
							<td>{{$user->last_name}}</td>
							<td>{{$user->email}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</x-app>
