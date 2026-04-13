<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Movimentacao;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $query = Livro::query()->where('ativo', true);

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('titulo', 'like', "%$busca%")
                  ->orWhere('curso', 'like', "%$busca%")
                  ->orWhere('isbn', 'like', "%$busca%");
            });
        }

        if ($request->filled('curso')) {
            $query->where('curso', $request->curso);
        }

        $livros = $query->orderBy('titulo')->paginate(15)->withQueryString();
        $cursos = Livro::distinct()->pluck('curso')->sort()->values();

        return view('livros.index', compact('livros', 'cursos'));
    }

    public function create()
    {
        $cursos = ['Eletrotécnica', 'Mecânica', 'TI', 'Seg. Trabalho', 'Administração', 'Logística', 'Outro'];
        return view('livros.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo'        => 'required|string|max:200',
            'autor'         => 'nullable|string|max:200',
            'editora'       => 'nullable|string|max:100',
            'edicao'        => 'nullable|string|max:50',
            'ano'           => 'nullable|integer|min:1900|max:2099',
            'isbn'          => 'nullable|string|max:20|unique:livros,isbn',
            'curso'         => 'required|string|max:100',
            'localizacao'   => 'nullable|string|max:100',
            'cor'           => 'nullable|string|max:7',
            'quantidade'    => 'required|integer|min:0',
            'estoque_minimo'=> 'required|integer|min:0',
        ]);

        Livro::create($dados);
        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function show(Livro $livro)
    {
        $movimentacoes = $livro->movimentacoes()->with('user')->latest()->take(20)->get();
        return view('livros.show', compact('livro', 'movimentacoes'));
    }

    public function edit(Livro $livro)
    {
        $cursos = ['Eletrotécnica', 'Mecânica', 'TI', 'Seg. Trabalho', 'Administração', 'Logística', 'Outro'];
        return view('livros.edit', compact('livro', 'cursos'));
    }

    public function update(Request $request, Livro $livro)
    {
        $dados = $request->validate([
            'titulo'        => 'required|string|max:200',
            'autor'         => 'nullable|string|max:200',
            'editora'       => 'nullable|string|max:100',
            'edicao'        => 'nullable|string|max:50',
            'ano'           => 'nullable|integer|min:1900|max:2099',
            'isbn'          => 'nullable|string|max:20|unique:livros,isbn,' . $livro->id,
            'curso'         => 'required|string|max:100',
            'localizacao'   => 'nullable|string|max:100',
            'cor'           => 'nullable|string|max:7',
            'estoque_minimo'=> 'required|integer|min:0',
        ]);

        $livro->update($dados);
        return redirect()->route('livros.show', $livro)->with('sucesso', 'Livro atualizado!');
    }

    public function destroy(Livro $livro)
    {
        $livro->update(['ativo' => false]);
        return redirect()->route('livros.index')->with('sucesso', 'Livro removido do estoque.');
    }

    public function entrada(Request $request, Livro $livro)
    {
        $request->validate(['quantidade' => 'required|integer|min:1']);

        $livro->increment('quantidade', $request->quantidade);

        Movimentacao::create([
            'livro_id'   => $livro->id,
            'user_id'    => auth()->id(),
            'tipo'       => 'entrada',
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao ?? 'Entrada de estoque',
        ]);

        return back()->with('sucesso', "Entrada de {$request->quantidade} unidade(s) registrada!");
    }

    public function saida(Request $request, Livro $livro)
    {
        $request->validate(['quantidade' => 'required|integer|min:1']);

        if ($livro->quantidade < $request->quantidade) {
            return back()->withErrors(['quantidade' => 'Quantidade insuficiente em estoque.']);
        }

        $livro->decrement('quantidade', $request->quantidade);

        Movimentacao::create([
            'livro_id'   => $livro->id,
            'user_id'    => auth()->id(),
            'tipo'       => 'saida',
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao ?? 'Saída de estoque',
        ]);

        return back()->with('sucesso', "Saída de {$request->quantidade} unidade(s) registrada!");
    }
}
