@extends('layouts.app')

@section('title', 'Proyecto')

@section('body-class', 'product - page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                @foreach ($processes as $process)
                    <h2 class="title">Información del trámite "{{ $process->typeProcess->name }}"</h2>
                @endforeach
                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/projects/create') }}" class="btn btn-primary btn-round">Nuevo documento</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre del Documento</th>
                                    <th class="col-xs-2 text-center">Descripción</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($processes as $process)
                                    <tr>
                                        <td class="text-left">{{ $process->typeProcess->typeDocs }}</td>
                                        <td class="text-left">{{ $process->typeProcess->vsm }}</td>
                                        <td>{{ $process->typeProcess->next_review }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ url('/admin/projects/' . $process->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ url('/admin/projects/' . $process->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver proyecto"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-info"></i>
                                                </a>

                                                <a href="{{ url('/admin/projects/' . $process->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar producto"
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
                        {{ $processes->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
