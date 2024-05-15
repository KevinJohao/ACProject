<div class="modal fade" id="modalEditObservation{{$tracking->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-info text-gradient">Observación</h3>
            <p class="mb-0">Registre la observación al seguimiento</p>
          </div>
          <div class="card-body">
            <div class="col-md-12 mb-md-0 mb-4">
              <div class="card card-body border-0 card-plain border-radius-lg d-flex align-items-center flex-row flex-column bg-gray-100">
                  <div class="col-12 d-flex flex-column flex-row mb-3">
                      <h6 class="mb-0 text-sm">Seguimiento: {{$tracking->TypeTracking->name}} </h6>
                  </div>
                  <div class="col-12 d-flex flex-column flex-row">
                      <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">{{$tracking->date}}</span></span>
                      <span class="text-xs">Encargado: <span class="text-dark ms-sm-2 font-weight-bold">{{$tracking->employee->user->name}}</span></span>
                  </div>
              </div>
          </div>
            <form role="form text-left" method="POST" action="{{url('/empleado/trackings/' . $tracking->id . '/edit/observation')}}">
                @method('put')
                {{ csrf_field() }}
              <label>Observaciones</label>
              <div class="input-group mb-3">
                <textarea class="form-control" name="observation" placeholder="Observaciones" aria-label="Observaciones">{{$tracking->observation}}</textarea>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>