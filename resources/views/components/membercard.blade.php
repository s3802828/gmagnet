<div class="container-fluid">
    <div class="container">
        <div class="pt-3">
            <h4>Admin</h4>
            <div class="col my-2">
                @if(!$admin->avatar)
                    @if(Auth::user() && $admin->location == Auth::user()->location && $admin->location && $admin->id != Auth::user()->id)
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>'/upload_image/avatar', 'member_location' => '<span style="color: #028A0F; margin-top: 20px"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                    @else
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>'/upload_image/avatar'])
                    @endif
                @elseif(str_starts_with($admin->avatar, 'avatar/'))
                    @if(Auth::user() && $admin->location == Auth::user()->location && $admin->location && $admin->id != Auth::user()->id)
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>'https://gmagnet.s3-ap-southeast-1.amazonaws.com/'.$admin->avatar, 'member_location' => '<span style="color: #028A0F; margin-top: 20px"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                    @else
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>'https://gmagnet.s3-ap-southeast-1.amazonaws.com/'.$admin->avatar])
                    @endif
                @else
                    @if(Auth::user() && $admin->location == Auth::user()->location && $admin->location && $admin->id != Auth::user()->id)
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>$admin->avatar, 'member_location' => '<span style="color: #028A0F; margin-top: 20px;"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                    @else
                        @include('components.memberlayout', ['member_id'=>$admin->id,'member_name' => $admin->name, 'member_username' => $admin->username,'member_avatar' =>$admin->avatar])
                    @endif
                @endif
            </div>
        </div>
    </div>
    <hr style="border-top: 2px solid;">
    <div class="container">
        <div class="px-4 pt-3">
            <h4>Members</h4>
            @foreach($memberList as $member) <div class="col my-2">
                @if($member->id != $admin->id)
                    @if(!$member->avatar)
                        @if(Auth::user() && $member->location == Auth::user()->location && $member->location && $member->id != Auth::user()->id)
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>'/upload_image/avatar', 'member_location' => '<span style="color: #028A0F; margin-top: 20px;"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                        @else
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>'/upload_image/avatar'])
                        @endif
                    @elseif(str_starts_with($member->avatar, 'avatar/'))
                        @if(Auth::user() && $member->location == Auth::user()->location && $member->location && $member->id != Auth::user()->id)
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>'https://gmagnet.s3-ap-southeast-1.amazonaws.com/'.$member->avatar, 'member_location' => '<span style="color: #028A0F;margin-top: 20px;"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                        @else
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>'https://gmagnet.s3-ap-southeast-1.amazonaws.com/'.$member->avatar])
                        @endif
                    @else
                        @if(Auth::user() && $member->location == Auth::user()->location && $member->location && $member->id != Auth::user()->id)
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>$member->avatar, 'member_location' => '<span style="color: #028A0F;margin-top: 20px;"><i class="fa fa-check" style="color: #028A0F"></i> Nearby</span>'])
                        @else
                            @include('components.memberlayout', ['member_id'=>$member->id,'member_name' => $member->name, 'member_username' => $member->username,'member_avatar' =>$member->avatar])
                        @endif
                    @endif
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>