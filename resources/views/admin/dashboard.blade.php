@extends('layouts.app')

@section('title', 'A&C Otavalo | Dashboard')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="team">
                    <div class="row">
                        <div class="wrapper">
                            <div class="nav-align-center">
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="active">
                                        <a href="#studio" role="tab" data-toggle="tab">
                                            <i class="material-icons">handyman</i>
                                            Proyectos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#work" role="tab" data-toggle="tab">
                                            <i class="material-icons">person</i>
                                            Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#shows" role="tab" data-toggle="tab">
                                            <i class="material-icons">assignment</i>
                                            Trámites
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#shows" role="tab" data-toggle="tab">
                                            <i class="material-icons">topic</i>
                                            Documentos
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content gallery">
                                    <div class="tab-pane active" id="studio">

                                        <div class="team">
                                            <div class="row">
                                                <a href="{{ url('/admin/projects/create') }}"
                                                    class="btn btn-primary btn-round">Nuevo proyecto</a>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre del proyecto</th>
                                                            <th>Cliente</th>
                                                            <th>Lugar del proyecto</th>
                                                            <th class="col-xs-2 text-center">Fecha inicio
                                                            </th>
                                                            <th class="col-xs-2 text-center">Fecha entrega
                                                            </th>
                                                            <th class="col-xs-1 text-right">Precio</th>
                                                            <th class="text-center">Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($projects as $project)
                                                            <tr>
                                                                <td class="text-left">{{ $project->name }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $project->user ? $project->user->name : 'sin nombre' }}
                                                                </td>
                                                                <td class="text-left">{{ $project->place }}
                                                                </td>
                                                                <td>{{ $project->start_date }}</td>
                                                                <td>{{ $project->due_date }}</td>
                                                                <td class="text-right">&dollar;
                                                                    {{ $project->total_value }}</td>
                                                                <td class="td-actions text-right">
                                                                    <form method="post"
                                                                        action="{{ url('/admin/projects/' . $project->id) }}">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <a href="{{ url('/admin/projects/' . $project->id . '/show') }}"
                                                                            type="button" rel="tooltip"
                                                                            title="Ver proyecto"
                                                                            class="btn btn-info btn-simple btn-xs">
                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                        <a href="{{ url('/admin/projects/' . $project->id . '/edit') }}"
                                                                            type="button" rel="tooltip"
                                                                            title="Editar proyecto"
                                                                            class="btn btn-success btn-simple btn-xs">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <button type="submit" rel="tooltip"
                                                                            title="Eliminar"
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
                                    <div class="tab-pane text-center" id="work">
                                    </div>
                                    <div class="tab-pane text-center" id="shows">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    @endsection
