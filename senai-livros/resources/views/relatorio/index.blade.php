@extends('layouts.app')

@section('title', 'Relatório · SENAI')
@section('page-title') 📊 Relatório @endsection

@section('content')
<style>
    .report-header {
        background: #CB102E; color: white;
        border-radius: 14px; padding: 20px 28px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 28px; font-weight: 900;
        letter-spacing: 2px; margin-bottom: 28px;
        display: inline-block;
    }
    .bar-wrap { margin-bottom: 10px; }
    .bar-label { display:flex; justify-content:space-between; font-size:13px; margin-bottom:4px; }
    .bar-track { background:#f0f0f0; border-radius:4px; height:10px; overflow:hidden; }
    .bar-fill  { height:100%; border-radius:4px; background:#CB102E; transition: width 1s ease; }
</style>

<div class="report-header">RELATÓRIO</div>

{{-- Stats grid --}}
<div class="stat-grid">
    <div class="stat-card red-accent">
        <div class="val">{{ $totalLivros }}</div>
        <div class="lbl">Total de livros</div>
    </div>
    <div class="stat-card orange-accent">
        <div class="val">{{ $estoqueBaixo }}</div>
        <div class="lbl">Estoque baixo</div>
    </div>
    <div class="stat-card green-accent">
        <div class="val">{{ $titulosAtivos }}</div>
        <div class="lbl">Títulos com estoque</div>
    </div>
    <div class="stat-card blue-accent">
        <div class="val">{{ max(0, $emprestados) }}</div>
        <div class="lbl">Emprestados</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">

    {{-- Top Cursos --}}
    <div class="card">
        <div class="card-title">📚 Top Cursos — Quantidade em Estoque</div>
        @php $maxCurso = $topCursos->max('total') ?: 1; @endphp
        @foreach($topCursos as $item)
        <div class="bar-wrap">
            <div class="bar-label">
                <span style="font-weight:600;color:#333;">{{ $item->curso }}</span>
                <span style="color:#CB102E;font-weight:700;">{{ $item->total }}</span>
            </div>
            <div class="bar-track">
                <div class="bar-fill" style="width:{{ round($item->total / $maxCurso * 100) }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Últimas movimentações --}}
    <div class="card">
        <div class="card-title">🔄 Últimas Movimentações</div>
        @if($ultimasMovimentacoes->isEmpty())
            <p style="color:#888;font-size:14px;">Nenhuma movimentação registrada.</p>
        @else
            @foreach($ultimasMovimentacoes as $mov)
            <div style="display:flex;justify-content:space-between;align-items:center;
                        padding:10px 0;border-bottom:1px solid #f5f5f5;">
                <div>
                    <div style="font-size:13px;font-weight:600;color:#1a1a1a;">
                        {{ Str::limit($mov->livro->titulo, 30) }}
                    </div>
                    <div style="font-size:11px;color:#aaa;">
                        {{ $mov->user->name }} · {{ $mov->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
                <span class="badge {{ $mov->tipo === 'entrada' ? 'badge-green' : 'badge-red' }}">
                    {{ $mov->tipo === 'entrada' ? '⬆' : '⬇' }} {{ $mov->quantidade }} un.
                </span>
            </div>
            @endforeach
        @endif
    </div>

</div>

{{-- Livros com estoque baixo --}}
@php $baixo = \App\Models\Livro::where('ativo', true)->whereColumn('quantidade', '<=', 'estoque_minimo')->get(); @endphp
@if($baixo->isNotEmpty())
<div class="card">
    <div class="card-title" style="color:#CB102E;">⚠ Livros com Estoque Baixo</div>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Curso</th>
                <th>Localização</th>
                <th style="text-align:center;">Estoque Atual</th>
                <th style="text-align:center;">Mínimo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($baixo as $l)
            <tr>
                <td style="font-weight:600;">{{ $l->titulo }}</td>
                <td><span class="badge badge-gray">{{ $l->curso }}</span></td>
                <td style="color:#888;font-size:13px;">{{ $l->localizacao ?? '—' }}</td>
                <td style="text-align:center;"><span class="badge badge-red">{{ $l->quantidade }}</span></td>
                <td style="text-align:center;color:#888;">{{ $l->estoque_minimo }}</td>
                <td><a href="{{ route('livros.show', $l) }}" class="btn btn-outline btn-sm">Ver</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
