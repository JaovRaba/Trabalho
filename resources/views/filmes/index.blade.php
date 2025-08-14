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


                    <form method="GET" action="{{ route('filmes.index') }}" class="mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="ano" class="block text-sm font-medium text-gray-700">Ano</label>
                                <input type="text" name="ano" id="ano" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ request('ano') }}">
                            </div>
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                                <select name="categoria" id="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="nota" class="block text-sm font-medium text-gray-700">Nota</label>
                                <input type="text" name="nota" id="nota" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ request('nota') }}">
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Filtrar
                            </button>
                            <a href="{{ route('filmes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                Limpar Filtros
                            </a>
                        </div>
                    </form>

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
    <img 
        src="{{ asset('storage/'.$filme->capa) }}" 
        alt="Capa de {{ $filme->titulo }}" 
        class="max-h-48 max-w-full object-contain">
    <div class="w-full flex justify-center items-center">
        <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">Nota:</span>
        <div class="flex items-center ml-2">
            @php

                $avaliacaoUsuario = $filme->avaliacoes()->where('user_id', auth()->id())->first();
                $notaUsuario = $avaliacaoUsuario ? $avaliacaoUsuario->nota : 0; 
            @endphp
            @for ($i = 1; $i <= 5; $i++)
                @if ($notaUsuario >= $i)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z"/></svg>
                @endif
            @endfor
        </div>
    </div>
    @if ($avaliacaoUsuario)
        <span class="block text-lg font-semibold text-indigo-600 dark:text-indigo-400">Status: {{ $avaliacaoUsuario->status }}</span>
        <x-link-button href="{{ route('avaliacoes.edit', $avaliacaoUsuario->id) }}">
        Mudar status
        </x-link-button>
    @endif
        
</div>

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