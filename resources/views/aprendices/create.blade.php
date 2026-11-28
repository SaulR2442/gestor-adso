@extends('layouts.app')

@section('title', 'Crear Aprendiz')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear Aprendiz') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('aprendices.store') }}" method="POST">
                @include('aprendices._form', [
                    'aprendiz' => $aprendiz,
                    'buttonText' => 'Guardar aprendiz',
                ])
            </form>

            <div class="mt-4">
                <a href="{{ route('aprendices.index') }}" class="text-gray-600 hover:text-gray-900">
                    &larr; Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
