@extends('layouts.app')
@section('content')
<div class="container-fluid mt-4">

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

          <div class="row header-container justify-content-center">


            <section class="col-md-7">

              <div class="card mb-3">
               
                <div class="card-body">

                  <div>
                     <h5 class="card-title" style="float: left;">New Equipment Type</h5>

                     <button class="btn btn-warning" style="float: right; margin-bottom: 10px; width: 200px;" id="addrow">Add New Specification</button>

                  </div>
                 
                  <form action="{{ url('/store') }}" method="post">
                    @csrf

                    <div class="form-group">
                      <input name="equipmentTypeName" type="text" class="form-control" placeholder="Equipment Name" required="">
                    </div>

                    <div id="row" >
                      
                      <div class="form-group my-2 d-flex justify-content-between">
                        <input type="text" class='form-control' style='width: 70%;' name='specification[0]' placeholder='Specification Type' required="">
                      </div>
                    </div>

                    
                    <input type="submit" class="btn btn-info" value="Save">
                    <input type="reset" class="btn btn-warning" value="Reset">


                  </form>

                </div>
              </div>
              
            </section>
          </div>
        </div>
@endsection
@section('scripts')
<script type="text/javascript">
      $(document).ready(function () {

         //#addrow is your button name
        $('#addrow').click(function(){
          createRowTable()
        })

        $(document).on('click', '.remove-specification' , function(){
            $(this).parent().remove();
        })

        function createRowTable() {
          {
          let parentDiv = $('#row'); // container name
          let count =  parentDiv.children().length - 1
          let html = 
              `
                <div class="form-group my-2 d-flex justify-content-between">
                  <input type="text" class='form-control' style='width: 70%;' name='specification[${(count ) + 1}]' placeholder='Specification Type'>
                  <button type='button' class='btn btn-danger remove-specification ml-2' style='width:200px;'> Remove </button>
                </div>
              `
          parentDiv.append(html); 
          }
        }      
  });
</script>
@endsection