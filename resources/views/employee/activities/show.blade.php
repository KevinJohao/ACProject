@extends('layouts.template')

@section('title', 'Proyecto')

@section('body-class', 'product -page')

@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Trámite: {{ $process->typeProcess->name }} </h6>
                                    </div>
                                    <!--
                              <div class="col-6 text-end">
                                <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                              </div>
                              -->
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <div class="row">
                                    <div class="col-md-12 mb-md-0 mb-4">
                                        <div class="card card-body border-0 card-plain border-radius-lg d-flex align-items-center flex-row flex-wrap bg-gray-100">
                                            <div class="col-md-12 d-flex flex-column mb-3">
                                                <h6 class="mb-0 text-sm">Proyecto: {{ $process->project->name }} </h6>
                                            </div>
                                            <div class="col-md-6 d-flex flex-column">
                                                <span class="mb-2 text-xs">Cliente: <span class="text-dark font-weight-bold ms-sm-2">{{ $process->project->client->user->name }}</span></span>
                                                <span class="text-xs">Encargado: <span class="text-dark ms-sm-2 font-weight-bold">{{ $process->project->employee->user->name }}</span></span>
                                            </div>
                                            <div class="col-md-6 d-flex flex-column">
                                                <span class="mb-2 text-xs">Próxima Revisión: <span class="text-dark font-weight-bold ms-sm-2">{{ $process->next_review }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Actividades</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actividad</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Encargado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Estado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Seguimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($activities->isNotEmpty())
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $activity->typeActivity->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">{{ $activity->employee->user->name }}</td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">{{ $activity->taskStatus->name }}</td>
                                                
                                                
                                                <td class="text-center td-actions text-md">
                                                        <a href="{{ url('/empleado/trackings/activities/' . $activity->id . '/show') }}"
                                                            title="Ver trámite" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-arrow-right fa-lg"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No hay actividades asignadas para el trámite</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
