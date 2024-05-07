@extends('layouts.app')

@section('title', 'Empleado')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Editar empleado "{{ $employees->user->name }}"</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('/admin/employees/' . $employees->user->id . '/edit') }}">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombres</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $employees->user->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Apellidos</label>
                                <input type="text" class="form-control" name="lastname"
                                    value="{{ old('lastname', $employees->user->lastname) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Teléfono</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone', $employees->user->phone) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Correo</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email', $employees->user->email) }}">
                            </div>
                        </div>
                        <!--
                                                    <div class="col-sm-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Contraseña</label>
                                                            <input type="text" class="form-control" name="password"
                                                                value="{{ old('password', $employees->user->password) }}">
                                                        </div>
                                                    </div>
                                                    -->
                    </div>
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/employees/') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
