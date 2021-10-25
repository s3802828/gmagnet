<div class="modal fade" id="{{$askforjoingameId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join Game Required</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You have to join game to {{$todowhat}} this page
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('joinGame')}}" method="post">
          @csrf
          @auth<input type="hidden" name="user_id" value="{{Auth::user()->id}}">@endauth
          <input type="hidden" name="game_id" value="{{ $id }}">


          <button type="submit" class="btn btn-primary">Join</button>


        </form>
        
      </div>
    </div>
  </div>
</div>
