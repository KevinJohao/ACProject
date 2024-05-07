@extends('layouts.app')

@section('title', 'Trámite')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Editar trámite "{{ $type_process->name }}"</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <style>
                    .form-group {
                        height: 100px;
                        /* Ajusta este valor según tus necesidades */
                    }

                    .form-group input,
                    .form-group textarea {
                        height: 100%;
                        /* Esto hará que el input y el textarea llenen la altura de su contenedor .form-group */
                    }
                </style>
                <form method="post" action="{{ url('/admin/type_processes/' . $type_process->id . '/edit') }}">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $type_process->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Descripción</label>
                                <textarea rows="4" class="form-control" name="description">{{ old('description', $type_process->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/type_processes/') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
