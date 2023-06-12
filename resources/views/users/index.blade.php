<x-app>
    <div class="card mx-5 my-5">
        <div class="card-header d-flex justify-content-between">
            <h2>Users</h2>
            <a href="{{ route('user.create') }}" class="btn btn-primary">Crear usuario</a>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CC</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->number_id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>

                            <td class="d-flex">
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1">Editar</a>

                                <form action="{{ route('user.delete', ['user' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
