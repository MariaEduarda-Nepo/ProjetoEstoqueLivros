@extends('layouts.app')

@section('title', $livro->titulo . ' · SENAI')
@section('page-title') 📖 Detalhes do Livro @endsection

@section('topbar-actions')
    <a href="{{ route('livros.index') }}" class="btn btn-gray">← Voltar</a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">

    {{-- Coluna esquerda: info do livro --}}
    <div>
        <div class="card" style="border-top:4px solid {{ $livro->cor ?? '#CB102E' }};">
            <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:24px;">
                <div style="width:60px;height:90px;border-radius:6px;background:{{ $livro->cor ?? '#CB102E' }};
                            flex-shrink:0;display:flex;align-items:center;justify-content:center;
                            font-size:28px;box-shadow:4px 4px 12px rgba(0,0,0,0.15);">📖</div>
                <div>
                    <h2 style="font-family:'Barlow Condensed',sans-serif;font-size:24px;font-weight:900;
                               color:#1a1a1a;margin-bottom:6px;">{{ $livro->titulo }}</h2>
                    @if($livro->autor)
                        <div style="font-size:13px;color:#888;">{{ $livro->autor }} · {{ $livro->editora }}</div>
                    @endif
                </div>
            </div>

            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                @foreach([
                    ['Edição',      $livro->edicao],
                    ['Ano',         $livro->ano],
                    ['Curso',       $livro->curso],
                    ['Localização', $livro->localizacao],
                    ['ISBN',        $livro->isbn],
                ] as [$label, $val])
                @if($val)
                <tr>
                    <td style="padding:9px 0;color:#888;font-weight:600;width:120px;border-bottom:1px solid #f0f0f0;">{{ $label }}</td>
                    <td style="padding:9px 0;color:#333;border-bottom:1px solid #f0f0f0;">{{ $val }}</td>
                </tr>
                @endif
                @endforeach
            </table>

            <div style="margin-top:24px;background:#CB102E;color:white;border-radius:12px;
                        padding:20px;text-align:center;">
                <div style="font-family:'Barlow Condensed',sans-serif;font-size:52px;font-weight:900;line-height:1;">
                    {{ $livro->quantidade }}
                </div>
                <div style="font-size:13px;opacity:.85;margin-top:4px;">unidades em estoque</div>
                @if($livro->estoqueEstaAbaixo())
                    <div style="margin-top:8px;font-size:12px;background:rgba(255,255,255,.2);
                                border-radius:6px;padding:4px 10px;display:inline-block;">
                        ⚠ Estoque abaixo do mínimo ({{ $livro->estoque_minimo }})
                    </div>
                @endif
            </div>
        </div>

        {{-- Movimentações --}}
        @if(auth()->user()->isAdmin())
        <div class="card">
            <div class="card-title">Registrar Movimentação</div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <form method="POST" action="{{ route('livros.entrada', $livro) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Qtd. de Entrada</label>
                        <input type="number" name="quantidade" min="1" class="form-control" placeholder="Ex: 5">
                    </div>
                    <input type="text" name="observacao" class="form-control" placeholder="Observação" style="margin-bottom:10px;">
                    <button type="submit" class="btn btn-green" style="width:100%;">+ Entrada</button>
                </form>
                <form method="POST" action="{{ route('livros.saida', $livro) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Qtd. de Saída</label>
                        <input type="number" name="quantidade" min="1" class="form-control" placeholder="Ex: 2">
                    </div>
                    <input type="text" name="observacao" class="form-control" placeholder="Observação" style="margin-bottom:10px;">
                    <button type="submit" class="btn btn-red" style="width:100%;">- Saída</button>
                </form>
            </div>
        </div>
        @endif
    </div>

    {{-- Coluna direita: movimentações + ações --}}
    <div>
        @if(auth()->user()->isAdmin())
        <div class="card" style="margin-bottom:16px;">
            <div style="display:flex;gap:10px;">
                <a href="{{ route('livros.edit', $livro) }}" class="btn btn-outline" style="flex:1;justify-content:center;">✏ Editar</a>
                <form method="POST" action="{{ route('livros.destroy', $livro) }}" onsubmit="return confirm('Remover este livro do estoque?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-gray">🗑 Remover</button>
                </form>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-title">Últimas Movimentações</div>
            @if($movimentacoes->isEmpty())
                <p style="color:#888;font-size:14px;">Nenhuma movimentação registrada.</p>
            @else
                @foreach($movimentacoes as $mov)
                <div style="display:flex;align-items:center;justify-content:space-between;
                            padding:10px 0;border-bottom:1px solid #f0f0f0;">
                    <div>
                        <div style="font-size:13px;font-weight:600;color:#333;">
                            {{ $mov->tipo === 'entrada' ? '⬆ Entrada' : '⬇ Saída' }}
                            · <span style="color:{{ $mov->tipo === 'entrada' ? '#2E7D32' : '#CB102E' }}">
                                {{ $mov->quantidade }} un.
                            </span>
                        </div>
                        <div style="font-size:11px;color:#aaa;">
                            {{ $mov->user->name }} · {{ $mov->created_at->format('d/m/Y H:i') }}
                        </div>
                        @if($mov->observacao)
                            <div style="font-size:11px;color:#888;">{{ $mov->observacao }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
