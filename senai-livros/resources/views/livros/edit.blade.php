@extends('layouts.app')

@section('title', 'Editar Livro · SENAI')
@section('page-title') ✏ Editar Livro @endsection

@section('topbar-actions')
    <a href="{{ route('livros.show', $livro) }}" class="btn btn-gray">← Voltar</a>
@endsection

@section('content')
<div class="card" style="max-width:700px;">
    <form method="POST" action="{{ route('livros.update', $livro) }}">
        @csrf
        @method('PUT')

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Título do Livro *</label>
                <input type="text" name="titulo" value="{{ old('titulo', $livro->titulo) }}"
                       class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}">
                @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" value="{{ old('autor', $livro->autor) }}" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Editora</label>
                <input type="text" name="editora" value="{{ old('editora', $livro->editora) }}" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Edição</label>
                <input type="text" name="edicao" value="{{ old('edicao', $livro->edicao) }}" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Ano</label>
                <input type="number" name="ano" value="{{ old('ano', $livro->ano) }}"
                       class="form-control" min="1900" max="2099">
            </div>

            <div class="form-group">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $livro->isbn) }}"
                       class="form-control {{ $errors->has('isbn') ? 'is-invalid' : '' }}">
                @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Curso *</label>
                <select name="curso" class="form-control">
                    @foreach($cursos as $c)
                        <option value="{{ $c }}" {{ old('curso', $livro->curso) == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Localização</label>
                <input type="text" name="localizacao" value="{{ old('localizacao', $livro->localizacao) }}" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Estoque Mínimo</label>
                <input type="number" name="estoque_minimo" value="{{ old('estoque_minimo', $livro->estoque_minimo) }}"
                       class="form-control" min="0">
            </div>

            <div class="form-group">
                <label class="form-label">Cor da Capa</label>
                <div style="display:flex;gap:10px;align-items:center;">
                    <input type="color" name="cor" value="{{ old('cor', $livro->cor ?? '#CB102E') }}"
                           style="width:48px;height:40px;border:none;cursor:pointer;border-radius:8px;padding:2px;">
                    <span style="font-size:13px;color:#888;">Cor exibida na listagem</span>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-red">💾 Salvar Alterações</button>
            <a href="{{ route('livros.show', $livro) }}" class="btn btn-gray">Cancelar</a>
        </div>
    </form>
</div>
@endsection
