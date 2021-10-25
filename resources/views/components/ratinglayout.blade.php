<!-- Rating with comment -->
@if($rating->pivot->rate_comment!=null)
<div class="px-4 pt-3">
    <div class="card mb-4">
        <div class="card-header text-muted" id="rate-{{$rating->id}}">
            <!-- <img class="rounded-circle border border-logo" style="max-height: 30px; max-width: 30px;" src="{{url('/upload_image/gamecardlogo.png')}}" alt="Logo"> -->
            Posted by:
            {{$rating->username}}

            &nbsp;&nbsp;
            <span class="pull-right">
                {{$rating->pivot->created_at->diffForHumans()}}
            </span>
        </div>
        <div class="card-body text-muted">
            <div class="row">
                <div class="pl-2 pt-2 pb-2">
                    @for ($value = 0; $value < $rating->pivot->value; $value++)
                        <ion-icon id="star" name="star" size="small"></ion-icon>
                        @endfor
                </div>
            </div>
            <div class="row border-top">
                <div class="px-2" style="height: auto;">
                    {{$rating->pivot->rate_comment}}
                </div>
            </div>
        </div>
    </div>
</div>

@else
<!-- Rating w/out comment -->
<div class="px-4 pt-3">
    <div class="card mb-4">
        <div class="card-header text-muted" id="rate-{{$rating->id}}">
            <!-- <img class="rounded-circle border border-logo" style="max-height: 30px; max-width: 30px;" src="{{url('/upload_image/gamecardlogo.png')}}" alt="Logo"> -->
            Posted by: {{$rating->username}}
            &nbsp;&nbsp;
            <span class="pull-right">
                {{$rating->pivot->created_at->diffForHumans()}}
            </span>
        </div>
        <div class="card-body text-muted">
            <div class="row">
                <div class="pl-2 pt-2 pb-2">
                    @for ($value = 0; $value < $rating->pivot->value; $value++)
                        <ion-icon id="star" name="star" size="small"></ion-icon>
                        @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endif