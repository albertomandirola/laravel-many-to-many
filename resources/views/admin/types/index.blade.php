@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content d-flex align-items-center">
                    <div class="fw-bold">Aggiungi un nuovo progetto: </div>
                    <a class="btn btn-primary fw-bold m-3" href="{{ route('admin.types.create') }}" role="button">Aggiungi</a>
                </div>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">slug</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td scope="row">{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->slug }}</td>

                                <td>
                                    <div class="d-flex align-items-center">

                                        <a href="{{ route('admin.types.show', ['type' => $type['id']]) }}"
                                            class="btn btn-secondary">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>


                                        <a href="{{ route('admin.types.edit', ['type' => $type['id']]) }}"
                                            class="btn btn-warning ms-1 ">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>

                                        <form class=" m-2"
                                            action="{{ route('admin.types.destroy', ['type' => $type['id']]) }}"
                                            method="POST"
                                            onsubmit="return confirm('sei sicuro di voler eliminare il progetto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
