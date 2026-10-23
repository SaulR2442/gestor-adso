@extends('layouts.app')
@section('title','Aprendices')
@section('content')
<h1>Listado de Aprendices</h1>

<div style="margin-bottom: 20px;">
    <form action="{{ route('aprendices.index') }}" method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre, doc o correo..." 
               style="padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px;">
        <button type="submit" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
        @if($search)
            <a href="{{ route('aprendices.index') }}" style="padding: 8px 16px; background-color: #6c757d; color: white; border: none; border-radius: 4px; text-decoration: none;">Limpiar</a>
        @endif
    </form>
</div>

<p><a href="{{ route('aprendices.create') }}">+ Nuevo</a></p>

@if(session('ok'))
    <div style="color: green; margin-bottom: 10px;">{{ session('ok') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aprendices as $aprendiz)
        <tr>
            <td>{{ $aprendiz->id }}</td>
            <td>{{ $aprendiz->nombre }}</td>
            <td>{{ $aprendiz->documento }}</td>
            <td>{{ $aprendiz->correo }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Controles de paginación --}}
<div class="pagination-container">
    {{ $aprendices->links() }}
</div>
@endsection