@extends('layouts.app')

@section('title', 'Perfil · SENAI')
@section('page-title') 👤 Meu Perfil @endsection

@section('content')
<div class="card" style="max-width:500px;">
    <div style="display:flex;align-items:center;gap:20px;margin-bottom:28px;
                padding-bottom:20px;border-bottom:2px solid #f0f0f0;">
        <div style="width:72px;height:72px;border-radius:50%;background:#CB102E;
                    display:flex;align-items:center;justify-content:center;
                    font-size:32px;font-weight:800;color:white;flex-shrink:0;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <div style="font-family:'Barlow Condensed',sans-serif;font-size:24px;font-weight:900;color:#1a1a1a;">
                {{ auth()->user()->name }}
            </div>
            <div style="font-size:13px;color:#888;">
                {{ auth()->user()->role === 'admin' ? '⚙ Administrador' : '🎓 Aluno' }}
            </div>
        </div>
    </div>

    <table style="width:100%;border-collapse:collapse;font-size:14px;">
        <tr>
            <td style="padding:12px 0;color:#888;font-weight:700;width:140px;border-bottom:1px solid #f0f0f0;">Usuário</td>
            <td style="padding:12px 0;border-bottom:1px solid #f0f0f0;">{{ auth()->user()->username }}</td>
        </tr>
        <tr>
            <td style="padding:12px 0;color:#888;font-weight:700;border-bottom:1px solid #f0f0f0;">E-mail</td>
            <td style="padding:12px 0;border-bottom:1px solid #f0f0f0;">{{ auth()->user()->email }}</td>
        </tr>
        @if(auth()->user()->re)
        <tr>
            <td style="padding:12px 0;color:#888;font-weight:700;border-bottom:1px solid #f0f0f0;">RE</td>
            <td style="padding:12px 0;border-bottom:1px solid #f0f0f0;">{{ auth()->user()->re }}</td>
        </tr>
        @endif
        <tr>
            <td style="padding:12px 0;color:#888;font-weight:700;">Membro desde</td>
            <td style="padding:12px 0;">{{ auth()->user()->created_at->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div style="margin-top:24px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-red" style="width:100%;">⬅ Sair do sistema</button>
        </form>
    </div>
</div>
@endsection
