@extends('layouts.app')

@section('title', 'Nuevo documento')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Crear nuevo documento</h2>
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

                <form method="post" action="{{ url('/admin/docs') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <select class="form-control" name="client">
                                    <option value="">Selecciona un trámite</option> <!-- Opción vacía -->
                                    @foreach ($type_processes as $type_process)
                                        <option value="{{ $type_process->id }}">{{ $type_process->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Descripción</label>
                                <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Registrar trámite</button>
                    <a href="{{ url('/admin/docs/') }}" class="btn btn-default">Cancelar</a>
                </form>

            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
