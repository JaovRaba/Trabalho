<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Filmes &raquo; Editar
        </h2>
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/filmes.css') }}">
    @endpush

    <div class="filmes-container">
        <div class="form-container">
            <div class="form-card bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-2xl overflow-hidden relative border border-indigo-100">

                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-r from-purple-400 to-indigo-600 rounded-bl-2xl z-0"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-r from-pink-400 to-rose-500 rounded-tr-2xl z-0"></div>
                
                <div class="relative z-10 p-10">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-800 mb-3">
                            <i class="fas fa-film text-purple-500 mr-3"></i>Editar Filme
                        </h1>
                        <p class="text-lg text-gray-600">Atualize os detalhes do filme abaixo</p>
                    </div>
                    
                    <form action="{{ route('filmes.update', $filme->id) }}" enctype="multipart/form-data" method="post" class="space-y-8">
                        @csrf
                        @method('PUT')
                        

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                            <div class="space-y-8">

                                <div>
                                    <label class="block text-xl text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-heading text-purple-500 mr-3"></i>Título do Filme
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            name="titulo" 
                                            placeholder="Ex: O Poderoso Chefão" 
                                            value="{{ old('titulo', $filme->titulo) }}"
                                            class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg"
                                        >
                                        <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-purple-500 text-xl">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>
                                </div>
                                

                                <div>
                                    <label class="block text-xl text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-align-left text-purple-500 mr-3"></i>Sinopse
                                    </label>
                                    <div class="relative">
                                        <textarea 
                                            name="sinopse" 
                                            placeholder="Descreva a história do filme..."
                                            class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm min-h-[200px] text-lg"
                                        >{{ old('sinopse', $filme->sinopse) }}</textarea>
                                        <div class="absolute left-5 top-5 text-purple-500 text-xl">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="space-y-8">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                    <div>
                                        <label class="block text-xl text-gray-700 font-semibold mb-3">
                                            <i class="fas fa-calendar-alt text-purple-500 mr-3"></i>Ano
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="number" 
                                                name="ano" 
                                                placeholder="Ex: 1994"
                                                value="{{ old('ano', $filme->ano) }}"
                                                class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg"
                                            >
                                            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-purple-500 text-xl">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div>
                                        <label class="block text-xl text-gray-700 font-semibold mb-3">
                                            <i class="fas fa-tags text-purple-500 mr-3"></i>Categoria
                                        </label>
                                        <div class="relative">
                                            <select 
                                                name="categoria_id"
                                                class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg appearance-none"
                                            >
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $filme->categoria_id == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-purple-500 text-xl">
                                                <i class="fas fa-list"></i>
                                            </div>
                                            <div class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div>
                                    <label class="block text-xl text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-image text-purple-500 mr-3"></i>Capa do Filme
                                    </label>
                                    <div class="flex flex-col items-center">

                                        <div class="mb-4 w-full flex justify-center">
                                            <img src="{{ asset('storage/'.$filme->capa) }}" alt="Capa atual" class="max-h-48 rounded-lg border border-gray-200">
                                        </div>
                                        <div class="file-upload-container w-full">
                                            <label for="imagem" id="label_upload_arquivo" class="file-label flex flex-col items-center justify-center border-2 border-dashed border-purple-300 rounded-xl p-8 cursor-pointer bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 h-64">
                                                <div class="file-icon text-purple-500 mb-4 transition-transform text-5xl">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p class="text-gray-600 font-medium text-center text-lg">
                                                    <span class="text-purple-600 font-semibold">Clique para alterar</span><br>
                                                </p>
                                                <p class="text-gray-500 text-md mt-3">Formatos: JPG, PNG</p>
                                            </label>
                                            <input 
                                                type="file" 
                                                name="capa" 
                                                id="imagem" 
                                                accept="image/*" 
                                                class="hidden"
                                                onchange="atualizarNomeArquivo(this)"
                                            >
                                        </div>
                                        <div id="display_nome_arquivo" class="mt-2 text-center text-green-600 font-medium hidden">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            <span id="nome_arquivo"></span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div>
                                    <label class="block text-xl text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-link text-purple-500 mr-3"></i>Link do Trailer
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            name="link" 
                                            id="link" 
                                            placeholder="Ex: https://www.youtube.com/watch?v=..."
                                            value="{{ old('link', $filme->link) }}"
                                            class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg"
                                        >
                                        <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-purple-500 text-xl">
                                            <i class="fas fa-play-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="pt-10">
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-5 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center text-xl">
                                <i class="fas fa-save mr-4"></i>
                                Atualizar Filme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/filmes.js') }}"></script>
    @endpush
</x-app-layout>