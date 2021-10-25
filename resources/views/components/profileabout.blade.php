@include('components.editcmt_des_bio',
['modalId' => 'profileModal',
'action' => route('updateProfile'),
'edittext' => '<label for="editusername">New Username</label>
<input type="text" class="form-control pl-2" name="editusername" id="editusername" placeholder="New Username" value="'.Auth::user()->username.'">
<div id="editusernameerror" class="error-mess"></div>',
'edittextarea'=> '<label for="editaboutme">Description</label>
<textarea type="text" class="form-control" name="editprofiledescription" id="editprofiledescription" rows="5" value=""></textarea>
<div id="editprofiledescriptionerror" class="error-mess"></div>',
'modaltitle' => 'Edit Profile'])
@if(Auth::user()->description)
<script>
    $("#editprofiledescription").attr("value", '{{Auth::user()->description}}');
    $("#editprofiledescription").html('{{Auth::user()->description}}');
</script>
@endif
@error('editusername', 'profile')
<script>
    $("#profileModal").modal('show');
    $("#editusernameerror").html('{{$message}}');
</script>
@enderror
@error('editprofiledescription', 'profile')
<script>
    $("#profileModal").modal('show');
    $("#editprofiledescriptionerror").html('{{$message}}');
</script>
@enderror
<div class="container-fluid">
    <div class="container">
        <div>
            <h3>Bio info:</h3>
            <p class="ml-4">Name: {{Auth::user()->name}}</p>
            <p class="ml-4"> Date of Birth: {{Auth::user()->dob}}</p>
        </div>
        <div>
            <h3>Description:</h3>
            <p class="ml-4">{{Auth::user()->description}}</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 ml-auto mr-auto" style="font-size: 120%">Edit Profile</div>
            <div class=" col-sm-9 ml-auto mr-auto">
                <i class='far fa-edit hover-icon w3-xlarge' data-toggle="modal" data-target="#profileModal"></i>
            </div>
        </div>
    </div>
</div>