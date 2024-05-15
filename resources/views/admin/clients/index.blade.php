@extends('layouts.template')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h4 class="mb-0">Clientes</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn bg-gradient-primary mt-3" href="{{ url('/admin/clients/create') }}"><i
                                        class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo Cliente</a>
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
                                                Nombres
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Apellidos
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Teléfono
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Correo
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Lugar de trabajo</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>
                                                    <div class="px-3">
                                                        <h6 class="mb-0 text-xs">{{ $client->user->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center text-xs">{{ $client->user->lastname }}</td>
                                                <td class="text-center text-xs">{{ $client->user->phone }}</td>
                                                <td class="text-center text-xs">{{ $client->user->email }}</td>
                                                <td class="text-center text-xs">{{ $client->work_place }}</td>
                                                <td class="text-center td-actions text-md">
                                                    <form method="post"
                                                        action="{{ url('/admin/clients/' . $client->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a href="{{ url('/admin/clients/' . $client->id . '/edit') }}"
                                                            type="button" rel="tooltip" title="Editar proyecto"
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
                                {{ $clients->links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
