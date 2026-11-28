@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<h1>Usuarios</h1>

<form method="GET" action="{{ route('admin.users.index') }}">
    <input name="q" value="{{ $q }}" placeholder="Nombre o email">
    <select name="role">
        <option value="">Rol (todos)</option>
        @foreach(['admin', 'instructor', 'aprendiz'] as $r)
            <option value="{{ $r }}" {{ $role === $r ? 'selected' : '' }}>
                {{ ucfirst($r) }}
            </option>
        @endforeach
    </select>
    <button type="submit">Aplicar</button>
    @if(request()->hasAny(['q', 'role']))
        <a href="{{ route('admin.users.index') }}">Limpiar</a>
    @endif
</form>

<p><a href="{{ route('admin.users.create') }}">+ Nuevo usuario</a></p>

@if($users->count())
<table>
    <thead>
        <tr><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ ucfirst($u->role) }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $u) }}">Editar</a>
                @if(auth()->id() !== $u->id)
                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                          style="display:inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@else
    <p>No hay usuarios.</p>
@endif
@endsection
