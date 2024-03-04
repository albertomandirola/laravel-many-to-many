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
                        <form action="{{ route('admin.types.update', ['type' => $type->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name" class="text-danger">Titolo</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Inserisci il titolo"
                                    value="{{ old('name') ?? $type->name }}" required>
                                @error('name')
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
