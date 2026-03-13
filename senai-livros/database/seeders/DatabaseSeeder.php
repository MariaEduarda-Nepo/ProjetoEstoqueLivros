<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Livro;
use App\Models\Movimentacao;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuários
        $admin = User::create([
            'name'     => 'Administrador SENAI',
            'username' => 'admin',
            'email'    => 'admin@senai.br',
            'password' => Hash::make('senha123'),
            'role'     => 'admin',
        ]);

        $aluno = User::create([
            'name'     => 'Maria',
            'username' => 'Maria',
            're'       => '12345678',
            'email'    => 'maria.alves@testebr',
            'password' => Hash::make('senha123'),
            'role'     => 'aluno',
        ]);

        // Livros de exemplo
        $livros = [
            ['titulo' => 'Matemática Aplicada',      'edicao' => 'Ed. 3',  'ano' => 2023, 'curso' => 'Eletrotécnica', 'localizacao' => 'Prateleira A-1', 'quantidade' => 42, 'cor' => '#CB102E'],
            ['titulo' => 'Eletricidade Básica',       'edicao' => 'Ed. 2',  'ano' => 2022, 'curso' => 'Eletrotécnica', 'localizacao' => 'Prateleira B-3', 'quantidade' => 18, 'cor' => '#1565C0', 'isbn' => '978-85-0001-234'],
            ['titulo' => 'Segurança do Trabalho',     'edicao' => 'Ed. 5',  'ano' => 2024, 'curso' => 'Seg. Trabalho', 'localizacao' => 'Prateleira C-2', 'quantidade' => 3,  'cor' => '#2E7D32'],
            ['titulo' => 'Mecânica Industrial',       'edicao' => 'Ed. 1',  'ano' => 2024, 'curso' => 'Mecânica',      'localizacao' => 'Prateleira D-1', 'quantidade' => 27, 'cor' => '#E65100'],
            ['titulo' => 'Lógica de Programação',     'edicao' => 'Ed. 4',  'ano' => 2024, 'curso' => 'TI',            'localizacao' => 'Prateleira E-2', 'quantidade' => 5,  'cor' => '#6A1B9A'],
            ['titulo' => 'Circuitos Elétricos',       'edicao' => 'Ed. 1',  'ano' => 2021, 'curso' => 'Eletrotécnica', 'localizacao' => 'Prateleira B-1', 'quantidade' => 15, 'cor' => '#CB102E'],
            ['titulo' => 'Automação Industrial',      'edicao' => 'Ed. 2',  'ano' => 2023, 'curso' => 'Mecânica',      'localizacao' => 'Prateleira D-3', 'quantidade' => 8,  'cor' => '#00695C'],
            ['titulo' => 'Banco de Dados',            'edicao' => 'Ed. 3',  'ano' => 2022, 'curso' => 'TI',            'localizacao' => 'Prateleira E-1', 'quantidade' => 12, 'cor' => '#4527A0'],
            ['titulo' => 'Hidráulica e Pneumática',   'edicao' => 'Ed. 1',  'ano' => 2023, 'curso' => 'Mecânica',      'localizacao' => 'Prateleira D-2', 'quantidade' => 4,  'cor' => '#558B2F'],
            ['titulo' => 'Redes de Computadores',     'edicao' => 'Ed. 2',  'ano' => 2024, 'curso' => 'TI',            'localizacao' => 'Prateleira E-3', 'quantidade' => 6,  'cor' => '#1565C0'],
        ];

        foreach ($livros as $dados) {
            Livro::create(array_merge($dados, ['autor' => 'SENAI', 'editora' => 'SENAI Editora', 'estoque_minimo' => 5]));
        }

        // Movimentações de exemplo
        Movimentacao::create(['livro_id' => 2, 'user_id' => $aluno->id, 'tipo' => 'saida',   'quantidade' => 2, 'observacao' => 'Empréstimo aluno']);
        Movimentacao::create(['livro_id' => 1, 'user_id' => $admin->id, 'tipo' => 'entrada', 'quantidade' => 10, 'observacao' => 'Reposição de estoque']);
        Movimentacao::create(['livro_id' => 5, 'user_id' => $aluno->id, 'tipo' => 'saida',   'quantidade' => 1, 'observacao' => 'Empréstimo aluno']);
    }
}
