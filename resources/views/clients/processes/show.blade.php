@extends('layouts.template')

@section('title', 'Proyecto')


@section('contenido')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Trámites del proyecto "{{ $project->name }}"</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tipo de támite</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        VSM</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Próxima revisión
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Valor del trámite
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($processes->isNotEmpty())
                                    @foreach ($processes as $process)
                                        <tr>
                                            <td>
                                                <div class="px-3">
                                                    <h6 class="mb-0 text-xs">{{ $process->typeProcess->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="text-center text-xs font-weight-bold text-secondary">{{ $process->vsm }}</td>
                                            <td class="text-center text-xs font-weight-bold text-secondary">{{ $process->next_review }}</td>
                                            <td class="text-center text-xs  font-weight-bold">&dollar; {{ $process->process_value }}</td>
                                            <td class="text-center text-xs"><strong>{{ $process->taskStatus->name }}</strong></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No hay trámites </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $processes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
