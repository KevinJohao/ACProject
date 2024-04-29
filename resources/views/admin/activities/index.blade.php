@extends('layouts.app')

@section('title', 'Listado de actividades')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de actividades</h2>
                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/activities/create') }}" class="btn btn-primary btn-round">Nueva actividad</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-xs-2 text-center">Nombre de la actividad</th>
                                    <th class="col-xs-8 text-center">Descripción</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($type_activities as $type_activity)
                                    <tr>
                                        <td class="text-left">{{ $type_activity->name }}</td>
                                        <td class="text-left">{{ $type_activity->description }}
                                        <td class="td-actions text-right">
                                            <form method="post"
                                                action="{{ url('/admin/activities/' . $type_activity->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/admin/activities/' . $type_activity->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver actividad"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="{{ url('/admin/activities/' . $type_activity->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar actividad"
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
                            {{ $type_activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
