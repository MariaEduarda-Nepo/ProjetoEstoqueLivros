@extends('layouts.app')

@section('title', 'Home · SENAI')
@section('page-title') <span style="color:#CB102E">SENAI</span> · Home @endsection

@section('content')
<style>
    .home-greeting {
        display: flex; align-items: center; gap: 16px;
        background: #CB102E; color: white;
        border-radius: 16px; padding: 24px 28px; margin-bottom: 28px;
    }
    .home-greeting .av {
        width: 52px; height: 52px; border-radius: 50%;
        background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4);
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; font-weight: 800;
    }
    .home-greeting .txt .hello { font-size: 13px; opacity: .75; }
    .home-greeting .txt .name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 26px; font-weight: 900; letter-spacing: 1px;
    }
    .quick-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;
        max-width: 500px;
    }
    .quick-card {
        background: white; border-radius: 14px;
        padding: 28px 20px; text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        text-decoration: none; color: #333;
        transition: transform .15s, box-shadow .15s;
        display: flex; flex-direction: column; align-items: center; gap: 10px;
    }
    .quick-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.13); }
    .quick-card.red  { background: #CB102E; color: white; }
    .quick-card.dark { background: #1a1a1a; color: white; }
    .quick-card .qicon { font-size: 36px; }
    .quick-card .qlabel {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px; font-weight: 800; letter-spacing: 1px;
    }
</style>

<div class="home-greeting">
    <div class="av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    <div class="txt">
        <div class="hello">Bem-vindo(a) de volta!</div>
        <div class="name">{{ auth()->user()->name }}</div>
    </div>
</div>

<div class="quick-grid">
    <a href="{{ route('livros.index') }}" class="quick-card red">
        <span class="qicon">📦</span>
        <span class="qlabel">Estoque</span>
    </a>
    <a href="{{ route('livros.create') }}" class="quick-card">
        <span class="qicon">➕</span>
        <span class="qlabel">Novo Livro</span>
    </a>
    <a href="{{ route('relatorio') }}" class="quick-card">
        <span class="qicon">📊</span>
        <span class="qlabel">Relatório</span>
    </a>
    <a href="{{ route('perfil') }}" class="quick-card dark">
        <span class="qicon">👤</span>
        <span class="qlabel">Perfil</span>
    </a>
</div>
@endsection
