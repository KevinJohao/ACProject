@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Información del trámite "{{ $type_process->name }}"</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3"
                                    href="{{ url('/admin/docs/' . $type_process->id . '/create') }}"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo documento</a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Nombre del documento
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Descripción del documento
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($type_documents as $type_document)
                                            <tr>
                                                <td class="col-4">
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $type_document->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="col-6 text-left text-xs"
                                                    style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    {{ $type_document->description }}
                                                </td>
                                                <td class="text-center td-actions text-md">
                                                    <form method="post"
                                                        action="{{ url('/admin/docs/' . $type_document->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a href="{{ url('/admin/docs/' . $type_document->id . '/edit') }}"
                                                            type="button" rel="tooltip" title="Editar documento"
                                                            class="btn btn-success btn-simple btn-xs"
                                                            style="padding: 10px;">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="submit" rel="tooltip" title="Eliminar"
                                                            class="btn btn-danger btn-simple btn-xs" style="padding: 10px;">
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
    </div>
@endsection
