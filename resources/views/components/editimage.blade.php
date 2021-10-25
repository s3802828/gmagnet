<div class="modal fade bd-example-modal-sm" id="editBanner" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImageModalTitle">Edit Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{route('editgamepageimage')}}" method="post" id="editImageForm" enctype="multipart/form-data">
                @csrf
                <div style="padding: 15px 20px 15px 10px">
                    <input type="hidden" name="formfor" value="banner">
                    <input type="hidden" name="idOf" value="{{$id}}" id="idOf">
                    <input class="form-control-file" type="file" id="imageFile" name="banneredit">
                    @error('banneredit')
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

<div class="modal fade bd-example-modal-sm" id="editLogo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImageModalTitle">Edit Logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{route('editgamepageimage')}}" method="post" id="editImageForm" enctype="multipart/form-data">
                @csrf
                <div style="padding: 15px 20px 15px 10px">
                    <input type="hidden" name="formfor" value="logo">
                    <input type="hidden" name="idOf" value="{{$id}}" id="idOf">
                    <input class="form-control-file" type="file" id="imageFile" name="logoedit">
                    @error('logoedit')
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