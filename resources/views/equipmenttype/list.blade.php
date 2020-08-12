
  <div class="card mb-3">
  
    <div class="card-body">
      <h5 class="card-title">Equipment Category List</h5>
     
             
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($equipmenttypes as $equipmenttype)
          <tr>
            <td>{{ $equipmenttype->equipment_name }}</td>
            <td style="text-align: right;">
            <!--   <a href="#" class="btn btn-sm btn-info">Show</a> -->
              

             <form action="{{ route('equipmenttype.delete',['id'=>$equipmenttype->id]) }}" method="post">
                @csrf
                @method('delete')

              <a href="{{ url('/show/'.$equipmenttype->id) }}" class="btn btn-sm btn-warning">View</a>
              <button class="btn btn-sm btn-danger" type="submit">Delete</button>
            </form>
            
              
            </td>
          </tr>
        @endforeach
        </tbody>
        
      </table>
   
    </div>
</div>
  

