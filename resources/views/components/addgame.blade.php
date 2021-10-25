<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">ADD NEW GAME</h4>
        <!--<button type="reset" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('index')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="gametitle">Game Title <span style="color: red;">*</span></label>
            <input type="text" class="form-control border border-secondary pl-2 " id="gametitle" name="name" placeholder="Game Title" value="{{old('name')}}">
              @error('name')
              <div class="error-mess">
              {{$message}}
              </div>
              @enderror
          </div>
          @auth<input type="hidden" name="admin" id="admin" value="{{Auth::user()->id}}">@endauth
          <div class="range-wrap col-md-6">
            <div class="range-value" id="rangeV"></div>
            <label for="range">Age Limit (The age limit have to be equal or below your age)<span style="color: red;">*</span></label>
            <input id="range" name="ageLimit" type="range" min="0" max="21" step="1" style="padding-top: 6%" value="{{old('ageLimit')}}">
            @if(!(old('ageLimit')))
              <script>
              $("#range").attr('value', '0');
              </script>
            @endif
            @error('ageLimit')
              <div class="error-mess">
              {{$message}}
              </div>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="gametag">Game Tags<span style="color: red;">*</span></label>
          @error('gametag')
          <span class="error-mess" style="display:inline;">
          {{$message}}
          </span>
          @enderror
          <div class="containter" id="gametag">
            <div class="row">
              @for ($i = 0; $i < count($tagList); $i+=4) 
                <div class="col-sm">
                  @for ($j = 0; $j < 4; $j++) 
                    <div class="form-check">
                      <input class="form-check-input col-sm-2" name="gametag[]" type="checkbox" value="{{$tagList[$i+$j]['id']}}" id="{{$tagList[$i+$j]['id']}}">
                      <label class="form-check-label col-sm-10" for="{{$tagList[$i+$j]['id']}}">{{$tagList[$i+$j]['name']}}</label>
                      @if(is_array(old('gametag')) && in_array($tagList[$i+$j]['id'], old('gametag')))
                      <script>
                      $("#{{$tagList[$i+$j]['id']}}").attr('checked', true);
                      </script>
                      @endif
                    </div>
                  @endfor
                </div>
              @endfor
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description<span style="color: red;">*</span></label>
          <textarea class="form-control border border-secondary pl-2 " id="description" rows="3" placeholder="Description" name="description" value="{{old('description')}}">{{old('description')}}</textarea>
          @error('description')
          <div class="error-mess">
          {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="logoPhoto">Choose Logo Photo<span style="color: red;">*</span></label>
            <input type="file" class="form-control-file ml-0 pl-0 border-0 " id="logoPhoto" name="logo">
            <div class="error-mess" id="logoReselect"></div>
            @error('logo')
            <div class="error-mess">
            {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-md-1"></div>
          <div class="form-group col-md-5">
            <label for="bannerPhoto">Choose Banner Photo <span style="color: red;">*</span></label>
            <input type="file" class="form-control-file ml-0 pl-0 border-0 " id="bannerPhoto" name="banner">
            <div class="error-mess" id="bannerReselect"></div>
            @error('banner')
            <div class="error-mess">
            {{$message}}
            </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" id="closeErase">Dismiss</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>
@error('verifyAge')
@else
@if ($errors->has('name') || $errors->has('logo') || $errors->has('banner') || $errors->has('ageLimit') || $errors->has('gametag') || $errors->has('description'))
<script>
  $("#exampleModal").modal('show');
</script>
@error('logo')
@else
<script>
  $("#logoReselect").html('Your previous logo has not been saved. Please reselect it!');
</script>
@enderror
@error('banner')
@else
<script>
  $("#bannerReselect").html('Your previous banner has not been saved. Please reselect it!');
</script>
@enderror
@endif
@enderror

<script>
  $("#closeErase").click(function() {
    location.reload();
  });
  ageSlider();
</script>