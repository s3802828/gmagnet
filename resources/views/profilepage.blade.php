@include('templates.header')
@include('components.editavatar')

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
                                    <img id="authAvatar" alt="Profile pic" style="display: inline-block; object-fit: cover; height:210px; width:210px">
                                    @if(!Auth::user()->avatar)
                                    <script>
                                        $("#authAvatar").attr('src', '/upload_image/avatar');
                                    </script>
                                    @elseif(str_starts_with(Auth::user()->avatar, 'avatar/'))
                                    <script>
                                        $("#authAvatar").attr('src', 'https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{Auth::user()->avatar}}');
                                    </script>
                                    @else
                                    <script>
                                        $("#authAvatar").attr('src', '{{Auth::user()->avatar}}');
                                    </script>
                                    @endif
                                    <div class="img-button">
                                        <button id="userId-avatar" class="btn btn-light hover-button" value="avatar" data-toggle="modal" data-target="#editAvatar">
                                            <ion-icon name="camera-outline" class="" style="font-size:30px"></ion-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h2 style="display: inline-block; padding-left: 3%"> {{Auth::user()->name}} <br> (Username: {{Auth::user()->username}})</h2>
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
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile_setting">Setting</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="about_me" class="tab-pane fade show active">
                            @include('components.profileabout')
                        </div>

                        <div id="joined_game" class="tab-pane fade">
                            @include('components.profilejoined')
                        </div>

                        <div id="admin_game" class="tab-pane fade">
                            @include('components.profileadmin')
                        </div>

                        <div id="profile_setting" class="tab-pane fade">
                            @include('components.profilesetting')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="position: static; margin: 0!important; padding: 0!important; bottom: 0!important;">
            <div class="row">
                @include('templates.footer')
            </div>

        </div>
    </div>
</body>


</html>