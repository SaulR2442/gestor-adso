@csrf

<div class="space-y-4">
    <div>
        <x-input-label for="nombre" :value="__('Nombre')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $aprendiz->nombre)" maxlength="120" required />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="documento" :value="__('Documento')" />
        <x-text-input id="documento" class="block mt-1 w-full" type="text" name="documento" :value="old('documento', $aprendiz->documento)" maxlength="40" required />
        <x-input-error :messages="$errors->get('documento')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="correo" :value="__('Correo')" />
        <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo', $aprendiz->correo)" maxlength="120" required />
        <x-input-error :messages="$errors->get('correo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="ficha_id" :value="__('Ficha')" />
        <x-text-input id="ficha_id" class="block mt-1 w-full" type="number" name="ficha_id" :value="old('ficha_id', $aprendiz->ficha_id)" />
        <x-input-error :messages="$errors->get('ficha_id')" class="mt-2" />
    </div>

    <x-primary-button>
        {{ $buttonText ?? 'Guardar' }}
    </x-primary-button>
</div>
