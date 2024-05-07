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

                    <h2 class="title">Actividades Pendientes</h2>

                    <div class="team">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Proyecto</th>
                                        <th>Trámite</th>
                                        <th class="text-center">N° Actividades Pendientes</th>
                                        <th class="text-center">Estado Trámite</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($processes->isNotEmpty())
                                    @foreach ($processes as $process)
                                        <tr>
                                            <td class="text-left">{{ $process->project->name }}</td>
                                            <td class="text-left">{{ $process->TypeProcess->name }}</td>
                                            <td class="text-center">{{ $process->activities_count }}</td>
                                            <td class="text-center">{{ $process->TaskStatus->name }}</td>
                                            <td class="td-actions text-center">
                                                <!-- Aquí puedes agregar tus opciones -->
                                                <form method="post" action="{{ url('/employee/processes/' . $process->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                    
                                                    <a href="{{ url('/empleado/processes/' . $process->id . '/show') }}"
                                                        type="button" rel="tooltip" title="Ver trámite"
                                                        class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No hay actividades con seguimientos</td>
                                        </tr>
                                    @endif
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
