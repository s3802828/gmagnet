@include('templates.header')

<body>
    <div class="container-fluid">
        <div class="row">
            @include('templates.side_navbar')
            <div class="col-sm-10 mr-auto ml-auto">
                <div class="container mt-3">
                    <div id="profile_part">
                        <div class="row">
                            <div class="col-md-3" style="max-width:fit-content">
                                <div class="img-container">
                                    <img id="memberAvatar" alt="Profile pic" style="display: inline-block; object-fit: cover; height:210px; width:210px">
                                    @if(!$member->avatar)
                                    <script>
                                        $("#memberAvatar").attr('src', '/upload_image/avatar');
                                    </script>
                                    @elseif(str_starts_with($member->avatar, 'avatar/'))
                                    <script>
                                        $("#memberAvatar").attr('src', 'https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{$member->avatar}}');
                                    </script>
                                    @else
                                    <script>
                                        $("#memberAvatar").attr('src', '{{$member->avatar}}');
                                    </script>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h2 style="display: inline-block; padding-left: 3%"> {{$member->name}} <br> (Username: {{$member->username}})</h2>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#about_me">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#joined_game">Joined Game</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#admin_game">Admin Game</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="about_me" class="tab-pane fade show active">
                            <div class="container-fluid">
                                <div class="container">
                                    <div>
                                        <h3>Bio info:</h3>
                                        <p class="ml-4">Name: {{$member->name}}</p>
                                        <p class="ml-4">Date of Birth: {{$member->dob}}</p>
                                    </div>
                                    <div>
                                        <h3>Description:</h3>
                                        <p class="ml-4">{{$member->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="joined_game" class="tab-pane fade">
                            <!-- Start of gamejoined section -->
                            @include('components.memberjoined')
                        </div>

                        <div id="admin_game" class="tab-pane fade">
                            @include('components.memberadmin')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('templates.footer')

</html>