
<div class="col my-2">


    <div class="card card-index" style="border-radius: 15px; transition: transform 0.8s">

        <img class="card-img-top" style="border: 8px solid white; border-radius: 15px; max-width: 750px; height: 160px" src="https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{
$game -> banner}}" alt="Cover">

        <div class="card-img-overlay">
            <div class="row align-items-stretch" style="height: 100px; ">
                <div class="col-9 mt-2" style="padding-top: 20px!important;">

                    <a title='{{$game -> name}}' href='{{ url("/gamepage/".$game -> id."") }}'>
                        <img class="rounded-circle border border-logo" style="object-fit:cover; height: 100px; width: 100px" src='https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{
$game -> logo}}' alt="Logo">
                    </a>


                </div>
                <div class="col-3">

                    @guest
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#confirmationModal-{{$game->id}}">Join</button>
                    @endguest

                    @auth
                    @if($gameJoined->contains($game->id))
                    <button type="button" class="btn btn-secondary btn-sm float-right" disabled>Joined</button>
                    @else
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#confirmationModal-{{$game->id}}">Join</button>
                    @endif
                    @endauth

                </div>
            </div>
        </div>
        <div class="card-body" style="height: 50px; padding: 5px!important; padding-left: 20px!important">
            <h5 class="card-title" style="color: black;top: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 100%">{{ $game -> name }}</h5>

        </div>
    </div>

    <div class="modal fade" id="confirmationModal-{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center; align-items: center">

                    <h4>Are you sure you want to join this community?</h4>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <form action="{{route('joinGame')}}" method="post">
                        @csrf
                        @auth<input type="hidden" name="user_id" value="{{Auth::user()->id}}">@endauth
                        <input type="hidden" name="game_id" value="{{ $game->id }}">


                        <button type="submit" class="btn btn-primary">Join</button>


                    </form>

                    <button type="button" class="btn btn-secondary">
                        <a title='{{$game -> name}}' href='{{ url("/gamepage/".$game -> id."") }}' style="color: white">Visit forum</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>


