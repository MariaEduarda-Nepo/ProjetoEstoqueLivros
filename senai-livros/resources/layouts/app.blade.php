<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SENAI · Gerenciador de Livros')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --red:      #CB102E;
            --red-dark: #8B0000;
            --dark:     #1a1a1a;
            --gray:     #333333;
            --mid:      #888888;
            --light:    #F0F0F0;
            --white:    #FFFFFF;
            --radius:   12px;
            --shadow:   0 4px 24px rgba(0,0,0,0.10);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Barlow', sans-serif;
            background: var(--light);
            color: var(--gray);
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: 240px;
            background: var(--dark);
            display: flex; flex-direction: column;
            z-index: 100;
        }
        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-logo .brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px; font-weight: 900;
            color: var(--white); letter-spacing: 1px;
        }
        .sidebar-logo .brand span { color: var(--red); }
        .sidebar-logo .sub {
            font-size: 10px; color: var(--mid);
            letter-spacing: 2px; text-transform: uppercase;
            margin-top: 2px;
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            padding: 16px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--red);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: white; font-size: 14px;
            flex-shrink: 0;
        }
        .sidebar-user .info .name { font-size: 13px; font-weight: 600; color: white; }
        .sidebar-user .info .role { font-size: 11px; color: var(--mid); }
        .sidebar-nav { flex: 1; padding: 12px 0; }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 24px;
            color: #aaa; text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all .15s;
            border-left: 3px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            color: white; background: rgba(203,16,46,0.12);
            border-left-color: var(--red);
        }
        .nav-link .icon { font-size: 18px; width: 20px; text-align: center; }
        .sidebar-bottom {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .btn-logout {
            width: 100%; padding: 10px; border-radius: 8px;
            background: rgba(203,16,46,0.15); border: 1px solid rgba(203,16,46,0.3);
            color: var(--red); font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .15s;
            font-family: 'Barlow', sans-serif;
        }
        .btn-logout:hover { background: var(--red); color: white; }

        /* ── MAIN ── */
        .main {
            margin-left: 240px;
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .topbar {
            background: white; padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: 0 1px 8px rgba(0,0,0,0.04);
        }
        .topbar h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px; font-weight: 800;
            letter-spacing: .5px; color: var(--dark);
        }
        .topbar h1 span { color: var(--red); }
        .content { padding: 32px; flex: 1; }

        /* ── CARDS ── */
        .card {
            background: white; border-radius: var(--radius);
            box-shadow: var(--shadow); padding: 24px;
            margin-bottom: 24px;
        }
        .card-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 800;
            letter-spacing: .5px; margin-bottom: 16px;
            color: var(--dark);
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 8px;
            font-family: 'Barlow', sans-serif;
            font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            transition: all .15s; border: none;
        }
        .btn-red { background: var(--red); color: white; }
        .btn-red:hover { background: var(--red-dark); color: white; }
        .btn-outline { background: transparent; border: 2px solid var(--red); color: var(--red); }
        .btn-outline:hover { background: var(--red); color: white; }
        .btn-gray { background: var(--light); color: var(--gray); }
        .btn-gray:hover { background: #e0e0e0; }
        .btn-green { background: #2E7D32; color: white; }
        .btn-green:hover { background: #1B5E20; }
        .btn-sm { padding: 7px 14px; font-size: 12px; }

        /* ── FORMS ── */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--mid); margin-bottom: 6px;
        }
        .form-control {
            width: 100%; padding: 11px 14px; border-radius: 8px;
            border: 1.5px solid #e0e0e0; background: white;
            font-family: 'Barlow', sans-serif; font-size: 14px;
            color: var(--gray); transition: border .15s;
        }
        .form-control:focus { outline: none; border-color: var(--red); }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback { color: var(--red); font-size: 12px; margin-top: 4px; }

        /* ── TABLE ── */
        .table { width: 100%; border-collapse: collapse; }
        .table th {
            padding: 10px 16px; text-align: left;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--mid); border-bottom: 2px solid var(--light);
        }
        .table td { padding: 14px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .table tr:hover td { background: #fafafa; }

        /* ── BADGES ── */
        .badge {
            display: inline-block; padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .badge-red   { background: rgba(203,16,46,.1); color: var(--red); }
        .badge-green { background: rgba(46,125,50,.1); color: #2E7D32; }
        .badge-gray  { background: var(--light); color: var(--mid); }
        .badge-orange{ background: rgba(230,81,0,.1); color: #E65100; }

        /* ── ALERTS ── */
        .alert {
            padding: 12px 18px; border-radius: 8px;
            font-size: 14px; margin-bottom: 20px;
        }
        .alert-success { background: rgba(46,125,50,.1); color: #2E7D32; border-left: 4px solid #2E7D32; }
        .alert-error   { background: rgba(203,16,46,.1); color: var(--red); border-left: 4px solid var(--red); }

        /* ── BOOK CHIP ── */
        .book-chip {
            display: inline-flex; align-items: center; gap: 8px;
        }
        .book-spine {
            width: 10px; height: 36px; border-radius: 3px; flex-shrink: 0;
        }

        /* ── STAT CARD ── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card {
            background: white; border-radius: var(--radius);
            padding: 20px 24px; box-shadow: var(--shadow);
        }
        .stat-card .val {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 42px; font-weight: 900; line-height: 1;
            color: var(--dark);
        }
        .stat-card .lbl { font-size: 12px; color: var(--mid); margin-top: 4px; }
        .stat-card.red-accent { border-top: 4px solid var(--red); }
        .stat-card.orange-accent { border-top: 4px solid #E65100; }
        .stat-card.green-accent { border-top: 4px solid #2E7D32; }
        .stat-card.blue-accent { border-top: 4px solid #1565C0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .sidebar-logo .brand, .sidebar-logo .sub,
            .sidebar-user .info, .nav-link span,
            .sidebar-bottom .btn-logout span { display: none; }
            .nav-link { justify-content: center; padding: 14px; }
            .main { margin-left: 60px; }
            .content { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="brand">SENAI<span>·</span></div>
        <div class="sub">Gerenciador de Livros</div>
    </div>
    <div class="sidebar-user">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div class="info">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="role">{{ auth()->user()->role === 'admin' ? 'Administrador' : 'Aluno' }}</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('home') }}"         class="nav-link {{ request()->routeIs('home')         ? 'active' : '' }}"><span class="icon">🏠</span><span>Home</span></a>
        <a href="{{ route('livros.index') }}"  class="nav-link {{ request()->routeIs('livros.*')     ? 'active' : '' }}"><span class="icon">📚</span><span>Estoque</span></a>
        <a href="{{ route('livros.create') }}" class="nav-link {{ request()->routeIs('livros.create') ? 'active' : '' }}"><span class="icon">➕</span><span>Novo Livro</span></a>
        <a href="{{ route('relatorio') }}"     class="nav-link {{ request()->routeIs('relatorio')    ? 'active' : '' }}"><span class="icon">📊</span><span>Relatório</span></a>
        <a href="{{ route('perfil') }}"        class="nav-link {{ request()->routeIs('perfil')       ? 'active' : '' }}"><span class="icon">👤</span><span>Perfil</span></a>
    </nav>
    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <span>⬅ Sair</span>
            </button>
        </form>
    </div>
</aside>

<main class="main">
    <div class="topbar">
        <h1>@yield('page-title', '<span>SENAI</span> · Gerenciador de Livros')</h1>
        <div>@yield('topbar-actions')</div>
    </div>
    <div class="content">
        @if(session('sucesso'))
            <div class="alert alert-success">✅ {{ session('sucesso') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">⚠ {{ $errors->first() }}</div>
        @endif
        @yield('content')
    </div>
</main>

@stack('scripts')
</body>
</html>
