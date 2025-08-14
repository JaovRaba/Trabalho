<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Avaliação &raquo; Criar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('avaliacoes.store') }}" method="post">
                        @csrf
                        <div>
                            <label class="block text-xl text-gray-700 font-semibold mb-3">
                                <i class="fas fa-heading text-purple-500 mr-3"></i>Filme
                            </label>
                            <select name="filme_id" class="w-full px-5 py-4 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg">
                                @foreach ($filmes as $filme)
                                    <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xl text-gray-700 font-semibold mb-3">
                                <i class="fas fa-star text-purple-500 mr-3"></i>Nota
                            </label>
                            <input 
                                type="number" 
                                name="nota" 
                                min="0" 
                                max="5" 
                                class="w-full px-5 py-4 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg"
                            >
                        </div>
                        <div>
                            <label class="block text-xl text-gray-700 font-semibold mb-3">
                                <i class="fas fa-check-circle text-purple-500 mr-3"></i>Status
                            </label>
                            <select name="status" class="w-full px-5 py-4 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg">
                                <option value="Visto">Visto</option>
                                <option value="Quero ver">Quero ver</option>
                                <option value="Não assistido">Não assistido</option>
                            </select>
                        </div>
                        <div class="pt-10">
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-5 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center text-xl">
                                <i class="fas fa-save mr-4"></i>
                                Salvar Avaliação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>