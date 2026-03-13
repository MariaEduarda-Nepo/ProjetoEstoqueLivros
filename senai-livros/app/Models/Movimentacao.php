<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes'; // ← adicionar esta linha

    protected $fillable = ['livro_id', 'user_id', 'tipo', 'quantidade', 'observacao'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}