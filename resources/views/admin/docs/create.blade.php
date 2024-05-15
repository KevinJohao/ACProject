@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Crear documento</h4>
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
                                        <form method="post" action="{{ url('/admin/docs/') }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <select class="form-control" name="type_process_id">
                                                            <option value="">Selecciona un trámite</option>
                                                            <!-- Opción vacía -->
                                                            @foreach ($type_processes as $type_process)
                                                                <option value="{{ $type_process->id }}">
                                                                    {{ $type_process->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Descripción</label>
                                                        <textarea class="form-control" rows="3" name="Description">{{ old('Description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Registrar documento</button>
                                            <a href="{{ url('/admin/docs/') }}" class="btn bg-default mt-3">Cancelar</a>
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
