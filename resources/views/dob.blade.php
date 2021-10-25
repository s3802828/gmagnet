@include('templates.header')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-3"></div>
        <div class="col-lg-4 col-6" style="background-color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 15px; margin-top: 80px;">
            <h2 class="text-center">DATE OF BIRTH REQUIRE</h2>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-12 d-flex justify-content-center">
                    <form class="form" action="{{route('dob')}}" method="post" name="signUpForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group @error('birthdate') error-border @enderror">
                                <label for="">Date of Birth:</label>
                                <input type="date" name="birthdate" id="dob" placeholder="" value="{{old('birthdate')}}">
                                @error('birthdate')
                                <div class="error-mess">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" name="login" style="width: 100%" class="btn btn-primary">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-3"></div>
    </div>
</div>