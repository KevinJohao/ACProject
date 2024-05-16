@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Mis Proyectos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre
                                            del proyecto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                            Trámites</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($projects->isNotEmpty())
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $project->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-left text-xs">{{ $project->place }}</td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">
                                                    {{ $project->start_date }}</td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">
                                                    {{ $project->due_date }}</td>
                                                <td class="text-center text-xs font-weight-bold">&dollar; {{ $project->total_value }}</td>
                                                <td class="text-center text-xs"><strong>{{ $project->TaskStatus->name }}</strong></td>
                                                <td class="text-center td-actions text-md">
                                                        <a href="{{ url('/cliente/projects/' . $project->id . '/show') }}"
                                                            title="Ver trámites" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-arrow-right fa-lg"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No hay proyectos asignados</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $projects->links('layouts.custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
