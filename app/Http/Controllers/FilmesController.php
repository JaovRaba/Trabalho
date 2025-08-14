<?php

    namespace App\Http\Controllers;

    use App\Models\Avaliacao;
    use App\Models\Categoria;
    use App\Models\Filme;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class FilmesController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
       public function index(Request $request)
    {
        $query = Filme::query();
        $categorias = Categoria::all();


        if ($request->filled('ano')) {
            $query->where('ano', $request->ano);
        }


        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }


        if ($request->filled('nota')) {
            $query->whereHas('avaliacoes', function($q) use ($request) {
                $q->where('nota', $request->nota);
            });
        }

        $filmes = $query->get();

        return view('filmes.index', compact('filmes', 'categorias'));
    }



        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $categorias = Categoria::all();
            return view('filmes.create', ['categorias' => $categorias]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'titulo' => 'required|min:3|max:255',
                'sinopse' => 'required|max:255',
                'ano'=> 'required|min:4',
                'capa' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categoria_id'=> 'required'
            ]);

            $dados = $request->all();
            if($request->hasFile('capa')){
                $capa = $request->file('capa');
                $caminhocapa = $capa->store('filmes', 'public'); 
                $dados['capa'] = $caminhocapa;
            }
            
            Filme::create($dados);

            return redirect()->route('filmes.index');
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $filme = Filme::findOrFail($id);
            $categorias = Categoria::all();
            return view('filmes.edit', compact('filme', 'categorias'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id)
        {
            $data = $request->validate([
                'titulo' => 'required|min:3|max:255',
                'sinopse' => 'required|max:255',
                'ano'=> 'required|min:4',
                'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categoria_id'=> 'required'
            ]);

            if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $caminhoCapa = $capa->store('filmes', 'public');
            $data['capa'] = $caminhoCapa;
            }
            $filme = Filme::findOrFail($id);
            $filme->update($data);

            return redirect()->route('filmes.index');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $filme = Filme::findOrFail($id);
            $filme->delete();

        return redirect()->route('filmes.index');
        }
    }
