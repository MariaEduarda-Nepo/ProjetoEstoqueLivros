<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'username', 're', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
