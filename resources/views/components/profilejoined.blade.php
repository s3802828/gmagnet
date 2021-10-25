<div class="container-fluid">
    <div class="container">
        <h3>Joined Game</h3>
        <div class="container">

            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 mb-1">

                @foreach($gameCards as $game)
                @if($gameJoined->contains($game->id))
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
                                
                            </div>
                        </div>
                        <div class="card-body" style="height: 50px; padding: 5px!important; padding-left: 20px!important">
                            <h5 class="card-title" style="color: black;top: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 100%">{{ $game -> name }}</h5>

                        </div>
                    </div>

                    

                </div>

                @endif
                @endforeach

            </div>

        </div>
    </div>
</div>