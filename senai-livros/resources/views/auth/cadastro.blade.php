<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro · SENAI</title>
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
            border-radius: 20px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
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
            padding: 40px;
            display: flex; flex-direction: column; justify-content: center;
        }
        .cad-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px; font-weight: 900;
            background: #CB102E; color: white;
            padding: 8px 28px; border-radius: 8px;
            letter-spacing: 3px; margin-bottom: 28px;
            display: inline-block;
        }
        .form-group { margin-bottom: 14px; }
        .form-control {
            width: 100%; padding: 11px 14px; border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            font-family: 'Barlow', sans-serif; font-size: 14px; color: #333;
            transition: border .15s;
        }
        .form-control::placeholder { color: #bbb; }
        .form-control:focus { outline: none; border-color: #CB102E; }
        .form-control.is-invalid { border-color: #CB102E; }
        .error-msg { color: #CB102E; font-size: 12px; margin-top: 4px; }
        .pass-strength {
            height: 4px; border-radius: 2px; margin-top: 6px;
            background: #e0e0e0; overflow: hidden;
        }
        .pass-strength-bar { height: 100%; width: 0; background: #CB102E; transition: width .3s, background .3s; border-radius: 2px; }
        .btn-cad {
            width: 100%; padding: 13px; border-radius: 8px;
            background: #CB102E; color: white; border: none;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 900; letter-spacing: 2px;
            cursor: pointer; transition: background .15s; margin-top: 8px;
        }
        .btn-cad:hover { background: #8B0000; }
        .footer-link { text-align: center; margin-top: 18px; font-size: 13px; color: #888; }
        .footer-link a { color: #CB102E; font-weight: 600; text-decoration: none; }
        @media (max-width: 600px) {
            .split { flex-direction: column; margin: 16px; }
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
            <div class="cad-title">CADASTRO</div>
            <form method="POST" action="{{ route('cadastro') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" value="{{ old('username') }}"
                           class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                           placeholder="Defina um Usuário">
                    @error('username') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="re" value="{{ old('re') }}"
                           class="form-control" placeholder="RE (Registro do Aluno) — opcional">
                </div>
                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Email institucional">
                    @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="pwd"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="Defina uma Senha" oninput="checkPwd(this.value)">
                    <div class="pass-strength"><div class="pass-strength-bar" id="strength-bar"></div></div>
                    @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation"
                           class="form-control" placeholder="Confirme a Senha">
                </div>
                <button type="submit" class="btn-cad">Cadastrar</button>
            </form>
            <div class="footer-link">Já tem conta? <a href="{{ route('login') }}">Entrar</a></div>
        </div>
    </div>
    <script>
        function checkPwd(v) {
            const bar = document.getElementById('strength-bar');
            let s = 0;
            if (v.length >= 6) s += 25;
            if (v.length >= 10) s += 25;
            if (/[A-Z]/.test(v)) s += 25;
            if (/[0-9!@#$%]/.test(v)) s += 25;
            bar.style.width = s + '%';
            bar.style.background = s <= 25 ? '#CB102E' : s <= 50 ? '#E65100' : s <= 75 ? '#F9A825' : '#2E7D32';
        }
    </script>
</body>
</html>
