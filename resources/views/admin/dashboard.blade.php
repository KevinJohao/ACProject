@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Proyectos</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3" href="{{ url('/admin/projects/create') }}"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo Proyecto</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Nombre
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Cliente
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Encargado
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Lugar
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Fecha inicio</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Fecha entrega</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Precio</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Estado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>
                                                <div class="px-3">
                                                    <h6 class="mb-0 text-xs">{{ $project->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="text-center text-xs">{{ $project->client->user->name }}</td>
                                            <td class="text-center text-xs">{{ $project->employee->user->name }}</td>
                                            <td class="text-center text-xs">{{ $project->place }}</td>
                                            <td class="text-center text-xs font-weight-bold text-secondary">
                                                {{ $project->start_date }}</td>
                                            <td class="text-center text-xs font-weight-bold text-secondary">
                                                {{ $project->due_date }}</td>
                                            <td class="text-center text-xs">&dollar; {{ $project->total_value }}</td>
                                            <td class="text-center text-xs">{{ $project->TaskStatus->name }}</td>
                                            <td class="text-center td-actions text-md">
                                                <form method="post" action="{{ url('/admin/projects/' . $project->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a href="{{ url('/admin/processes/' . $project->id . '/show') }}"
                                                        type="button" rel="tooltip" title="Ver proyecto"
                                                        class="btn btn-info btn-simple btn-xs" style="padding: 10px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ url('/admin/projects/' . $project->id . '/edit') }}"
                                                        type="button" rel="tooltip" title="Editar proyecto"
                                                        class="btn btn-success btn-simple btn-xs" style="padding: 10px;">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="submit" rel="tooltip" title="Eliminar"
                                                        class="btn btn-danger btn-simple btn-xs" style="padding: 10px;">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
