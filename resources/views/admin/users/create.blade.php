@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<h1>Crear Usuario</h1>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <label>Nombre</label>
    <input name="name" value="{{ old('name') }}" required>
    @error('name') <div class="danger">{{ $message }}</div> @enderror

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <div class="danger">{{ $message }}</div> @enderror

    <label>Rol</label>
    <select name="role" required>
        @foreach($roles as $r)
            <option value="{{ $r }}" {{ old('role') === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
        @endforeach
    </select>
    @error('role') <div class="danger">{{ $message }}</div> @enderror

    <label>Contraseña (opcional)</label>
    <input type="password" name="password">
    @error('password') <div class="danger">{{ $message }}</div> @enderror

    <button type="submit">Crear</button>
    <a href="{{ route('admin.users.index') }}">Cancelar</a>
</form>
@endsection
