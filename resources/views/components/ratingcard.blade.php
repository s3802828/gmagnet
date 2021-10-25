<div class="container-fluid">
    @error('userrating', 'rating')
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <div>Your rating is required</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('#gamepage-tabs a[href="#rating"]').tab('show');
    </script>
    @enderror
    @error('comment', 'rating')
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <div>Your comment should not be more than 5000 characters</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('#gamepage-tabs a[href="#rating"]').tab('show');
    </script>
    @enderror
    @if(session('rateSuccess'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <div>Your rating was added successfully</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('#gamepage-tabs a[href="#rating"]').tab('show');
    </script>
    @endif
    @if(session('rateAlready'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <div>You had already rated the game</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('#gamepage-tabs a[href="#rating"]').tab('show');
    </script>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-1 col-md-1 col-1"></div>

            <div class="col-sm-10 col-md-10 col-10">
                <div class=" pt-3">
                    <div class="card mb-4">

                        <div class="card-body text-muted">
                            <div class="row ml-2">
                                <h5>Rate this game</h5>
                            </div>

                            <div class="row row-cols-5 ml-2 justify-content-around">
                                <div class="col star" style="text-align: center;">
                                    <ion-icon id="star1" name="star" size="large" onclick="setRating(this.id);"></ion-icon>
                                </div>
                                <div class="col star" style="text-align: center;">
                                    <ion-icon id="star2" name="star" size="large" onclick="setRating(this.id);"></ion-icon>
                                </div>
                                <div class="col star" style="text-align: center">
                                    <ion-icon id="star3" name="star" size="large" onclick="setRating(this.id);"></ion-icon>
                                </div>
                                <div class="col star" style="text-align: center">
                                    <ion-icon id="star4" name="star" size="large" onclick="setRating(this.id);"></ion-icon>
                                </div>
                                <div class="col star" style="text-align: center">
                                    <ion-icon id="star5" name="star" size="large" onclick="setRating(this.id);"></ion-icon>
                                </div>
                            </div>

                            <br>

                            <form action="{{route('uploadrating')}}" method="POST">
                                @csrf
                                <input type="hidden" name="gameid" id="gameid" value="{{$id}}">
                                <input type="hidden" name="userrating" id="userrating" value="">
                                <div class="form-row ml-2">
                                    <div class="col-ml-2">
                                        <label for="rating-comment">
                                            <h5>Comment</h5>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="comment" id="comment" placeholder="Write your comment">
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-outline-info btn-md float-right pull-right">Rate</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-sm-1 col-md-1 col-1"></div>
        </div>
    </div>
    <div class="container">
        <div class="px-4 pt-3">
            <div class="card mb-4">
                <div class="card-body text-muted">
                    <div class="row ml-2">
                        <h5>Ratings</h5>
                    </div>
                    <div class="row mx-2 justify-content-around">
                        <div class="col-lg-4 col-md-12 col-12 py-1 m-2 border rating-circle">
                            <div class="circle">
                                <div class="bar"></div>
                                <div class="box" data-value="{{(DB::table('rate')->where('game_id', $id)->avg('value'))/5}}" data-size="200" data-thickness="12">
                                    <span>{{(double)number_format(DB::table('rate')->where('game_id', $id)->avg('value'), 1, ".", "")}}/5</span>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-7 col-md-12 col-12 py-2 my-2 border">
                            @if($rate->count())

                            @php

                            $starvalue = $rate->rated_by;
                            $Arraystar = [];

                            foreach($starvalue as $value) {
                            array_push($Arraystar, $value->pivot->value);
                            }

                            $collectstar = collect($Arraystar)->countBy()->all();

                            @endphp


                            <div class="col" style="text-align: center; display: inline;">
                                <div class="row" style="align-items: center">
                                    <div class="col-2">
                                        5<ion-icon name="star-outline" size="medium">
                                        </ion-icon>
                                    </div>
                                    <div class="col-10">
                                        @if (!array_key_exists('5', $collectstar))
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: 0% ; height:5px"></div>
                                        </div>
                                        @else
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: {{(($collectstar['5'])/($rate->count()))*100}}% ; height:5px"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col" style="text-align: center; display: inline;">
                                <div class="row" style="align-items: center">
                                    <div class="col-2">
                                        4<ion-icon name="star-outline" size="medium">
                                        </ion-icon>
                                    </div>
                                    <div class="col-10">
                                        @if (!array_key_exists('4', $collectstar))
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: 0% ; height:5px"></div>
                                        </div>
                                        @else
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: {{(($collectstar['4'])/($rate->count()))*100}}% ; height:5px"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col" style="text-align: center; display: inline;">
                                <div class="row" style="align-items: center">
                                    <div class="col-2">
                                        3<ion-icon name="star-outline" size="medium">
                                        </ion-icon>
                                    </div>
                                    <div class="col-10">
                                        @if (!array_key_exists('3', $collectstar))
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: 0% ; height:5px"></div>
                                        </div>
                                        @else
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: {{(($collectstar['3'])/($rate->count()))*100}}% ; height:5px"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col" style="text-align: center; display: inline;">
                                <div class="row" style="align-items: center">
                                    <div class="col-2">
                                        2<ion-icon name="star-outline" size="medium">
                                        </ion-icon>
                                    </div>
                                    <div class="col-10">
                                        @if (!array_key_exists('2', $collectstar))
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: 0% ; height:5px"></div>
                                        </div>
                                        @else
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: {{(($collectstar['2'])/($rate->count()))*100}}% ; height:5px"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col" style="text-align: center; display: inline;">
                                <div class="row" style="align-items: center">
                                    <div class="col-2">
                                        1<ion-icon name="star-outline" size="medium">
                                        </ion-icon>
                                    </div>
                                    <div class="col-10">
                                        @if (!array_key_exists('1', $collectstar))
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: 0% ; height:5px"></div>
                                        </div>
                                        @else
                                        <div class="progress" style="height:5px">
                                            <div class="progress-bar" style="width: {{(($collectstar['1'])/($rate->count()))*100}}% ; height:5px"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body text-muted">
                    <div class="row ml-2">
                        <h5>Reviews</h5>
                    </div>
                    @if($rate->count())
                    @foreach($rate->rated_by as $rating)

                    @include('components.ratinglayout')

                    @endforeach
                    @endif
                </div>

                @endif
            </div>
        </div>



    </div>
    <div class="col-sm-2 col-md-2 col-2"></div>
</div>


<script>
    let options = {
        startAngle: -1.55,
        size: 150,
        value: $(".box").attr("data-value"),
        fill: {
            color: "cornflowerblue"
        }
    }

    $(".rating-circle .bar").circleProgress(options)
</script>
@include('components.askjoingame', ['askforjoingameId' => 'askForJoinGameRating', 'todowhat' => 'rate', 'ofwhat' => 'rating'])