<!-- Modal -->
<div class="modal fade lowlayer" id="postcomment-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="">Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Comment layout -->
                @foreach($comment as $postcomment)
                @if($post->id == $postcomment->post_id)
                <div class="card mb-4">
                    <div class="card-body text-muted" style=" padding-top:2px!important">
                        <div class="row justify-content-between" style="font-size:15px;">
                            <div class="px-1" style="width: auto; display: flex;">
                                {{$postcomment->comment_by_user->username}}
                            </div>
                            <div class="px-1">
                                {{$postcomment->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="row border-top" style="color:black">
                            <div class="px-1 col-sm-11" style="height: auto;">
                                {{$postcomment->comment_text}}
                            </div>
                            <div class="px-1 col-sm-1" style="height: auto;">
                                <!-- <a data-toggle="modal" href="#commentModal">
                                    <i class='far fa-edit hover-icon toggle-comment' data-placement="top" title="Edit Comment" data-toggle="tooltip"></i>
                                </a> -->
                                @if(Auth::user() && Auth::user()->id == $postcomment->user_id)
                                <div class="dropdown">
                                    <i class="fas fa-edit pull-right hover-icon w3-xlarge" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu" aria-labelledby="editMenu">
                                        <div class="dropdown-item" id="edit-comment" data-toggle="modal" data-target="#commentModal-{{$postcomment->id}}"> Edit comment</div>
                                        <div class="dropdown-item" id="delete-comment" data-toggle="modal" data-target="#deleteComment-{{$postcomment->id}}"> Delete comment</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @include('components.editcmt_des_bio',
                ['modalId' => 'commentModal-' . $postcomment->id,
                'action'=> route('editcomment'),
                'edittext' => '<label for="editcomment">New Comment</label>
                <input type="hidden" id="editcomment" name="editcommentid" value="'. $postcomment->id .'">
                <input type="text" class="form-control pl-2" id="editcomment" name="editcomment" placeholder="New Comment">',
                'modaltitle' => 'Edit Comment',
                'editbutton' => 'editComment'])

                @include('components.delete',
                ['deletedObject' => 'comment',
                'deleteModalId' => 'deleteComment-' . $postcomment->id,
                'deleteRoute'=> route('deletecomment'),
                'deleteItem'=>'comment',
                'itemId'=>$postcomment->id,
                'deletebutton' => 'deleteComment',
                'postidcomment' => '<input type="hidden" id="postidcomment" name="postidcomment" value="'. $post->id .'">'])
                @if(session('editCommentSuccess'. $postcomment->id) || session('deleteCommentSuccess'.$post->id))
                <script>
                    var currentPostComment = parseInt(localStorage.getItem('currentPostComment'));
                    $('html, body').animate({
                        scrollTop: currentPostComment + "px"
                    });
                    $('#gamepage-tabs a[href="#post"]').tab('show');
                    $("#postcomment-{{$post->id}}").modal('show');
                </script>
                @endif
                @endif
                @endforeach
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="container-fluid">
                    <form action="{{route('addcomment')}}" method="POST" class="comment">
                        @csrf
                        <div class="form-group form-inline d-flex justify-content-betweens">
                            <input type="hidden" name="postid" value="{{$post->id}}">
                            <input type="hidden" name="gameid" value="{{$id}}">
                            <input type="text" style="width: 80%;" class="form-control" id="comment" name="comment" placeholder="Enter your comment">
                            <button type="submit" class="btn btn-secondary btn-md mx-2" id="addComment">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.askjoingame', ['askforjoingameId' => 'askForJoinGameComment', 'todowhat' => 'comment', 'ofwhat' => 'comment'])
<script>
    $("button, #addComment, #editComment, #deleteComment").click(function() {
        var currentPost = $('html, body').scrollTop();
        localStorage.setItem('currentPostComment', currentPost);
    });
</script>
@if(session('postCommentAdded' . $post->id))
<script>
    var currentPostComment = parseInt(localStorage.getItem('currentPostComment'));
    $('html, body').animate({
        scrollTop: currentPostComment + "px"
    });
    $('#gamepage-tabs a[href="#post"]').tab('show');
    $("#postcomment-{{$post->id}}").modal('show');
</script>
@endif