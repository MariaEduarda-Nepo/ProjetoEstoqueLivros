@extends('layouts.app')

@section('title', 'Novo Livro · SENAI')
@section('page-title') ➕ Novo Livro @endsection

@section('topbar-actions')
    <a href="{{ route('livros.index') }}" class="btn btn-gray">← Voltar</a>
@endsection

@section('content')
<div class="card" style="max-width:700px;">
    <form method="POST" action="{{ route('livros.store') }}">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Título do Livro *</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}"
                       class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                       placeholder="Ex: Eletricidade Básica">
                @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" value="{{ old('autor', 'SENAI') }}"
                       class="form-control" placeholder="Ex: SENAI">
            </div>

            <div class="form-group">
                <label class="form-label">Editora</label>
                <input type="text" name="editora" value="{{ old('editora', 'SENAI Editora') }}"
                       class="form-control" placeholder="Ex: SENAI Editora">
            </div>

            <div class="form-group">
                <label class="form-label">Edição</label>
                <input type="text" name="edicao" value="{{ old('edicao') }}"
                       class="form-control" placeholder="Ex: 2ª Edição">
            </div>

            <div class="form-group">
                <label class="form-label">Ano</label>
                <input type="number" name="ano" value="{{ old('ano', date('Y')) }}"
                       class="form-control" min="1900" max="2099">
            </div>

            <div class="form-group">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}"
                       class="form-control {{ $errors->has('isbn') ? 'is-invalid' : '' }}"
                       placeholder="Ex: 978-85-0001-234">
                @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Curso *</label>
                <select name="curso" class="form-control {{ $errors->has('curso') ? 'is-invalid' : '' }}">
                    <option value="">Selecione o curso...</option>
                    @foreach($cursos as $c)
                        <option value="{{ $c }}" {{ old('curso') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                @error('curso') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Localização</label>
                <input type="text" name="localizacao" value="{{ old('localizacao') }}"
                       class="form-control" placeholder="Ex: Prateleira B-3">
            </div>

            <div class="form-group">
                <label class="form-label">Quantidade Inicial *</label>
                <input type="number" name="quantidade" value="{{ old('quantidade', 0) }}"
                       class="form-control {{ $errors->has('quantidade') ? 'is-invalid' : '' }}"
                       min="0">
                @error('quantidade') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Estoque Mínimo</label>
                <input type="number" name="estoque_minimo" value="{{ old('estoque_minimo', 5) }}"
                       class="form-control" min="0">
            </div>

            <div class="form-group">
                <label class="form-label">Cor da Capa</label>
                <div style="display:flex;gap:10px;align-items:center;">
                    <input type="color" name="cor" value="{{ old('cor', '#CB102E') }}"
                           style="width:48px;height:40px;border:none;cursor:pointer;border-radius:8px;padding:2px;">
                    <span style="font-size:13px;color:#888;">Cor exibida na listagem</span>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-red">💾 Cadastrar Livro</button>
            <a href="{{ route('livros.index') }}" class="btn btn-gray">Cancelar</a>
        </div>
    </form>
</div>
@endsection
