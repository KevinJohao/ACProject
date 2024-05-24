@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Crear proyecto</h4>
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
                                        <form method="post" action="{{ url('/admin/projects/') }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombre del proyecto</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cliente</label>
                                                        <select class="form-control" name="client_id">
                                                            <option value="">Selecciona un cliente</option>
                                                            <!-- Opción vacía -->
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Encargado</label>
                                                        <select class="form-control" name="employee_id">
                                                            <option value="">Selecciona un empleado</option>
                                                            <!-- Opción vacía -->
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lugar</label>
                                                        <input type="text" class="form-control" name="place"
                                                            value="{{ old('place') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fecha de inicio</label>
                                                        <input type="date" class="form-control" name="start_date"
                                                            value="{{ old('start_date') }}" onfocus="(this.type='date')"
                                                            onblur="(this.type='text')">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fecha de entrega</label>
                                                        <input type="date" class="form-control" name="due_date"
                                                            value="{{ old('due_date') }}" onfocus="(this.type='date')"
                                                            onblur="(this.type='text')">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Valor total</label>
                                                        <input type="text" class="form-control" name="total_value"
                                                            value="{{ old('total_value') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="task_status_id"
                                                            value=1>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Registrar documento</button>
                                            <a href="{{ url('/admin/dashboard') }}"
                                                class="btn bg-default mt-3">Cancelar</a>
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
