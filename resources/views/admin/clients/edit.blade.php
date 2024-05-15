@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Editar cliente "{{ $clients->user->name }}"</h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="card mt-4">
                                    <div class="card-body p-3">
                                        <form method="post"
                                            action="{{ url('/admin/clients/' . $clients->user->id . '/edit') }}">
                                            @method('put')
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombres</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', $clients->user->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Apellidos</label>
                                                        <input type="text" class="form-control" name="lastname"
                                                            value="{{ old('lastname', $clients->user->lastname) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Teléfono</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ old('phone', $clients->user->phone) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Correo</label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ old('email', $clients->user->email) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lugar de trabajo</label>
                                                        <input type="text" class="form-control" name="work_place"
                                                            value="{{ old('work_place', $clients->work_place) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Guardar cambios</button>
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
