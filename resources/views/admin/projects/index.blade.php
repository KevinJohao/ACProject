@extends('layouts.app')

@section('title', 'Listado de proyectos')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de proyectos</h2>

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/projects/create') }}" class="btn btn-primary btn-round">Nuevo proyecto</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre del proyecto</th>
                                    <th>Cliente</th>
                                    <th>Encargado</th>
                                    <th>Lugar del proyecto</th>
                                    <th class="col-xs-1 text-center">Fecha inicio</th>
                                    <th class="col-xs-1 text-center">Fecha entrega</th>
                                    <th class="col-xs-1 text-center">Precio</th>
                                    <th class="col-xs-1 text-center">Estado</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td class="text-left">{{ $project->name }}</td>
                                        <td class="text-left">{{ $project->client->user->name }}
                                        </td>
                                        <td class="text-left">{{ $project->employee->user->name }}
                                        </td>
                                        <td class="text-left">{{ $project->place }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->due_date }}</td>
                                        <td class="text-center">&dollar; {{ $project->total_value }}</td>
                                        <td class="text-center">{{ $project->TaskStatus->name }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ url('/admin/projects/' . $project->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/admin/projects/' . $project->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver proyecto"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="{{ url('/admin/projects/' . $project->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar proyecto"
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
                        <div class="row">
                            {{ $projects->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
