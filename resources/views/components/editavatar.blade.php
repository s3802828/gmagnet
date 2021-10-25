<div class="modal fade bd-example-modal-sm" id="editAvatar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImageModalTitle">Edit Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{route('updateAvatar')}}" method="post" id="editImageForm" enctype="multipart/form-data">
                @csrf
                <div style="padding: 15px 20px 15px 10px">
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    <input class="form-control-file" type="file" id="imageFile" name="avatar">
                    @error('avatar')
                    <div class="error-mess">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>