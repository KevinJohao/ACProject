@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Trámites</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3" href="{{ url('/admin/processes/create') }}"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo Trámite</a>
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
                                                Nombre del trámite
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Descripción
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($type_processes as $type_process)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $type_process->user->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center text-xs">{{ $type_process->user->lastname }}</td>
                                                <td class="text-center text-xs">{{ $type_process->user->phone }}</td>
                                                <td class="text-center text-xs">{{ $type_process->user->email }}</td>
                                                <td class="text-center td-actions text-md">
                                                    <form method="post"
                                                        action="{{ url('/admin/employees/' . $type_process->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a href="{{ url('/admin/docs/' . $type_process->id . '/edit') }}"
                                                            type="button" rel="tooltip" title="Ver trámite"
                                                            class="btn btn-success btn-simple btn-xs" style="padding: 10px;">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url('/admin/type_processes/' . $type_process->id . '/edit') }}"
                                                            type="button" rel="tooltip" title="Editar trámite"
                                                            class="btn btn-success btn-simple btn-xs" style="padding: 10px;">
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
                                {{ $type_processes->links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
