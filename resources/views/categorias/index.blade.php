<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Categorias &raquo; 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
    <x-link-button href="{{ route('categorias.create') }}">
        Adicionar categoria
    </x-link-button>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4">
        <ul>            
        <?php $contador = 1?>
        @foreach ($categorias as $categoria)
        <li>
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 border border-indigo-100 transform hover:-translate-y-1 p-5 relative">

            <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-r from-purple-400 to-indigo-600 rounded-bl-xl z-0"></div>
            
            <div class="relative z-10">

                <div class="mb-3">
                    <span class="font-bold text-indigo-700 block mb-1">Categoria - </span>
                    <span class="text-gray-800 font-medium text-lg block"><?php echo $contador?> </span>
                </div>
                 <div class="mb-3">
                    <span class="font-bold text-indigo-700 block mb-1">Nome:</span>
                    <span class="text-gray-800 font-medium text-lg block">{{ $categoria->nome }} </span>
                </div>

                <x-link-button href="{{ route('categorias.edit', $categoria->id) }}" class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white py-1 px-3 rounded-lg text-sm transition-all shadow-md hover:shadow-lg">
                        Editar
                    </x-link-button>
                    
                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-form-button type="submit" onclick="return confirm('Quer mesmo excluir?')" class="bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 text-white py-1 px-3 rounded-lg text-sm transition-all shadow-md hover:shadow-lg">
                            Excluir
                        </x-form-button>
                    </form>
            </div>
        </li>
        <br>
        <?php $contador++ ?>
        @endforeach
        </ul>
</div>
</div>
</div>
</div>

</x-app-layout>