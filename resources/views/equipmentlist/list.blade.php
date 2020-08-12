


<div class="card mb-3">
  
    <div class="card-body table-responsive">
    
        
      <h5 class="card-title">List of Equipment</h5>
         
     
      <table class="table table-striped table-sm" id="equipment-table">
        <thead class="thead-light">
          <tr>
            <th scope="col" data-priority="1">ID</th>
            <th scope="col">Brand</th>
            <th scope="col">Model</th>
            <th scope="col">Serial</th>

            <th scope="col" style="text-align: right;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" style="width: 75px;" id="newEntry" data-priority="2">New</button>
            </th>
          
          </tr>
        </thead>
        <tbody>
        @foreach($equipmenttype->equipment as $item)
          <tr>
            <td>{{ $item->equipment_id}}</td>
            <td>{{ $item->brand}}</td>
            <td>{{ $item->model}}</td>
            <td>{{ $item->serial}}</td>
            <td style="text-align: right;">
            <!--   <a href="#" class="btn btn-sm btn-info">Show</a> -->
              

             <form action="{{ route('equipmentlist.delete',['id'=>$item->id]) }}" method="post">
                @csrf
                @method('delete')


              <button data-toggle="modal" data-target="#updateItemModalCenter" type="button" class="btn btn-sm btn-warning viewItem" style="width: 75px; margin-bottom: 2px;"
                      data-id='{{$item->id}}'
                      data-equipmentid='{{$item->equipment_id}}'
                      data-brand='{{$item->brand}}'
                      data-model='{{$item->model}}'
                      data-serial='{{$item->serial}}'

                      data-specification-details="{{$item->sd}}"
                      >View</button>

             
              <button class="btn btn-sm btn-danger btnDelete" type="submit" style="width: 75px">Delete</button>

            </form>

          </tr>
        @endforeach
        </tbody>
        
      </table>
   
    </div>
</div>


@include('modals.newitem')




