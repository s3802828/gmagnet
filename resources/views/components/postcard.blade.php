<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-1 col-md-1 col-1"></div>
            <div class="col-sm-10 col-md-10 col-10">

                <div class=" pt-3">
                    <div class="card mb-4">
                        <div class="card-body text-muted">
                            <div class="row ml-2">
                                <h5><strong>What do you want to share about this game?</strong></h5>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <div class="col-1  ml-auto mr-auto">
                                    <img class="rounded-circle border border-logo" style="object-fit: cover; height: 70px; width: 70px;" alt="Logo" id="postavatar">
                                    @if(!Auth::user() || !Auth::user()->avatar)
                                    <script>
                                        $("#postavatar").attr('src', '/upload_image/avatar');
                                    </script>
                                    @elseif(str_starts_with(Auth::user()->avatar, 'avatar/'))
                                    <script>
                                        $("#postavatar").attr('src', 'https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{Auth::user()->avatar}}');
                                    </script>
                                    @else
                                    <script>
                                        $("#postavatar").attr('src', '{{Auth::user()->avatar}}');
                                    </script>
                                    @endif
                                </div>
                                <div class="col-10 mt-2">
                                    <a class="btn btn-outline-info" id="postwithimagemodalbutton" @guest href="{{route('login')}}" @endguest> Post with Image </a>
                                    <a class="btn btn-outline-info" id="postwithoutimagemodalbutton" @guest href="{{route('login')}}" @endguest> Post without Image </a>
                                    @auth
                                    @php
                                        $isMemberPost = 0;
                                    @endphp
                                    @foreach($memberList as $member)
                                    @if(Auth::user()->id == $member->id)
                                        @php
                                            $isMemberPost = 1;
                                        @endphp
                                    @endif
                                    @endforeach
                                    @if($isMemberPost == 1)
                                    <script>
                                        $("#postwithimagemodalbutton").attr('data-toggle', 'modal');
                                        $("#postwithimagemodalbutton").attr('data-target', '#add-image-post');
                                        $("#postwithoutimagemodalbutton").attr('data-toggle', 'modal');
                                        $("#postwithoutimagemodalbutton").attr('data-target', '#add-text-post');
                                    </script>
                                    @else
                                    <script>
                                        $("#postwithimagemodalbutton").attr('data-toggle', 'modal');
                                        $("#postwithimagemodalbutton").attr('data-target', '#askForJoinGamePost');
                                        $("#postwithoutimagemodalbutton").attr('data-toggle', 'modal');
                                        $("#postwithoutimagemodalbutton").attr('data-target', '#askForJoinGamePost');
                                    </script>
                                    @endif
                                    @endauth
                                    @include('components.addpost')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-1 col-md-1 col-1"></div>
        </div>
    </div>
    @include('components.askjoingame', ['askforjoingameId' => 'askForJoinGamePost', 'todowhat' => 'post to', 'ofwhat' => 'post'])
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-2"></div>
            <div class="col-sm-8 col-md-8 col-8">
                @include('components.postlayout')
            </div>
            <div class="col-sm-2 col-md-2 col-2"></div>
        </div>
    </div>

</div>