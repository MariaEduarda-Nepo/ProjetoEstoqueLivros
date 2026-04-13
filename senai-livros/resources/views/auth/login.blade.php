<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · SENAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Barlow', sans-serif;
            background: #F0F0F0;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .split {
            display: flex; width: 100%; max-width: 900px;
            min-height: 500px; border-radius: 20px;
            overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .left {
            background: #CB102E; flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 48px 40px; text-align: center;
        }
        .left .icon { font-size: 60px; margin-bottom: 20px; }
        .left .brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 40px; font-weight: 900;
            color: white; letter-spacing: 2px;
        }
        .left .tagline { font-size: 13px; color: rgba(255,255,255,0.75); margin-top: 8px; }
        .right {
            background: white; flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 48px 40px;
        }
        .login-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 32px; font-weight: 900;
            background: #CB102E; color: white;
            padding: 8px 32px; border-radius: 8px;
            letter-spacing: 3px; margin-bottom: 32px;
        }
        .form-group { width: 100%; margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 12px 14px; border-radius: 8px;
            border: 1.5px solid #e0e0e0; font-family: 'Barlow', sans-serif;
            font-size: 14px; color: #333; transition: border .15s;
        }
        .form-control:focus { outline: none; border-color: #CB102E; }
        .form-control.is-invalid { border-color: #CB102E; }
        .error-msg { color: #CB102E; font-size: 12px; margin-top: 4px; }
        .btn-red {
            width: 100%; padding: 13px; border-radius: 8px;
            background: #CB102E; color: white; border: none;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 900; letter-spacing: 2px;
            cursor: pointer; transition: background .15s; margin-top: 8px;
        }
        .btn-red:hover { background: #8B0000; }
        .forgot { text-align: center; margin-top: 14px; font-size: 13px; color: #888; }
        .forgot a { color: #CB102E; text-decoration: none; font-weight: 600; }
        .footer-link { text-align: center; margin-top: 24px; font-size: 13px; color: #888; }
        .footer-link a { color: #CB102E; font-weight: 600; text-decoration: none; }
        @media (max-width: 600px) {
            .split { flex-direction: column; margin: 16px; }
            .left { padding: 32px 24px; }
        }
    </style>
</head>
<body>
    <div class="split">
        <div class="left">
            <div class="icon">📚</div>
            <div class="brand">SENAI</div>
            <div class="tagline">Gerenciador de Livros Didáticos<br>Sistema de Estoque</div>
        </div>
        <div class="right">
            <div class="login-title">LOGIN</div>
            <form method="POST" action="{{ route('login') }}" style="width:100%">
                @csrf
                <div class="form-group">
                    <label class="form-label">Usuário:</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                           class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                           placeholder="Digite seu usuário" autocomplete="username">
                    @error('username') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Senha:</label>
                    <input type="password" name="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="••••••••" autocomplete="current-password">
                    @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn-red">ENTRAR</button>
            </form>
            <div class="forgot"><a href="#">Esqueci minha senha</a></div>
            <div class="footer-link">Não tem conta? <a href="{{ route('cadastro') }}">Cadastre-se</a></div>
        </div>
    </div>
</body>
</html>
