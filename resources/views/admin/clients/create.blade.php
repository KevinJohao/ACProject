@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Crear cliente</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="card mt-4">
                                    <div class="card-body p-3">
                                        <form method="post" action="{{ url('/admin/clients/') }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombres</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Apellidos</label>
                                                        <input type="text" class="form-control" name="lastname"
                                                            value="{{ old('lastname') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Teléfono</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ old('phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Correo</label>
                                                        <input type="text" class="form-control" name="email"
                                                            alue="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lugar de trabajo</label>
                                                        <input type="text" class="form-control" name="work_place"
                                                            value="{{ old('work_place') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Contraseña</label>
                                                        <input type="text" class="form-control" name="password"
                                                            value="{{ old('password') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Registrar cliente</button>
                                            <a href="{{ url('/admin/clients/') }}" class="btn bg-default mt-3">Cancelar</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
