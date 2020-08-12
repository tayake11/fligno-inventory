@extends('layouts.app')
@section('content')
  <div class="container-fluid mt-4">
          <div class="row header-container justify-content-center">
            <section class="col-md-7">
              @include("equipmenttype.list")
            </section>
           
          </div>
        </div>
@endsection
@section('scripts')
 <script type="text/javascript">
      $(document).ready(function () {

         @if (count($errors))
            $('#exampleModalCenter').modal('show');

         @endif

        $('#equipment-table').DataTable();

        $('#btnshow').click(function(){

          if(!$('textarea').parent().is(':visible')){

            $('textarea').parent().show();
            return false;
          }
          $('textarea').parent().hide();
        })

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

        //fetch data from input to input
        $('#editName').click(function(){

          let containerName = $('#inputEquipmentName').val();
          $('#inputModalEquipmentName').val(containerName);

        })

        //fetch data from table to input
        $('.editItemNameBtn').click(function(){

          let containerName = $(this).data('name');
          $('#inputModalItemName').val(containerName);

          $('#updateitem').attr('action', '/specification/update/'+ $(this).data('id'))

        })

        $('.viewItem').click(function(){

          $('#inputModalEquipmentID').val($(this).data('equipmentid'));
          $('#inputModalBrand').val($(this).data('brand'));
          $('#inputModalModel').val($(this).data('model'));
          $('#inputModalSerial').val($(this).data('serial'));
          $('#updateItemForm').attr('action','/equipmentupdate/'+ $(this).data('id'));

        })
      });
</script>
@endsection