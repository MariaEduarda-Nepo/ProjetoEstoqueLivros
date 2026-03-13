<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor')->nullable();
            $table->string('editora')->nullable();
            $table->string('edicao')->nullable();
            $table->year('ano')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->string('curso'); // Ex: Eletrotécnica, Mecânica, TI...
            $table->string('localizacao')->nullable(); // Ex: Prateleira B-3
            $table->string('cor')->nullable()->default('#CB102E'); // cor da capa no app
            $table->integer('quantidade')->default(0);
            $table->integer('estoque_minimo')->default(5);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
