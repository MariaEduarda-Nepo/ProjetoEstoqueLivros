<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Movimentacao;

class RelatorioController extends Controller
{
    public function index()
    {
        $totalLivros    = Livro::where('ativo', true)->count();
        $estoqueBaixo   = Livro::where('ativo', true)->whereColumn('quantidade', '<=', 'estoque_minimo')->count();
        $titulosAtivos  = Livro::where('ativo', true)->where('quantidade', '>', 0)->count();
        $emprestados    = Movimentacao::where('tipo', 'saida')->sum('quantidade')
                        - Movimentacao::where('tipo', 'entrada')->sum('quantidade');

        $topCursos = Livro::where('ativo', true)
            ->selectRaw('curso, SUM(quantidade) as total')
            ->groupBy('curso')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $ultimasMovimentacoes = Movimentacao::with(['livro', 'user'])
            ->latest()
            ->limit(10)
            ->get();

        return view('relatorio.index', compact(
            'totalLivros', 'estoqueBaixo', 'titulosAtivos',
            'emprestados', 'topCursos', 'ultimasMovimentacoes'
        ));
    }
}
