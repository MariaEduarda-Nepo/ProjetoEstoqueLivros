@extends('layouts.app')

@section('title', 'Estoque · SENAI')
@section('page-title') 📦 Estoque de Livros @endsection

@section('topbar-actions')
    <a href="{{ route('livros.create') }}" class="btn btn-red">➕ Novo Livro</a>
@endsection

@section('content')
<div class="card">
    {{-- Filtros --}}
    <form method="GET" action="{{ route('livros.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;">
        <input type="text" name="busca" value="{{ request('busca') }}"
               class="form-control" placeholder="🔍  Buscar livro..."
               style="flex:1;min-width:200px;max-width:340px;">
        <select name="curso" class="form-control" style="max-width:200px;">
            <option value="">Todos os cursos</option>
            @foreach($cursos as $c)
                <option value="{{ $c }}" {{ request('curso') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-red">Filtrar</button>
        @if(request('busca') || request('curso'))
            <a href="{{ route('livros.index') }}" class="btn btn-gray">✕ Limpar</a>
        @endif
    </form>

    {{-- Tabela --}}
    @if($livros->isEmpty())
        <div style="text-align:center;padding:48px;color:#888;">
            <div style="font-size:48px;margin-bottom:12px;">📭</div>
            <p>Nenhum livro encontrado.</p>
        </div>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Livro</th>
                <th>Curso</th>
                <th>Edição / Ano</th>
                <th>Localização</th>
                <th style="text-align:center;">Estoque</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
            <tr>
                <td>
                    <div class="book-chip">
                        <div class="book-spine" style="background:{{ $livro->cor ?? '#CB102E' }}"></div>
                        <div>
                            <div style="font-weight:600;color:#1a1a1a;">{{ $livro->titulo }}</div>
                            @if($livro->isbn)
                                <div style="font-size:11px;color:#888;">ISBN: {{ $livro->isbn }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge badge-gray">{{ $livro->curso }}</span>
                </td>
                <td style="color:#666;">{{ $livro->edicao }} {{ $livro->ano ? '· '.$livro->ano : '' }}</td>
                <td style="color:#666;font-size:13px;">{{ $livro->localizacao ?? '—' }}</td>
                <td style="text-align:center;">
                    @if($livro->estoqueEstaAbaixo())
                        <span class="badge badge-red" title="Estoque baixo!">{{ $livro->quantidade }} un. ⚠</span>
                    @else
                        <span class="badge badge-green">{{ $livro->quantidade }} un.</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('livros.show', $livro) }}" class="btn btn-outline btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top:20px;">{{ $livros->links() }}</div>
    @endif
</div>
@endsection
