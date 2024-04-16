@extends('layouts.app')

@section('title', 'Proyecto')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">

                @foreach ($processes as $process)
                    <h2 class="title">Información del proyecto "{{ $process->project->name }}"</h2>
                @endforeach

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/processes/create') }}" class="btn btn-primary btn-round">Nuevo trámite</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Tipo de trámite</th>
                                    <th>VSM</th>
                                    <th class="col-xs-2 text-center">Próxima revisión</th>
                                    <th class="col-xs-2 text-center">Valor del trámite</th>
                                    <th class="col-xs-2 text-center">Estado</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($processes as $process)
                                    <tr>
                                        <td class="text-center">{{ $process->id }}</td>
                                        <td class="text-left">{{ $process->typeProcess->name }}</td>
                                        <td class="text-left">{{ $process->vsm }}</td>
                                        <td>{{ $process->next_review }}</td>
                                        <td class="text-center">&dollar; {{ $process->process_value }}</td>
                                        <td class="text-center">{{ $process->taskStatus->name }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ url('/admin/processes/' . $process->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/admin/processes/' . $process->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver trámite"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-info"></i>
                                                </a>

                                                <a href="{{ url('/admin/processes/' . $process->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar trámite"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" rel="tooltip" title="Eliminar"
                                                    class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $processes->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
