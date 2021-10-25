<div class="modal fade" id="add-image-post" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPost">Post an Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('addpost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="formfor" type="hidden" value="imagepost">
                @auth<input type="hidden" name="user" value="{{Auth::user()->id}}">@endauth
                <input type="hidden" name="game" value="{{$id}}">
                <div class="modal-body">
                    <div class="form-row form-group">
                        <label for="post-title"> Title</label>
                        <input name="title" class="form-control" type="text" value=""></input>
                        @error('title', 'imagepost')
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row form-group">
                        <label for="post-decsription">Description</label>
                        <input name="content" class="form-control" type="text" value=""></input>
                        @error('content', 'imagepost')
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="post-image">Select Image</label>
                        <input name="image" class="form-control-file" type="file" value="">
                        @error('image', 'imagepost')
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add-text-post" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPost">Post a Discussion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('addpost')}}" method="post">
                @csrf
                <input name="formfor" type="hidden" value="textpost">
                @auth<input type="hidden" name="user" value="{{Auth::user()->id}}">@endauth
                <input type="hidden" name="game" value="{{$id}}">
                <div class="modal-body">
                    <div class="form-row form-group">
                        <label for="title">Title</label>
                        <input name="title" class="form-control" type="text" placeholder="Add post's title here" value=""></input>
                        @error('title', 'textpost')
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row form-group">
                        <label for="content">Discussion</label>
                        <textarea name="content" class="form-control" type="text" placeholder="Add discussion here" value=""></textarea>
                        @error('content', 'textpost')
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>

            </form>
        </div>
    </div>
</div>