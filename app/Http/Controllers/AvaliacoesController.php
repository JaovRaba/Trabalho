<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AvaliacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $avaliacoes = Avaliacao::with(['filme', 'user'])->get();
        return view('avaliacoes.index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filmes = Filme::all();
        return view('avaliacoes.create', compact('filmes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in(['Visto', 'Quero ver', 'Não assistido'])],
            'nota'   => 'required|integer|min:0|max:5',
            'filme_id' => 'required|exists:filmes,id',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->status === 'Visto' && $request->nota <= 0) {
                $validator->errors()->add('nota', 'Qual é, o filme não é tão ruim assim.');
            }

            if (in_array($request->status, ['Quero ver', 'Não assistido']) && $request->nota != 0) {
                $validator->errors()->add('nota', 'Quando o status for "Quero ver" ou "Não assistido", a nota deve ser 0.');
            }
        });

        $data = $validator->validate();
        
        if (Avaliacao::where('filme_id', $data['filme_id'])->where('user_id', auth()->id())->exists()) {
        return redirect()->back();
    }

        $data['user_id'] = auth()->id();

        Avaliacao::create($data);

        return redirect()->route('avaliacoes.index');
    }


    public function edit(string $id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $enumStr = DB::selectOne("SHOW COLUMNS FROM avaliacoes WHERE Field = 'status'")->Type;
        preg_match("/^enum\('(.*)'\)$/", $enumStr, $matches);
        $valores = explode("','", $matches[1]);
        return view('avaliacoes.edit', compact('avaliacao', 'valores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
       $validator = Validator::make($request->all(), [
        'status' => ['required', Rule::in(['Visto', 'Quero ver', 'Não assistido'])],
        'nota'   => 'required|integer|min:0|max:5',
    ]);

    $validator->after(function ($validator) use ($request) {

    if ($request->status === 'Visto' && $request->nota <= 0) {
        $validator->errors()->add('nota', 'Qual é, o filme não é tão ruim assim.');
    }


    if (in_array($request->status, ['Quero ver', 'Não assistido']) && $request->nota != 0) {
        $validator->errors()->add('nota', 'Quando o status for "Quero ver" ou "Não assistido", a nota deve ser 0.');
    }
    });
            
            $data = $validator->validate();
            $avaliacao = Avaliacao::findOrFail($id);
            $avaliacao->update($data);

            return redirect()->route(route: 'filmes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $avaliacao->delete();

    return redirect()->route('avaliacoes.index');
    }
}
