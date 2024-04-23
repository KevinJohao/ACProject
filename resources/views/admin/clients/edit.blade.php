@extends('layouts.app')

@section('title', 'Listado de clientes')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de clientes </h2>

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/clients/create') }}" class="btn btn-primary btn-round">Nuevo cliente</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th class="col-md-4">Lugar de trabajo</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="text-center">{{ $client->user->name }}</td>
                                        <td>{{ $client->user->lastname }}</td>
                                        <td>{{ $client->user->phone }}</td>
                                        <td>{{ $client->user->email }}</td>
                                        <td class="text-right">{{ $client->work_place }}</td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="{{ url('/admin/clients/' . $client->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a type="button" rel="tooltip" title="Ver cliento"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-info"></i>
                                                </a>
                                                <a href="{{ url('/admin/clients/' . $client->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar cliento"
                                                    class="btn btn-success btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" rel="tooltip" title="Eliminar"
                                                    class="btn btn-danger
                                        btn-simple btn-xs">
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

    @include('includes.footer')
@endsection
