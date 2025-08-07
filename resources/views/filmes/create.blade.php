<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Filmes &raquo; Criar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

<form action="{{ route('filmes.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="text" name="titulo" placeholder="Título do Filme" value="{{ old('titulo') }}">
    <br>
    <textarea name="sinopse" cols="30" rows="10" placeholder="Sinopse...">{{ old('sinopse') }}</textarea>
    <br>
    <input type="number" name="ano" placeholder="Ano" value="{{ old('ano') }}">
    <br>
    <select name="categoria_id">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
        @endforeach
    </select>
    <br>
    <input type="file" name="capa" id="imagem" accept="image/*">
    <br>
    <input type="text" name="link" id="link" placeholder="Link do trailer" value="{{ old('link') }}">
    <br>
    <x-primary-button>
        Salvar filme
    </x-primary-button>
</form>
<hr>


</div>
</div>
</div>
</div>
</x-app-layout>