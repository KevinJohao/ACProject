@extends('layouts.app')

@section('title', 'Proyecto')

@section('body-class', 'product -page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Información del proyecto "{{ $project->name }}"</h2>

                <div class="team">
                    <div class="row">
                        <a href="{{ url('/admin/processes/create') }}" class="btn btn-primary btn-round">Nuevo trámite</a>
                        
                        
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
