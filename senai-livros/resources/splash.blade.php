<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI · Gerenciador de Livros</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Barlow+Condensed:wght@700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Barlow', sans-serif;
            background: #CB102E;
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        .splash-wrap {
            text-align: center; animation: fadeUp .6s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .logo-ring {
            width: 120px; height: 120px; border-radius: 50%;
            background: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 32px;
            border: 3px solid rgba(255,255,255,0.3);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.3); }
            50%       { box-shadow: 0 0 0 20px rgba(255,255,255,0); }
        }
        .logo-ring .book-icons { font-size: 48px; }
        .brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 48px; font-weight: 900;
            color: white; letter-spacing: 2px;
        }
        .tagline {
            font-size: 14px; color: rgba(255,255,255,0.8);
            letter-spacing: 1px; margin-top: 4px;
        }
        .sub {
            font-size: 12px; color: rgba(255,255,255,0.55);
            letter-spacing: 2px; text-transform: uppercase;
            margin-top: 6px;
        }
        .actions { margin-top: 48px; display: flex; flex-direction: column; gap: 14px; width: 280px; }
        .btn-white {
            display: block; padding: 14px;
            background: white; color: #CB102E;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 900; letter-spacing: 2px;
            border-radius: 50px; text-decoration: none;
            transition: transform .15s, box-shadow .15s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.25); }
        .btn-outline {
            display: block; padding: 14px;
            background: transparent; color: white;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 900; letter-spacing: 2px;
            border-radius: 50px; text-decoration: none;
            border: 2px solid rgba(255,255,255,0.6);
            transition: all .15s;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.15); border-color: white; }
        .footer { position: fixed; bottom: 24px; font-size: 11px; color: rgba(255,255,255,0.4); letter-spacing: 1px; }
    </style>
</head>
<body>
    <div class="splash-wrap">
        <div class="logo-ring">
            <span class="book-icons">📚</span>
        </div>
        <div class="brand">SENAI</div>
        <div class="tagline">Gerenciador de Livros Didáticos</div>
        <div class="sub">Sistema de Estoque</div>
        <div class="actions">
            <a href="{{ route('login') }}" class="btn-white">ENTRAR</a>
            <a href="{{ route('cadastro') }}" class="btn-outline">CADASTRAR</a>
        </div>
    </div>
    <div class="footer">Protótipo de Interface · SENAI 2025</div>
</body>
</html>
