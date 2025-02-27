@extends('layouts.app')

@section('title', 'Listado de proyectos')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Editar proyecto seleccionado</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('/admin/projects/' . $project->id . '/edit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del proyecto</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $project->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Cliente</label>
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
                            <div class="form-group label-floating">
                                <label class="control-label">Encargado</label>
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
                            <div class="form-group label-floating">
                                <label class="control-label">Lugar</label>
                                <input type="text" class="form-control" name="place"
                                    value="{{ old('place', $project->place) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Fecha de inicio</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ old('start_date', $project->start_date) }}" onfocus="(this.type='date')"
                                    onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Fecha de entrega</label>
                                <input type="date" class="form-control" name="due_date"
                                    value="{{ old('due_date', $project->due_date) }}" onfocus="(this.type='date')"
                                    onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Valor total</label>
                                <input type="number" step="0.01" class="form-control" name="total_value"
                                    value="{{ old('total_value', $project->total_value) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Estado</label>
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
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
