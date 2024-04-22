@extends('layouts.app')

@section('title', 'A&C Otavalo | Dashboard')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="nav-align-center">
                <div class="section">
                    <h2 class="title text-center">Dashboard</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                        @if (auth()->user()->rol_id == 1)
                            <li>
                                <a href="{{ url('/admin/projects') }}" role="tab">
                                    <i class="material-icons">handyman</i>
                                    Proyectos
                                </a>
                            </li>
                            <li>
                                <a href="#tasks" role="tab">
                                    <i class="material-icons">person</i>
                                    Clientes
                                </a>
                            </li>
                            <li>
                                <a href="#tasks" role="tab">
                                    <i class="material-icons">person</i>
                                    Empleados
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/projects') }}" role="tab">
                                    <i class="material-icons">assignment</i>
                                    Trámites
                                </a>
                            </li>
                            <li>
                                <a href="#tasks" role="tab">
                                    <i class="material-icons">topic</i>
                                    Documentos
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->rol_id == 3)
                            <li>
                                <a href="#dashboard" role="tab">
                                    <i class="material-icons">handyman</i>
                                    Proyectos
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->rol_id == 2)
                            <li>
                                <a href="#dashboard" role="tab">
                                    <i class="material-icons">handyman</i>
                                    Proyectos
                                </a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
