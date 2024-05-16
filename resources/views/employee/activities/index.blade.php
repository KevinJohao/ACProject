@extends('layouts.template')

@section('title', 'Proyecto')

@section('contenido')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Actividades Pendientes</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Proyecto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Trámite
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        N° Actividades Pendientes 
                                    </th>
                                    <!--
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Estado Trámite</th>
                                    -->
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Gestión</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($processes->isNotEmpty())
                                    @foreach ($processes as $process)
                                        <tr>
                                            <td>
                                                <div class="px-3">
                                                    <h6 class="mb-0 text-xs">{{ $process->project->name}}</h6>
                                                </div>
                                            </td>
                                            <td class="text-left text-xs font-weight-bold text-secondary">
                                                {{ $process->TypeProcess->name }}</td>
                                            <td class="text-center text-xs font-weight-bold text-dark">
                                                <strong>{{ $process->activities_count }}</strong></td>
                                            <!---    
                                            <td class="text-center text-xs">{{ $process->TaskStatus->name }}</td>
                                            -->
                                            <td class="text-center td-actions text-md">
                                                    <a href="{{ url('/empleado/activities/processes/' . $process->id . '/show') }}"
                                                        title="Ver proyecto" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                        <i class="fa fa-arrow-right fa-lg"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No hay actividades con seguimientos</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{  $processes->links('layouts.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
