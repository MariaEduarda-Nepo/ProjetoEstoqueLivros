<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'titulo', 'autor', 'editora', 'edicao', 'ano', 'isbn',
        'curso', 'localizacao', 'cor', 'quantidade', 'estoque_minimo', 'ativo'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function estoqueEstaAbaixo(): bool
    {
        return $this->quantidade <= $this->estoque_minimo;
    }

    public function totalEmprestados(): int
    {
        $saidas  = $this->movimentacoes()->where('tipo', 'saida')->sum('quantidade');
        $entradas = $this->movimentacoes()->where('tipo', 'entrada')->sum('quantidade');
        return max(0, $saidas - $entradas + ($this->getOriginal('quantidade') ?? 0));
    }
}
