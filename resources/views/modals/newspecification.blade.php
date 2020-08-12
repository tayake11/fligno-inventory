<!-- Modal for Equipment Name-->
<div class="modal fade" id="newSpecificationNameModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Specification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @if (count($errors))
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
           
                
                  <form action="{{route('specificationlist.store',['id'=>$equipmenttype->id])}}" method="post" id="createform">
                    @csrf

                    <div class="form-group">
                        <input id="inputNewSpecificationName" name="newSpecificationName" type="text" class="form-control" placeholder="Specification" required="" value="">
                    </div>
                    
                    <input type="submit" class="btn btn-info" value="Save">

                  </form>

               
      </div>
     
    </div>
  </div>
</div>