<div class="modal fade" id="modalCreateDoc" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card card-plain">
          <div class="card-header pb-0 text-left">
            <h3 class="font-weight-bolder text-info text-gradient">Documentación</h3>
          </div>
          <div class="card-body">
            <div class="col-md-12 mb-md-0 mb-4">
              <div class="card card-body border-0 card-plain border-radius-lg d-flex align-items-center flex-row flex-column bg-gray-100">
                  <div class="col-12 d-flex flex-column flex-row mb-3">
                      <h6 class="mb-0 text-sm">Documentos Requeridos: </h6>
                  </div>
                  <div class="col-12 d-flex flex-column flex-row">
                      <li>
                      <span class="mb-2 text-xs">Cédula o Pasaporte</span>
                      </li>
                      <li>
                      <span class="text-xs">Impuesto Predial</span>
                      </li>
                  </div>
              </div>
          </div>
            <form role="form text-left" method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="input-group mb-3 mt-3">
                  <input type="text" class="form-control" placeholder="Eliga un arhivo" name="file_name">
                  @error('file_name')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              <div class="input-group mb-3">
                <input type="file" class="form-control" placeholder="Eliga un arhivo" name="file">
                @error('file')
                <span class="text-danger">{{$message}}</span>
                @enderror
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