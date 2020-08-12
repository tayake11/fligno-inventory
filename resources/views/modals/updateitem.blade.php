<!-- Modal -->
<div class="modal fade" id="updateItemModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLongTitle">{{$equipmenttype->equipment_name}} Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

      </div>

      <div class="modal-body">

        @if (count($errors))

          <div class="d-flex justify-contenft-center">
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

        <form action="" method="post" id="updateItemForm"> 
          @csrf

            <div class="form-group">
              
            <input id="inputModalEquipmentID" value="" name="equipmentId" type="text" class="form-control" placeholder="Equipment ID" required="">
            </div>
             <div class="form-group">
              
            <input id="inputModalBrand" value="" name="brand" type="text" class="form-control" placeholder="Brand" required="">
            </div>

             <div class="form-group">
              
            <input id="inputModalModel" value="" name="model" type="text" class="form-control" placeholder="Model" required="">
            </div>

           <div class="form-group">
              
             <input id="inputModalSerial" value="" name="serial" type="text" class="form-control" placeholder="Serial" required="">
            </div>

            <div style="clear: both;">

            <input type="hidden" name="page" id="pageid">

    <h5 class="card-title">Specification</h5>

    <table class="table">

      <thead class="thead-light">

      </thead>

      <tbody id="sd-body">

    

      </tbody>

    </table>


  </div>                


           <input type="submit" class="btn btn-info" value="Update">

        </form>


      </div>

    </div>
  </div>
</div>