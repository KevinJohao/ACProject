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
                <h2 class="title text-center">Editar trámite "{{ $process->typeProcess->name }}"</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('/admin/processes/' . $process->id . '/edit') }}">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Tipo de trámite</label>
                                <select class="form-control" name="type_process_id">
                                    @foreach ($type_processes as $type_process)
                                        <option value="{{ $type_process->id }}"
                                            @if ($type_process->id == $process->typeProcess->id) selected @endif>
                                            {{ $type_process->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">VSM</label>
                                <input type="text" class="form-control" name="vsm"
                                    value="{{ old('vsm', $process->vsm) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Próxima revisión</label>
                                <input type="date" class="form-control" name="next_review"
                                    value="{{ old('next_review', $process->next_review) }}" onfocus="(this.type='date')"
                                    onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Valor del trámite</label>
                                <input type="number" step="0.01" class="form-control" name="process_value"
                                    value="{{ old('process_value', $process->process_value) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Estado</label>
                                <select class="form-control" name="task_status_id">
                                    @foreach ($task_statuses as $task_status)
                                        <option value="{{ $task_status->id }}"
                                            @if ($task_status->id == $process->task_status_id) selected @endif>
                                            {{ $task_status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/processes/' . $process->project->id . '/show') }}"
                        class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
