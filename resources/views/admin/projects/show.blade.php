@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"><img class="my-2" style="width: 100%; height:300px"
                    src="{{ asset('storage') . '/' . $project->cover_image }}" alt="{{ $project->title }}">
            </div>
            <div class="col-8">
                <h2>{{ $project->title }}</h2>
                <p>Tipologia progetto: {{ $project->type ? $project->type->name : 'Non inserito' }}</p>
                <a href="{{ $project->link }}">link alla pagina git-hub</a>
                <p>{{ $project->description }}</p>
                <p>{{ $project->slug }}</p>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end align-items-center">
                    <div>
                        <a href="{{ route('admin.projects.edit', ['project' => $project['id']]) }}"
                            class="btn btn-warning ms-1 ">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                    </div>
                    <form class=" m-2" action="{{ route('admin.projects.destroy', ['project' => $project['id']]) }}"
                        method="POST" onsubmit="return confirm('sei sicuro di voler eliminare il progetto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
