<!-- Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to Delete this item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <form action="{{ route('equipmentlist.delete',['id'=>$item->id])}}" method="post">
        @csrf
        @method('delete')

        <div class="modal-body" style="margin-left: 15px;">

          <h5 id="eqId"></h5>
          <h5 id="brand"></h5>
          <h5 id="model"></h5>
          <input type="text" name="deleteId" id="deleteId" hidden="">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete!</button>
        </div>
      </form>
    </div>
  </div>
</div>