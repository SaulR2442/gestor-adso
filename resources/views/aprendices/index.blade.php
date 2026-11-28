@extends('layouts.app')

@section('title', 'Aprendices')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de Aprendices') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <div class="flex justify-between items-center mb-6">
                @can('create', App\Models\Aprendiz::class)
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" href="{{ route('aprendices.create') }}">
                    + Nuevo aprendiz
                </a>
                @endcan

                <form
                    class="flex gap-2"
                    action="{{ route('aprendices.index') }}"
                    method="GET">
                    <input
                        type="text"
                        name="q"
                        value="{{ $q }}"
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Buscar...">

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Buscar</button>

                    @if ($q !== '')
                    <a href="{{ route('aprendices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                        Limpiar
                    </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Documento</th>
                            <th class="px-6 py-3">Correo</th>
                            <th class="px-6 py-3">Ficha</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aprendices as $aprendiz)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $aprendiz->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $aprendiz->nombre }}</td>
                            <td class="px-6 py-4">{{ $aprendiz->documento }}</td>
                            <td class="px-6 py-4">{{ $aprendiz->correo }}</td>
                            <td class="px-6 py-4">{{ $aprendiz->ficha_id ?? 'Sin ficha' }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                @can('update', $aprendiz)
                                <a href="{{ route('aprendices.edit', $aprendiz) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                @endcan

                                @can('delete', $aprendiz)
                                <form
                                    action="{{ route('aprendices.destroy', $aprendiz) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Eliminar este aprendiz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">
                                No hay aprendices registrados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $aprendices->links() }}
            </div>
        </div>
    </div>
</div>

@endsection