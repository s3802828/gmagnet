<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="google-signin-client_id" content="47640296392-notjhbtgq0oqvia894v82kvckal1ttjf.apps.googleusercontent.com">
  <title>{{$title}} - GMagnet</title>


  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Other JS File -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="{{secure_asset('js/tools.js') }}"></script>

  <!-- Bootstap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js" integrity="sha512-6kvhZ/39gRVLmoM/6JxbbJVTYzL/gnbDVsHACLx/31IREU4l3sI7yeO0d4gw8xU5Mpmm/17LMaDHOCf+TvuC2Q==" crossorigin="anonymous"></script>

  <!-- Other CSS File-->
  <link rel="stylesheet" href="{{secure_asset('css/style.css') }}">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=190576839455379&autoLogAppEvents=1" nonce="lCdxPSHd"></script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
  <script scr="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
</head>

<style>
  body {
    background-color: #ECF8FE;
  }
</style>
<script>
</script>

<body>
  <b class="screen-overlay"></b>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0B2838; z-index: 50">

    <button data-trigger="#collapseSideNav" style="transition: margin-left .2s ease-in-out; margin-left: 0px" class="d-lg-none btn btn-warning side-button" type="button">
      <i class='fas fa-long-arrow-alt-right' id="open"></i>
    </button>

    <a class="navbar-brand" href="{{url('/')}}" >
    
      <span style="color: red">G</span><span style="color: #80d8ff">Magnet</span>
    
    </a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item mx-1 my-1">
          <a class="nav-link" href="{{url('/signup')}}" style="width: 100%; text-align: center; color: white; background-color: #0CA5F7; border-radius: 10px; margin-right: 10px; opacity: 0.9">Sign Up</a>
        </li>
        <li class="nav-item mx-1 my-1">
          <a class="nav-link" href="{{url('/login')}}" style="width: 100%; text-align: center; color: white; border: 1px solid white; border-radius: 10px;">Login</a>
        </li>
        @endguest

        @auth
        @if(Auth::user()->dob)
        <!-- Button trigger modal -->
        <li class="nav-item mx-1 my-1">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add new game
          </button>
        </li>
        <li class="nav-item dropdown mx-1" style="padding: 0px!important;">
          <a class="nav-link dropdown-toggle" style="color: white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle border border-logo" style="object-fit: cover; height: 33px; width: 33px;" alt="Logo" id="headavatar">
            @if(!Auth::user() || !Auth::user()->avatar)
            <script>
              $("#headavatar").attr('src', '/upload_image/avatar');
            </script>
            @elseif(str_starts_with(Auth::user()->avatar, 'avatar/'))
            <script>
              $("#headavatar").attr('src', 'https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{Auth::user()->avatar}}');
            </script>
            @else
            <script>
              $("#headavatar").attr('src', '{{Auth::user()->avatar}}');
            </script>
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{url('/profilepage')}}">Profile</a>
            <form method="post" action="{{route('logout')}}">
              @csrf
              <input type="hidden" name="logout">
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </div>
        </li>
        @endif
        @endauth
      </ul>
    </div>


  </nav>
  @include('components.addgame')