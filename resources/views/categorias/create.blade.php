<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Categoria &raquo; Criar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

<form action="{{ route('categorias.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div>
            <label class="block text-xl text-gray-700 font-semibold mb-3">
            <i class="fas fa-heading text-purple-500 mr-3"></i>Nome da categoria
            </label>
            <div class="relative">
            <input 
            type="text" 
            name="nome" 
            placeholder="Ex: Ação" 
            value="{{ old('nome') }}"
            class="w-full px-5 py-4 pl-16 rounded-xl border border-gray-300 focus:outline-none input-focus transition-all duration-300 bg-white shadow-sm text-lg"
            >
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-purple-500 text-xl">
            <i class="fas fa-tag"></i>
            </div>
            </div>
    <div class="pt-10">
       <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-5 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center text-xl">
       <i class="fas fa-save mr-4"></i>
       Salvar Categoria
       </button>
    </div>
</form>


<hr>


</div>
</div>
</div>
</div>
</x-app-layout>