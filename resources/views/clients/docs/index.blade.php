@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
                <!-- Notificación de cambio de estado exitoso -->
            @if (session('success'))
                <div id="success-alert" class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- End Notificación-->
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Documentos Adjuntos</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalCreateDoc">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo documento
                            </a>
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
                                                Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($general_docs as $document)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $document->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-left text-xs font-weight-bold text-secondary">
                                                    {{ $document->description }}
                                                </td>
                                                <td class="text-center td-actions text-xs">
                                                    
                                                    <form method="post"
                                                        action="{{ url('/admin/docs/' . $document->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        
                                                        <a href="{{ url('/cliente/files/' . $document->fileId . '/delete') }}"
                                                            title="Eliminar"
                                                            class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </a>
                                                        <a href="{{ url('/cliente/files/' . $document->fileId . '/download') }}"
                                                            title="Descargar"
                                                            class="btn btn-link pe-3 ps-0 mb-0 ms-auto">
                                                            <i class="fa fa-download fa-lg"></i>
                                                        </a>
                                                    
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $general_docs->links('layouts.custom-pagination') }}
                                </div>
                                @include('clients/docs/modalCreateDoc')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Manejo de la notificación -->
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
<!-- End notification -->