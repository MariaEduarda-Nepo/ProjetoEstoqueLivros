<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Informe o usuário.',
            'password.required' => 'Informe a senha.',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['username' => 'Usuário ou senha incorretos.'])->withInput();
    }

    public function showCadastro()
    {
        return view('auth.cadastro');
    }

    public function cadastro(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            're'       => 'nullable|string|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Informe um nome de usuário.',
            'username.unique'   => 'Este usuário já está em uso.',
            'email.required'    => 'Informe o e-mail institucional.',
            'email.unique'      => 'Este e-mail já está cadastrado.',
            'password.required' => 'Defina uma senha.',
            'password.min'      => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed'=> 'As senhas não coincidem.',
        ]);

        $user = User::create([
            'name'     => $request->username,
            'username' => $request->username,
            're'       => $request->re,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'aluno',
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
