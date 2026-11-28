@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<h1>Editar Usuario: {{ $user->name }}</h1>
<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <label>Nombre</label>
    <input name="name" value="{{ old('name', $user->name) }}" required>
    @error('name') <div class="danger">{{ $message }}</div> @enderror

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    @error('email') <div class="danger">{{ $message }}</div> @enderror

    <label>Rol</label>
    <select name="role" required>
        @foreach($roles as $r)
            <option value="{{ $r }}" {{ old('role', $user->role) === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
        @endforeach
    </select>
    @error('role') <div class="danger">{{ $message }}</div> @enderror

    <label>Nueva contraseña (opcional)</label>
    <input type="password" name="password">
    @error('password') <div class="danger">{{ $message }}</div> @enderror

    <button type="submit">Actualizar</button>
    <a href="{{ route('admin.users.index') }}">Cancelar</a>
</form>
@endsection
