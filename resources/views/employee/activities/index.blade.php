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

                    <h2 class="title">Información del trámite</h2>

                <div class="team">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Proyecto</th>
                                    <th>Trámite</th>
                                    <th>N° Actividades</th>
                                    <th class="col-xs-2 text-center">Estado</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td class="text-center">{{ $activity->id }}</td>
                                        <td class="text-left">{{ $activity->typeActivity->name }}</td>
                                        <td class="text-left">{{ $activity->typeActivity->name }}</td>
                                        <td class="text-center">{{ $activity->employee->user->name}}</td>
                                        <td class="text-center">{{ $activity->taskStatus->name }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ url('/employee/processes/' . $activity->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/admin/processes/' . $activity->id . '/show') }}"
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
                        {{ $activities->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
