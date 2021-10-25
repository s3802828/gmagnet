<div class="px-4 pt-3">
    <div class="px-2 pb-2" style="width: auto; display: flex;">
        <img class="rounded-circle border border-logo" style="object-fit: cover; height: 70px; width: 70px;" src="{!! $member_avatar ?? ''!!}" alt="Logo">
        @if(Auth::user() && $member_id==Auth::user()->id)
        <a href="{{route('profilePage')}}">
            <h4 class="pl-2" style="margin-top: 20px;">{!! $member_name ?? ''!!} ({!! $member_username ?? ''!!})</h4>
        </a>
        @else
        <a href="{{url('/member/'.$member_id)}}">
            <h4 class="pl-2" style="margin-top: 20px;">{!! $member_name ?? ''!!} ({!! $member_username ?? ''!!})</h4>
        </a>
        @endif
        {!! $member_location ?? ''!!}
    </div>
</div>
<!--{{url('/upload_image/avatar')}}-->