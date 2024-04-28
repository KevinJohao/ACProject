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

                    <h4 class="title text-left">SEGUIMIENTOS DE LA ACTIVIDAD</h4>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 text-left">
                                    <h6 class="card-title">Proyecto: {{$activity->process->project->name}}</h6>
                                    <p class="card-text mb-2">Cliente: {{$activity->process->project->client->user->name}}</p>
                                    <p class="card-text">Encargado: {{$activity->process->project->employee->user->name}}</p>
                                </div>
                                <div class="col-lg-6 text-left">
                                    <h6 class="card-title">Trámite: {{$activity->process->typeProcess->name}}</h6>
                                    <p class="card-text">Próxima revisión: {{$activity->process->next_review}}</p>
                                    <h6 class="card-title">Actividad: {{$activity->typeActivity->name}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                <div class="team">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Seguimiento</th>
                                    <th class="text-left">Encargado</th>
                                    <th class="col-xs-2 text-center">Estado</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trackings as $tracking)
                                    <tr>
                                        <td class="text-center">{{ $tracking->id }}</td>
                                        <td class="text-left">{{ $tracking }}</td>
                                        <td class="text-left">{{ $tracking->employee->user->name }}</td>
                                        <td class="text-center">{{ $tracking->taskStatus->name }}</td>
                                        <td class="td-actions text-center">
                                            <form method="post" action="{{ url('/employee/processes/' . $activity->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/empleado/activities/' . $activity->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver trámite"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trackings->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
