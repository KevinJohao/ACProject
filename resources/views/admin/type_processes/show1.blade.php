@extends('layouts.app')

@section('title', 'Trámite')

@section('body-class', 'product - page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Información del trámite "{{ $type_process->name }}"</h2>

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/docs/create') }}" class="btn btn-primary btn-round">Nuevo documento</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-xs-3 text-center">Nombre del Documento</th>
                                    <th class="col-xs-3 text-center">Descripción del Documento</th>
                                    <th class="col-xs-3 text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($type_documents as $type_document)
                                    <tr>
                                        <td class="col-xs-3 text-left">{{ $type_document->name }}</td>
                                        <td class="col-xs-3 text-left">{{ $type_document->description }}</td>
                                        <td class="td-actions text-right">
                                            <form class="text-center" method="post"
                                                action="{{ url('/admin/docs/' . $type_document->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="{{ url('/admin/docs/' . $type_document->id . '/show') }}"
                                                    type="button" rel="tooltip" title="Ver documento"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('/admin/docs/' . $type_document->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar documento"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" type="button" rel="tooltip" title="Subir documento"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-upload"></i>
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
                        {{ $type_documents->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
