@include('templates.header')
<div class="container-fluid">
    <div class="row">

        @include('templates.side_navbar')

        <div class="col-md-10 col-sm-11 col-12">
            @error('verifyAge')
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <div class="alert alert-danger alert-dismissible fade show ml-auto mr-auto text-center mt-3" role="alert">
                        {!! $message !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @enderror
            <!-- Search form  -->
            <div class="row" style="margin-top: 1%;">
                <div class="col-sm-1"></div>
                <div class="col-sm-11 justify-content-center" style=" margin-left: auto; margin-right: auto">
                @csrf
                <form action="{{route('searchresults')}}" method='get'>
                        <div class="input-group d-flex justify-content-center mt-0 mb-3 form-inline">
                            <input name="le-search" class="form-control my-0 py-1 red-border" style="max-width: 80%;" type="text" placeholder="Search" aria-label="Search">

                            <div class="input-group-append">
                                <div class="dropdown-menu dropdown-menu-right" id="myForm" style="width: 80%; margin-right: 28px;">
                                    <div class="container-fluid">
                                        <div class="row">

                                            <div class="col-12">
                                                <div id="tag-container">

                                                </div>

                                                <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">

                                                    @foreach($tagsList as $tag)
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="tagsearch[]" type="checkbox" onclick="checkbox(this.id)" id="inlineCheckbox{{ $tag -> name}}" value="{{ $tag -> id }}">
                                                        <label class="form-check-label" for="inlineCheckbox{{ $tag -> name}}">{{ $tag -> name }}</label>
                                                    </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                    </svg>
                                </button>
                            </div>






                        </div>
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11 d-flex align-items-stretch" style="margin-left: auto; margin-right: auto; padding-bottom: 10%;">
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1" style="width: 110%">
                        

                        
                        @foreach($results as $gamecollection)
                        @if($gamecollection->count() > 0)
                        @foreach($gamecollection as $game)
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
                        @endforeach
                        @else
                        <h7>No results found</h7>
                        @endif
                        @endforeach
                        
                    </div>

                </div>
            </div>
            <div id="load_more" class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11 d-flex align-items-stretch cards-display" style="margin-left: auto; margin-right: auto; padding-bottom: 2%;">
                    <button type="button" name="load_more_button" id="load_more_button" class="btn bg-light border border-logo" style="width: 100%">v</button>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid" style="position: static; z-index: 100; margin: 0!important; padding: 0!important; bottom: 0!important;">
        <div class="row">
            @include('templates.footer')
        </div>

    </div>
</div>

<script>
    $('#myForm').bind('click', function(e) {
        e.stopPropagation()
    })

    var page = 1;

    $(document).on('click', '#load_more_button', function() {
        page++
        $('#load_more_button').html('Loading...');
        LoadMoreData(page);

    });

    function LoadMoreData(page) {
        $.ajax({
                url: '?page=' + page,
                method: 'get',
                beforeSend: function() {
                    $("#load_more_button").show();
                }
            })
            .done(function(data) {
                if (data.html == "") {
                    $('$load_more_button').html("No records found");
                    return;
                }
                $("#post_data").append(data.html);
                $('#load_more_button').html('v');
            })
            .fail(function(jqXHR, ajaxOptions, throwError) {
                alert('Server not responding...');
                $('#load_more_button').html('v');
            });
    }
</script>