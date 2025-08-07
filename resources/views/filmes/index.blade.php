<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Filmes &raquo; 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
    <x-link-button href="{{ route('filmes.create') }}">
        Criar filme
    </x-link-button>

    
    <div class="border border-black mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach ($filmes as $filme)
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <span style="text-transform: capitalize;"><b>Título:</b> {{ $filme->titulo }}</span>
                            <br>
                            <p style="text-transform: capitalize;"><b>Sinopse:</b> {{ $filme->sinopse }}</p>
                            <span><b>Ano:</b> {{ $filme->ano }}</span>
                            <br>
                            <span><b>Categoria:</b> 
                            @foreach ($categorias as $categoria)
                            @if ($filme->categoria_id == $categoria->id)
                            {{ $categoria->nome }}
                            @endif    
                            @endforeach
                            <br>
                            </span>

                            @if ($filme->capa != null)
                            <img src="{{ asset('storage/'.$filme->capa) }}" alt="Gato">
                            @else
                            <span><b>Sem imagem</b></span>
                            @endif
                            <br>
                            <span><b>Link:</b> {{ $filme->link }}</span>
                        </div>
                        <hr class="border-black">
                    @endforeach
                    </div>
</div>
</div>
</div>
</div>

</x-app-layout>