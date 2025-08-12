<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Filmes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('level') == 1)
                    <x-link-button href="{{ route('filmes.create') }}">
                        Adicionar filme
                    </x-link-button>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4">
                        @foreach ($filmes as $filme)
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 border border-indigo-100 transform hover:-translate-y-1 p-5 relative">

                            <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-r from-purple-400 to-indigo-600 rounded-bl-xl z-0"></div>
                            
                            <div class="relative z-10">

                                <div class="mb-3">
                                    <span class="font-bold text-indigo-700 block mb-1">Título:</span>
                                    <span class="text-gray-800 font-medium text-lg block">{{ $filme->titulo }}</span>
                                </div>


                                <div class="mb-4 border-l-4 border-purple-300 pl-3 py-1 bg-purple-50 rounded-r">
                                    <span class="font-bold text-indigo-700 block mb-1">Sinopse:</span>
                                    <p class="text-gray-600 italic">
                                        {{ \Illuminate\Support\Str::limit($filme->sinopse, 100, $end='...') }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div>
                                        <span class="font-bold text-indigo-700 block">Ano:</span>
                                        <span class="text-gray-700">{{ $filme->ano }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-indigo-700 block">Categoria:</span>
                                        <span class="text-gray-700">
                                            @foreach ($categorias as $categoria)
                                                @if ($filme->categoria_id == $categoria->id)
                                                    {{ $categoria->nome }}
                                                @endif    
                                            @endforeach
                                        </span>
                                    </div>
                                </div>


                                <div class="mb-4 flex flex-col items-center">
                                    <div class="w-full flex justify-center items-center bg-gray-100 rounded-lg min-h-[12rem] cursor-pointer gatilho_modal"
                                        data-titulo="{{ $filme->titulo }}"
                                        data-sinopse="{{ $filme->sinopse }}"
                                        data-ano="{{ $filme->ano }}"
                                        data-capa="{{ asset('storage/'.$filme->capa) }}"
                                        data-link="{{ $filme->link }}"
                                        data-categoria="@foreach ($categorias as $categoria)
                                            @if ($filme->categoria_id == $categoria->id)
                                                {{ $categoria->nome }}
                                            @endif    
                                        @endforeach">
                                        <img 
                                            src="{{ asset('storage/'.$filme->capa) }}" 
                                            alt="Capa de {{ $filme->titulo }}" 
                                            class="max-h-48 max-w-full object-contain">
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3 mt-4">
                                    @if(session('level') == 0)
                                        @foreach ($avaliacoes as $avaliacao)
                                                                                <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">Nota:</span>
                                        @if ($avaliacao->nota != 0)
                                        <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $avaliacao->nota }}/5</span>
                                        @else
                                        <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">Ainda não visto</span>
                                        @endif
                                            <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">Status:</span>
                                            <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $avaliacao->status }}</span>
                                               <x-link-button href="{{ route('avaliacoes.edit', $avaliacao->id) }}">
                                                Mudar status
                                               </x-link-button>
                                        @endforeach
                                    @endif
                                    
                                    @if(session('level') == 1)
                                    <x-link-button href="{{ route('filmes.edit', $filme->id) }}" class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white py-1 px-3 rounded-lg text-sm transition-all shadow-md hover:shadow-lg">
                                        Editar
                                    </x-link-button>
                                    
                                    <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-form-button type="submit" onclick="return confirm('Quer mesmo excluir?')" class="bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 text-white py-1 px-3 rounded-lg text-sm transition-all shadow-md hover:shadow-lg">
                                            Excluir
                                        </x-form-button>
                                    </form>
                                    @endif


                                    <button class="gatilho_modal inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium text-sm px-3 py-1 border border-indigo-300 rounded-lg hover:bg-indigo-50 transition-colors"
                                        data-titulo="{{ $filme->titulo }}"
                                        data-sinopse="{{ $filme->sinopse }}"
                                        data-ano="{{ $filme->ano }}"
                                        data-capa="{{ asset('storage/'.$filme->capa) }}"
                                        data-link="{{ $filme->link }}"
                                        data-categoria="@foreach ($categorias as $categoria)
                                                @if ($filme->categoria_id == $categoria->id)
                                                    {{ $categoria->nome }}
                                                @endif    
                                            @endforeach">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                        Detalhes
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


<div id="filmeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full mx-4 relative">
                <button id="fechar_modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

               <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="md:w-2/5 flex justify-center">
                        <div class="w-full h-64 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                            <img id="modalCapa" src="" alt="Capa do filme" class="max-h-60 max-w-full object-contain">
                        </div>
                    </div>
                    
                    <div class="md:w-3/5">
                            <h2 id="modalTitulo" class="text-3xl font-bold text-gray-900 dark:text-white mb-4"></h2>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <span class="block text-sm font-semibold text-indigo-600 dark:text-indigo-400">Ano:</span>
                                    <span id="modalAno" class="text-lg text-gray-700 dark:text-gray-200"></span>
                                </div>
                                <div>
                                    <span class="block text-sm font-semibold text-indigo-600 dark:text-indigo-400">Categoria:</span>
                                    <span id="modalCategoria" class="text-lg text-gray-700 dark:text-gray-200"></span>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <span class="block text-sm font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Sinopse:</span>
                                <p id="modalSinopse" class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed"></p>
                            </div>
                            
                            <a id="modalLink" href="#" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-lg font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Assistir trailer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="{{ asset('css/filmes.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/filmes.js') }}"></script>
    @endpush
</x-app-layout>