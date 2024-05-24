@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Editar proyecto "{{ $project->name }}"</h4>
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
                                            action="{{ url('/admin/projects/' . $project->id . '/edit') }}">
                                            @method('put')
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombre del proyecto</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', $project->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cliente</label>
                                                        <select class="form-control" name="client_id">
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}"
                                                                    @if ($client->id == $project->client_id) selected @endif>
                                                                    {{ $client->user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Encargado</label>
                                                        <select class="form-control" name="employee_id">
                                                            @foreach ($employees as $employee)
                                                                <option value="{{ $employee->id }}"
                                                                    @if ($employee->id == $project->employee_id) selected @endif>
                                                                    {{ $employee->user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lugar</label>
                                                        <input type="text" class="form-control" name="place"
                                                            value="{{ old('place', $project->place) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fecha de inicio</label>
                                                        <input type="date" class="form-control" name="start_date"
                                                            value="{{ old('start_date', $project->start_date) }}"
                                                            onfocus="(this.type='date')" onblur="(this.type='text')">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fecha de entrega</label>
                                                        <input type="date" class="form-control" name="due_date"
                                                            value="{{ old('due_date', $project->due_date) }}"
                                                            onfocus="(this.type='date')" onblur="(this.type='text')">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Valor total</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="total_value"
                                                            value="{{ old('total_value', $project->total_value) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <select class="form-control" name="task_status_id">
                                                            @foreach ($task_statuses as $task_status)
                                                                <option value="{{ $task_status->id }}"
                                                                    @if ($task_status->id == $project->task_status_id) selected @endif>
                                                                    {{ $task_status->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Guardar cambios</button>
                                            <a href="{{ url('/admin/dashboard/') }}"
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
