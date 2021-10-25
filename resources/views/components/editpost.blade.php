<div class="modal fade" id="edit-image-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPost">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('editpost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="postid" type="hidden" value="{{$post->id}}">
                <input name="formfor" type="hidden" value="edit_imagepost">
                <div class="modal-body">
                    <div class="form-row form-group">
                        <label for="post-title">Title</label>
                        <input name="title" class="form-control" type="text" placeholder="Post title" value="{{$post->title}}"></input>
                        @error('title', 'imagepost'.$post->id)
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row form-group">
                        <label for="post-decsription">Description</label>
                        <input name="content" class="form-control" type="text" placeholder="Post description" value="{{$post->content}}"></input>
                        @error('content', 'imagepost'.$post->id)
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="post-image">Image</label>

                        <input name="image" class="form-control-file" type="file" value="">
                        @error('image', 'imagepost'.$post->id)
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveEditWithImage">Save changes</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-text-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPost">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('editpost')}}" class="form-group" method="post">
                @csrf
                <input name="postid" type="hidden" value="{{$post->id}}">
                <input name="formfor" type="hidden" value="edit_textpost">
                <div class="modal-body">
                    <div class="form-row">
                        <label for="post-title">Title</label>
                        <input class="form-control" name="title" type="text" placeholder="Discussion title" value="{{$post->title}}" @error('title', 'textpost'.$post->id) value="{{old('title')}}" @enderror></input>
                        @error('title', 'textpost'.$post->id)
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="post-decsription">Discussion</label>
                        <textarea class="form-control" name="content" type="text" placeholder="Discusstion">{{$post->content}}</textarea>
                        @error('title', 'textpost'.$post->id)
                        <div class="error-mess">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveEditWithoutImage">Save changes</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $("button, #saveEditWithImage, #saveEditWithoutImage").click(function(){
  	var currentPost = $('html, body').scrollTop();
  	localStorage.setItem('currentPost', currentPost);
  });
</script>