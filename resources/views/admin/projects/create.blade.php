@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h2 class="text-uppercase mb-0">Aggiungi un progetto:</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="control-label">Titolo</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="Inserisci il Titolo"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cover_image" class="form-label">Immagine di Copertina</label>
                                <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror"
                                    name="cover_image" id="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="type_id" class="control-label m-1 text-danger ">Tipo di progetto</label>
                                <select name="type_id" id="type_id"
                                    class="form-select @error('type_id') is-invalid @enderror">
                                    <option value="">Seleziona tipo di progetto</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                    @error('type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="link" class="control-label">Link</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror"
                                    name="link" id="link" placeholder="Inserisci il Link a github"
                                    value="{{ old('link') }}" required>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label">Descrizione</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Info aggiuntive" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Salva</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
