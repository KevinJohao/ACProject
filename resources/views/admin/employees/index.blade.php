@extends('layouts.app')

@section('title', 'Listado de empleados')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de empleados </h2>

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/employees/create') }}" class="btn btn-primary btn-round">Nuevo empleado</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-xs-1 text-center">Nombres</th>
                                    <th class="col-xs-1 text-center">Apellidos</th>
                                    <th class="col-xs-1 text-center">Teléfono</th>
                                    <th class="col-xs-1 text-center">Correo</th>
                                    <th class="col-xs-1 text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td class="text-left">{{ $employee->user->name }}</td>
                                        <td class="text-left">{{ $employee->user->lastname }}</td>
                                        <td class="text-center">{{ $employee->user->phone }}</td>
                                        <td class="text-center">{{ $employee->user->email }}</td>
                                        <td class="td-actions text-center">
                                            <form method="post" action="{{ url('/admin/employees/' . $employee->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a type="button" rel="tooltip" title="Ver empleado"
                                                    class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('/admin/employees/' . $employee->id . '/edit') }}"
                                                    type="button" rel="tooltip" title="Editar empleado"
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
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
