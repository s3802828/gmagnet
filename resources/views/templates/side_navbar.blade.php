<nav class="nav-sidebar" id="collapseSideNav" style="display: inline-block; max-width: 115px; background-color: #0B2838">

    @guest
    <div class="pt-1 pb-1" style="text-align: center; align-items: center">
        <a class="nav-link" href="{{url('/signup')}}" style="width: 100%; text-align: center; color: white; background-color: #0CA5F7; border-radius: 10px; margin-right: 10px; opacity: 0.9">Sign Up</a>
        <h7 style="color: white">or</h7>
        <a class="nav-link" href="{{url('/login')}}" style="width: 100%; text-align: center; color: white; border: 1px solid white; border-radius: 10px;">Login</a>
        <h7 style="color: white">to join the </h7>
        <h7 style="color: white; padding-left: 3%!important;">community</h7>
    </div>
    @endguest
    <ul class="navbar-nav">


        @auth
        @foreach($gameCards as $game)
        @if($gameJoined->contains($game->id))
        <li class="nav-item pt-2 pb-2">
            <a class="sidebar-icon " href='{{ url("/gamepage/".$game -> id."") }}'>
                <img class="rounded-circle border border-logo" style="object-fit:cover;  height: 67px; width: 67px" src='https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{
$game -> logo}}' alt="Logo">
            </a>
        </li>
        @endif
        @endforeach
        @endauth
    </ul>

</nav>