@include('components.editcmt_des_bio',
['modalId' => 'infocardModal',
'action'=> route('editgamepagedescription'),
'edittextarea'=> '<label for="editgamedescription">New Description</label>
<textarea class="form-control" id="editgamedescription" name="editgamedescription" rows="10" value="'.$description.'">'.$description.'</textarea>
<div id="editgamedescriptionerror" class="error-mess"></div>
<input type="hidden" name="id_des" value="'.$id.'">',
'modaltitle' => 'Edit Game Description'])
@error('editgamedescription')
<script>
    $('#gamepage-tabs a[href="#description_tab"]').tab('show');
    $("#infocardModal").modal('show');
    $("#editgamedescriptionerror").html('{{$message}}');
</script>
@enderror
<div class="container-fluid">
    <div class="container">
        <div class="row">
            @if(Auth::user() && $admin->id == Auth::user()->id)
            <div class=" col-sm-1 pt-3">
                <span data-toggle="modal" data-target="#infocardModal">
                    <i class='far fa-edit hover-icon w3-xlarge' data-placement="top" title="Edit Description" data-toggle="tooltip"></i>
                </span>
            </div>
            @endif
            <div class="col-sm-11 px-4 pt-3">
                <p>{!! $description !!}</p>
            </div>
        </div>
    </div>
</div>