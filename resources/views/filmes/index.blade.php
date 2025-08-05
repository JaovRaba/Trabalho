<h1>Filmes</h1>
<p>Seja bem-vindo ao Filmes, o seu assistente pessoal (melhor do que o Google).</p>
<hr>


<hr>

<form action="{{ route('filme.adicionar') }}" method="post">
    @csrf
    <input type="text" name="titulo" placeholder="Título da nota" value="{{ old('titulo') }}">
    <br>
    <textarea name="texto" cols="30" rows="10" placeholder="Digite sua nota aqui...">{{ old('texto') }}</textarea>
    <br>
    <input type="submit" value="Gravar nota">
</form>
<hr>

<!--@foreach ($notas as $nota)
    <div style="border:1px dashed green;padding:2px">
        <p><strong>{{ $nota->titulo }}</strong></p>
        {{ $nota->texto }}
        <br>
        <a href="{{ route('keep.editar', $nota->id) }}">Editar</a>
        <br>
        <form action="{{ route('keep.apagar', $nota->id) }}" method="post">
            @method('DELETE')
            @csrf
            <input type="submit" value="Apagar">
        </form>

    </div>
@endforeach
-->