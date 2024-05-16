@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Editar documento "{{ $document->name }}"</h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="card mt-4">
                                    <div class="card-body p-3">
                                        <form method="post" action="{{ url('/admin/docs/' . $document->id . '/edit') }}">
                                            @method('put')
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombres</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', $document->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Descripción</label>
                                                        <textarea type="text" class="form-control" name="description">
                                                            {{ old('description', $document->description) }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn bg-gradient-primary mt-3">Guardar cambios</button>
                                            <a href="{{ url('/admin/type_processes/' . $document->TypeProcess->id . '/show') }}"
                                                class="btn bg-default mt-3">Cancelar</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
