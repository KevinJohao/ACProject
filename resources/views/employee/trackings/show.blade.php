@extends('layouts.template')

@section('title', 'Proyecto')

@section('contenido')

<div class="container-fluid py-4">

        <!-- Notificación de cambio de estado exitoso -->
        @if (session('success'))
            <div id="success-alert" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <script>
            window.onload = function() {
            var alert = document.getElementById('success-alert');
            alert.style.opacity = '1';
            }

            window.setTimeout(function() {
                var alert = document.getElementById('success-alert');
                alert.style.opacity = '0';
            }, 4000);
        </script>
        
        <!-- End Notificación-->

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Actividad: {{ $activity->typeActivity->name }} </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <div class="row">
                                    <div class="col-md-12 mb-md-0 mb-4">
                                        <div
                                            class="card card-body border-0 card-plain border-radius-lg d-flex align-items-center flex-row flex-wrap bg-gray-100">
                                            <div class="col-md-12 d-flex flex-column mb-3">
                                                <h6 class="mb-0 text-sm">Proyecto: {{ $activity->process->project->name }}
                                                </h6>
                                            </div>
                                            <div class="col-md-6 d-flex flex-column">
                                                <span class="mb-2 text-xs">Cliente: <span
                                                        class="text-dark font-weight-bold ms-sm-2">{{ $activity->process->project->client->user->name }}</span></span>
                                                <span class="text-xs">Encargado: <span
                                                        class="text-dark ms-sm-2 font-weight-bold">{{ $activity->process->project->employee->user->name }}</span></span>
                                            </div>
                                            <div class="col-md-6 d-flex flex-column">
                                                <span class="mb-2 text-xs">Trámite: <span
                                                        class="text-dark ms-sm-2 font-weight-bold">{{ $activity->process->typeProcess->name }}</span></span>
                                                <span class="text-xs">Próxima Revisión: <span
                                                        class="text-dark font-weight-bold ms-sm-2">{{ $activity->process->next_review }}</span></span>
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
                        <h6>Seguimientos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Seguimiento</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Fecha</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Encargado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Estado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Observaciones</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($trackings->isNotEmpty())
                                        @foreach ($trackings as $tracking)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $tracking->TypeTracking->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">
                                                    {{ $tracking->date }}</td>
                                                <td class="text-center text-xs  text-secondary">
                                                    {{ $tracking->employee->user->name }}</td>
                                                <td class="text-center text-xs  text-secondary">
                                                    <div class="dropdown">
                                                        <a class="btn btn-link px-3 mb-0 dropdown-toggle {{ $tracking->taskStatus->name == 'Finalizado' ? 'text-success' : 'text-dark' }}" id="dropdownStatusOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ $tracking->taskStatus->name }}
                                                        </a>
                                                        
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownStatusOptions">
                                                            <li>
                                                                <form method="POST" action="{{url('/empleado/trackings/' . $tracking->id . '/edit/status')}}">
                                                                    @method('put')
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="En proceso">
                                                                    <button class="dropdown-item" type="submit">En proceso</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form method="POST" action="{{url('/empleado/trackings/' . $tracking->id . '/edit/status')}}">
                                                                    @method('put')
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="Finalizado">
                                                                    <button class="dropdown-item" type="submit">Finalizado</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                        
                                                    </div>
                                                </td>
                                                <td class="text-left text-xs font-weight-bold">{{ $tracking->observation }}
                                                </td>
                                                <td class="text-center td-actions">
                                                    <a class="btn btn-link text-info px-3 mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditObservation{{ $tracking->id }}">
                                                        <i class="fas fa-pencil-alt text-info me-2" aria-hidden="true"></i>
                                                        Observación
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('employee/trackings/modalAddObservation')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No hay seguimientos asignados para la
                                                actividad</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $trackings->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

