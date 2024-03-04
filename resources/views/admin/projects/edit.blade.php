@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h2 class="text-uppercase mb-0">Modifica del progetto "{{ $project->title }}"</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title" class="text-danger">Titolo</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="Inserisci il titolo"
                                    value="{{ old('title') ?? $project->title }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cover_image" class="text-danger">Immagine di Copertina</label>
                                <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror"
                                    name="cover_image" id="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($project->cover_image)
                                    <img src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="Immagine di Copertina del Progetto" class="img-fluid mt-2"
                                        style="max-width: 300px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description" class="text-danger">Descrizione</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Info aggiuntive" rows="5" required>{{ old('description') ?? $project->description }}</textarea>
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
