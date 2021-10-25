@include('templates.header')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-2"></div>
        <div class="col-lg-4 col-8" style="background-color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 15px; margin-top: 150px;">
            <h2 class="text-center">LOG IN</h2>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                    <form class="form" action="{{ route('login') }}" method="post" name="loginForm">
                        @csrf
                        <div class="form-group @error('username') error-border @enderror">
                            <!-- <label for="">Username:</label> -->
                            <i class="fa fa-user icon_login" aria-hidden="true"></i>
                            <input type="text" name="username" placeholder="Username" value="{{old('username')}}">
                            @error('username')
                            <div class="error-mess">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group @error('password') error-border @enderror">
                            <!-- <label for="">Password:</label> -->
                            <i class="fa fa-unlock-alt icon_login" aria-hidden="true"></i>
                            <input type="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="error-mess">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if(session('status'))
                            <div class="error-mess">
                                {{session('status')}}
                            </div>
                        @endif
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" name="login" style="width: 100%" class="btn btn-primary">Login</button>
                        </div>

                        <!-- <a href="{{route('loginFB')}}">
                            <div class="fb-login-button form-group d-flex justify-content-center" style="width: 100%" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
                        </a>
                        
                        <a href="{{route('loginGG')}}">
                            <div id="my-signin2">
                            <div class="g-signin2"  data-width="" data-height="" data-longtitle="true"></div>
                            </div>
                        </a> -->

                        
                        <div class="mb-3" style="text-align: center">
                        ----------- or ----------
                        </div>
                        

                        <a class="btn btn-primary my-1" href="{{ url('auth/google') }}" style="margin-top: 0px !important;background: #ea4335;color: #ffffff;padding: 5px;border-radius:7px;  width: 100%" class="ml-2 btn-google">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google mx-1" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                            </svg>Login with Google
                        </a>
                        
                        <a class="btn btn-primary my-1" href="{{ url('auth/facebook') }}" style="margin-top: 0px !important;background: cornflowerblue;color: #ffffff;padding: 5px;border-radius:7px; width: 100%" id="btn-fblogin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook mx-1" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg> Login with Facebook
                        </a>

                        <h6 class="text-center">
                            <a href="{{url('/signup')}}">Create a new account</a>
                        </h6>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-2"></div>
    </div>
</div>