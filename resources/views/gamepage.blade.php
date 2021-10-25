@include('templates.header')

<div class="container-fluid">
    <div class="row">
        @include('templates.side_navbar')

        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <div class="card">
                        <img class="card-img" src="https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{$banner}}" alt="banner" style="object-fit: cover; height:190px; width:100%">
                        <div class="card-img-overlay">
                            <!-- Avatar -->
                            <img class="rounded-circle border border-logo" style="object-fit:cover; height: 190px; width: 190px;" src="https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{$logo}}" alt="Logo">
                            <!-- Dropdown section -->
                            @if(Auth::user() && $admin->id == Auth::user()->id)
                            <div class="dropleft pull-right">
                                <button class="btn btn-light hover-button" type="button" style="padding: 2px 5px 0px 5px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <ion-icon name="camera-outline" class="" style="font-size:30px"> </ion-icon>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="changeImageMenu">
                                    <a class="dropdown-item" id="edit-banner" href="" data-toggle="modal" data-target="#editBanner" value="banner">Change banner image</a>
                                    <a class="dropdown-item" id="edit-logo" href="" data-toggle="modal" data-target="#editLogo" value="logo">Change logo image</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer container-fluid">
                            <div class="row">
                                <div class="col-8">
                                    <br>
                                    <h2>{{$gametitle}}</h2>
                                    @foreach($gametags as $tag)
                                    <span class="mr-2">#{{$tag->name}}</span>
                                    @endforeach
                                </div>

                                @auth
                                @if(Auth::user() && $admin->id == Auth::user()->id)
                                <div class="col-4 mb-1">

                                    
                                    @if($gameJoined->contains($id))
                                    
                                        <button type="button" class="btn btn-secondary px-2 pull-right" style="bottom: 0" disabled>Joined</button>
                                    
                                    @else
                                    
                                        <form action="{{route('joinGame')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="game_id" value="{{ $id }}">


                                            <button type="submit" class="btn btn-primary pull-right">Join</button>


                                        </form>
                                    
                                    @endif

                                    <button type="button" class="btn btn-outline-danger px-2 pull-right" data-toggle="modal" data-target="#deletegamepage">
                                        Delete this page
                                    </button>
                                </div>

                                @else

                                @if($gameJoined->contains($id))
                                <div class="col-4 mb-1">
                                    <button type="button" class="btn btn-secondary pull-right" disabled>Joined</button>
                                </div>
                                @else
                                <div class="col-4 mb-1">
                                    <form action="{{route('joinGame')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="game_id" value="{{ $id }}">


                                        <button type="submit" class="btn btn-primary pull-right">Join</button>


                                    </form>
                                </div>
                                @endif

                                @endif
                                @endauth

                                @guest
                                <div class="col-4 mb-1">
                                    <button type="button" class="btn btn-secondary pull-right">
                                        <a href="{{ url('signup') }}" style="color: white">Join</a>
                                    </button>
                                </div>
                                @endguest
                            </div>
                        </div>

                        <!-- Modal to upload image -->
                        @include('components.editimage')
                        @include('components.delete', ['deleteModalId' => 'deletegamepage', 'deletedObject' => 'game page', 'deleteRoute' => route('deletegamepage'), 'deleteItem' => 'gamepage', 'itemId' => $id])
                        <!--, ['routing' => '\'editgamepageimage\'']-->

                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <ul class="nav nav-tabs" id="gamepage-tabs">
        
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#description_tab" aria-controls="description" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#post" aria-controls="post" aria-selected="false">Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rating" aria-controls="rating" aria-selected="false">Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#memberlist" aria-controls="memberlist" aria-selected="false">Member list</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="margin-left:2%">
                        <div class="tab-pane fade show active" id="description_tab" aria-labelledby="description">@include('components.infocard')</div>
                        <div class="tab-pane fade" id="post" aria-labelledby="post">@include('components.postcard')</div>
                        <div class="tab-pane fade" id="rating" aria-labelledby="rating">@include('components.ratingcard')</div>
                        <div class="tab-pane fade" id="memberlist" aria-labelledby="memberlist">@include('components.membercard')</div>
                    </div>
                </div>
            </div>
            <!-- Toggle post tab -->
            @if(count($errors->imagepost)>0)
            <script>
                $('#gamepage-tabs a[href="#post"]').tab('show');
                $('#add-image-post').modal('show');
            </script>
            @elseif(count($errors->textpost)>0)
            <script>
                $('#gamepage-tabs a[href="#post"]').tab('show');
                $('#add-text-post').modal('show');
            </script>
            @endif

            @if(session('addpostSuccess'))
            <script>
                $('#gamepage-tabs a[href="#post"]').tab('show');
            </script>
            @endif
            @if(session('joinGameFirst'))
            <script>
                $('#gamepage-tabs a[href="#rating"]').tab('show');
                $("#askForJoinGameRating").modal('show');
            </script>
            @endif
            @if(session('joinGameFirstComment'))
            <script>
                $('#gamepage-tabs a[href="#post"]').tab('show');
                $("#askForJoinGameComment").modal('show');
            </script>
            @endif
            @if(session('deleteSuccess'))
            <script>
                $('#gamepage-tabs a[href="#post"]').tab('show');
            </script>
            @endif
            @if(session('rateSuccess'))
            <script>
                $('#gamepage-tabs a[href="#rating"]').tab('show');
            </script>
            @endif
            @if(session('editDescriptionSuccess'))
            <script>
                $('#gamepage-tabs a[href="#description_tab"]').tab('show');
            </script>
            @endif
        </div>
        
    </div>
    <div class="container-fluid" style="position: static; margin: 0!important; padding: 0!important; bottom: 0!important;">
        <div class="row">
            @include('templates.footer')
        </div>

    </div>

</div>