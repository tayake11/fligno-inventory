@extends('layouts.app')
@section('content')

<div class="container-fluid mt-4">

  <div class="row header-container justify-content-center">


    <section class="col-md-3">

      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Equipment Type</h5>

          <form action="{{ url('/update/'.$equipmenttype->id) }}" method="post">
            @csrf

            <div class="form-group">

              <table>

                <tr>

                  <td>
                    <input readonly="" value="{{$equipmenttype->equipment_name}}" name="equipmentTypeName" type="text" class="form-control" placeholder="Equipment Name" id="inputEquipmentName" >

                  </td>

                  <td>
                    <button data-toggle="modal" data-target="#editEqiupmentNameModalCenter" type="button" id="editName" style="float: right; margin-left: 10px;" class="btn btn-warning btn-sm">Edit</button>

                  </td>
                </tr>
              </table>

            </div>



            <div id="show-hidden-menu">
              <h5 class="card-title">Specification</h5>
              <div class="form-group hidden-menu" style="display: none;">

                <table class="table">

                  <thead class="thead-light">

                  </thead>

                  <tbody>

                    @foreach($equipmenttype->specificationlist as $item)
                      <tr>
                      <td class="itemNameData">{{ $item->name }}</td>
                      <td style="text-align: right;">
                      <!--   <a href="#" class="btn btn-sm btn-info">Show</a> -->

                      <form action="{{ route('specificationlist.delete',['id'=>$item->id]) }}" method="post">

                      @csrf
                      @method('delete')

                      <a class="btn btn-sm btn-warning editItemNameBtn" type="button" data-toggle="modal" data-target="#editItemNameModalCenter"
                      data-name='{{ $item->name }}'
                      data-id='{{ $item->id }}'
                      >Edit</a>

                      @if(count($equipmenttype->specificationlist)>1)
                      <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                      @endif

                      </form>


                      </td>
                      </tr>
                    @endforeach


                  </tbody>

                </table>
                 <button data-toggle="modal" data-target="#newSpecificationNameModalCenter" type="button" id="newSpecification" class="btn btn-success btn-sm" style="float: right; margin-left: 10px;">New</button>


              </div>
            </div>

          </form>

          @include("modals.updatespecification")
          @include("modals.newspecification")
          @include("modals.deleteconfirm")

        </div>
      </div>
    </section>

    <section class="col-md-6">

    @include("equipmentlist.list")

    </section>
  </div>

</div>
@include('modals.updateitem')

@endsection

@section('scripts')


<script type="text/javascript">



  $(document).ready(function(){

    @if (count($errors))

        @if($errors->has('newSpecificationName'))
          $('#newSpecificationNameModalCenter').modal('show');
        @else
          $('#exampleModalCenter').modal('show');
        @endif

    @endif

    let eqtable = $('#equipment-table').DataTable({
      responsive: true,
      "columnDefs":[
        {"orderable": false, "targets": [4]},

        //responsive show only 2 columns
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 4 }
      ],



    });

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

    function createRowTable(){

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

    //view item

    $(document).on('click','.viewItem' , function () {
      $('#inputModalEquipmentID').val($(this).data('equipmentid'));
      $('#inputModalBrand').val($(this).data('brand'));
      $('#inputModalModel').val($(this).data('model'));
      $('#inputModalSerial').val($(this).data('serial'));
      $('#updateItemForm').attr('action','/equipmentupdate/'+ $(this).data('id'));

      let details = $(this).data('specification-details')
      console.log(details);

      //empty the table
      $('#sd-body').empty()
      $.each(details,  function (index, value) {
        console.log(value[0].specification);
        let html = `<tr>
        <td>${index}</td>
        <td>:</td>
        <td class="itemNameData">
        <input type="text" name="specification[${value[0].specification != null
          ? value[0].specification
          : index
        }]" value="${value[0].detail}" class="form-control" style="border: none; width: 100%;">
        </td>
        </tr>`
        //add the html element
        $('#sd-body').append(html)
      })

      let info = eqtable.page.info();

      $('#pageid').val(info.page);

    })

    //Delete Item on modal

    // $('.deletebtn').on('click' , function () {
    //   $('#deleteId').val($(this).data('id'));
    //   $('#eqId').html('ID: '+ $(this).attr('data-equipmentid'));
    //   $('#brand').html('Brand: '+ $(this).attr('data-brand'));
    //   $('#model').html('Model: '+ $(this).attr('data-model'));
     
    // })

    $('#newEntry').click(function(){
      $('#createFormContainer').empty()
      $('#createFormContainer').append(
      `
      @foreach($equipmenttype->specificationlist as $specificationItem)

      <div class="form-group">
      <input name="specification[{{$specificationItem->id}}]" type="text" class="form-control" placeholder="{{$specificationItem->name}}" required="">
      </div>

      @endforeach

      `
      )
    })

    @if(session()->has('pagereturn'))


    $('#equipment-table').DataTable().page("{{session()->get('pagereturn')}}");
    @endif


    @if(session()->has('Success'))

      Swal.fire({
        title: 'Sucessful!',
        text: "Would you like to add a new item?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes, Add new item',
      }).then((result) => {
        if (result.value){
          $('#newEntry').trigger('click');
        }
      })

      $('#equipment-table').DataTable().page('last').draw('page');
      window.scrollTo(0,document.body.scrollHeight);

    @endif


    $(document).on('click', '.btnDelete', function(e){
      e.preventDefault();
      //select form
      let form = $(this).closest('form');
      Swal.fire({
        title: 'Confim!',
        text: "Do you want to remove this item?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes, Delete',
      }).then((result) => {
      if (result.value){
        form.submit();
      }
      })
    })

    $(document).ready(function() {
      $('#show-hidden-menu').click(function() {
        $('.hidden-menu').slideToggle("slow");
        // Alternative animation for example
        // slideToggle("fast");
      });
    });
  });

  function deleteItem(bisanunsa) {
    $('#deleteId').val($(bisanunsa).data('id'));
    $('#eqId').html('ID: '+ $(bisanunsa).attr('data-equipmentid'));
    $('#brand').html('Brand: '+ $(bisanunsa).attr('data-brand'));
    $('#model').html('Model: '+ $(bisanunsa).attr('data-model'));
  }
</script>
@endsection
