<!-- Modal -->
<div class="multilayer modal fade" id="{{$modalId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$modaltitle}}</h5>
        <button type="button" class="close" id="closeediticon" aria-label="Close" onclick="$('#{{$modalId}}').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{$action}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">{!! $edittext ?? ''!!}</div>
          <div class="form-group">{!! $edittextarea ?? ''!!}</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closeeditbutton" onclick="$('#{{$modalId}}').modal('hide');">Close</button>
          <button type="submit" class="btn btn-primary" id="{!! $editbutton ?? ''!!}">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>