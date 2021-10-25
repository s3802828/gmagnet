<!-- Modal -->
<div class="multilayer modal fade" id={{$deleteModalId}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete {{$deletedObject}}</h5>
        <button type="button" class="close" id="closedeleteicon" aria-label="Close" onclick="$('#{{$deleteModalId}}').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this {{$deletedObject}}?
      </div>
      <form action="{{$deleteRoute}}" method="post">
        @csrf
        <input type="hidden" name="deleteItem" value="{{$deleteItem}}">
        <input type="hidden" name="itemId" value="{{$itemId}}">
        {!! $postidcomment ?? ''!!}
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closedeletebutton" onclick="$('#{{$deleteModalId}}').modal('hide');">Close</button>
        <button type="submit" class="btn btn-primary" id="{!! $deletebutton ?? ''!!}">Yes</button>
      </div>
      </form>
    </div>
  </div>
</div>