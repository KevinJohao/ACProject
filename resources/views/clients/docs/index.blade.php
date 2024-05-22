@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Documentos Adjuntos</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#modalCreateDoc"
                                    href="#"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo documento</a>
                            </div>
                            
                        </div>
                    </div>
                    
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre del documento
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Descripción del documento
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Precio
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                URL
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($process_docs as $document)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $document->typeDocs->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-left text-xs font-weight-bold text-secondary">
                                                    {{ $document->typeDocs->description }}
                                                </td>
                                                <td class="text-center text-xs font-weight-bold text-secondary">
                                                    &dollar;{{ $document->value }}
                                                </td>
                                                <td class="text-center text-xs text-secondary">
                                                    {{ $document->url }}
                                                </td>
                                                <td class="text-center td-actions text-md">
                                                    
                                                    <form method="post"
                                                        action="{{ url('/admin/docs/' . $document->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a href="{{ url('/admin/docs/' . $document->id . '/edit') }}"
                                                            title="Editar documento"
                                                            class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                        <button type="submit" rel="tooltip" title="Eliminar"
                                                            class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('clients/docs/modalCreateDoc')
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $process_docs->links('layouts.custom-pagination') }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
