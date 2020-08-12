<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLongTitle">New {{$equipmenttype->equipment_name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

      </div>

      <div class="modal-body">

        @if (count($errors))
          @if(!$errors->has('newSpecificationName'))
            <div class="d-flex justify-content-center">
              <div class="form-group">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                  <strong>Error!</strong>
                  &nbsp;

                  <ul style="list-style-type: none">
                    @foreach ($errors->all() as $error)
                      @if ($error !== $errors->first('body'))
                          <li>{{ $error }}</li>
                      @else
                          <li>The review field is required.</li>
                      @endif
                    @endforeach
                  </ul>

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                </div>
              </div>
            </div>
          @endif
        @endif

        <form action="{{ url('/equipmentstore/'.$equipmenttype->id) }}" method="post" id="createform">
          @csrf

          
                <div class="form-group">
                <input name="equipmentId" type="text" class="form-control" placeholder="ID" required="" value="{{$errors->first('equipmentId') ? '' : old('equipmentId')}}">
              </div>

              <div class="form-group">
                <input name="brand" type="text" class="form-control" placeholder="Brand" required="" value="{{old('brand')}}">
              </div>

              <div class="form-group">
                <input name="model" type="text" class="form-control" placeholder="Model" required="" value="{{old('model')}}">
              </div>

              <div class="form-group">
                <input name="serial" type="text" class="form-control" placeholder="Serial" required="" value="{{$errors->first('serial') ? '' : old('serial')}}">
              </div>

              <hr/>
          <h5>Specification Detail</h5>
          <div id="createFormContainer">


          </div>

          <input type="submit" class="btn btn-info" value="Save">


        </form>


      </div>

    </div>
  </div>
</div>