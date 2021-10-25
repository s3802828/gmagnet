<!-- ajax for like/dislike -->
<script>
    $(document).on('click', '.vote-button', function() {
        var buttonID = this.id;
        var postID = buttonID.replace(/post-|-up|-down/g, "");
        var voteValue = "";
        var isClickedBefore = $("#" + buttonID).attr("value");

        console.log(buttonID);

        if (buttonID.search('up') > 0) {
            console.log("liked");
            if (isClickedBefore == "0") {
                voteValue = "1";
            } else {
                voteValue = "0";
            }
        } else {
            console.log("disliked");
            if (isClickedBefore == "0") {
                voteValue = "-1";
            } else {
                voteValue = "0";
            }
        }
        console.log(postID, voteValue, isClickedBefore);

        $.ajax({
            method: "POST",
            url: "{{ url('/gamepage') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                console.log("ajax function")
            },
            data: {
                formfor: 'isLiked',
                isLiked: voteValue,
                postID: postID,
                gameID: '{{$id}}',
            },
        }).done(
            function(data) {
                console.log("request sent successfully");
                if (data.voted) {
                    if (data.option == "like") {
                        $("#post-" + data.postID + "-up").css("color", "#3f51b5").attr("value", "1").html(" " + data.like + " ");
                        $("#post-" + data.postID + "-down").css("color", "").attr("value", "0").html(" " + data.dislike + " ");
                    } else if (data.option == "dislike") {
                        $("#post-" + data.postID + "-up").css("color", "").attr("value", "0").html(" " + data.like + " ");
                        $("#post-" + data.postID + "-down").css("color", "#3f51b5").attr("value", "1").html(" " + data.dislike + " ");
                    } else if (data.option == "neutral") {
                        $("#post-" + data.postID + "-up").css("color", "").attr("value", "0").html(" " + data.like + " ");
                        $("#post-" + data.postID + "-down").css("color", "").attr("value", "0").html(" " + data.dislike + " ");
                    }
                }
            }
        ).fail(
            function(jqXHR, textStatus, errorThrown) {
                console.log("failed to send request" + errorThrown)
            }
        )
    })
</script>

@if(session('deleteSuccess'))
<div class="alert alert-success" role="alert">
    {{session('deleteSuccess')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('addpostSuccess'))
<div class="alert alert-success" role="alert">
    {{session('addpostSuccess')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Iterate posts -->
@if($posts->count())
@foreach($posts as $post)
@if($post->image!=null)
<div class="pt-3">
    <div class="card mb-4">
        <div class="card-header text-muted" id="post-{{$post->id}}">
            Posted by: {{$post->post_by_user->username}}
            &nbsp;&nbsp;
            <span class="pull-right">
                {{$post->created_at->diffForHumans()}}
                @if(Auth::user() && Auth::user()->id==$post->user_id)
                &nbsp;&nbsp;
                <span class="dropdown">
                    <i class="fas fa-edit pull-right hover-icon w3-xlarge" data-toggle="dropdown"></i>
                    <div class="dropdown-menu" aria-labelledby="editMenu">
                        <div class="dropdown-item" id="edit-post" data-toggle="modal" data-target="#edit-image-post-{{$post->id}}"> Edit post</div>
                        <div class="dropdown-item" id="delete-post" data-toggle="modal" data-target="#deletePost{{$post->id}}"> Delete post</div>
                    </div>
                </span>
                @endif
            </span>
        </div>

        <div class="card-body">
            <h3 class="card-title">{{$post->title}}</h3>
            <p class="class-text"> {{$post->content}}
            </p>
        </div>

        <div class="">
            <img class="card-img-bottom" src="https://gmagnet.s3-ap-southeast-1.amazonaws.com/{{$post->image}}" alt=post-image>
        </div>

        <div class="card-footer text-muted">
            @if($post->voted_by->contains(Auth::user()))
            @if($post->voted_by->where('id', Auth::user()->id)->first()->pivot->vote_choice)
            <!-- status if user have liked this post -->
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="1" style="color:#3f51b5"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="0"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @else
            <!-- status if user have disliked this post -->
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="0"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="1" style="color:#3f51b5"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @endif
            @else
            <!-- status if user have not voted this post -->
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="0"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="0"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @endif
            <i class=" far fa-comment-dots hover-icon w3-large" data-toggle="modal" id="post-{{$post->id}}" data-target="#postcomment-{{$post->id}}"></i>
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
</div>

@else
<div class="pt-3">
    <div class="card mb-4">

        <div class="card-header text-muted" id="post-{{$post->id}}">
            Posted by: {{$post->post_by_user->username}}
            <span class="pull-right">
                {{$post->created_at->diffForHumans()}}
                @if(Auth::user() && Auth::user()->id==$post->user_id)
                &nbsp;&nbsp;
                <span class="dropdown">
                    <i class="fas fa-edit pull-right hover-icon w3-xlarge" data-toggle="dropdown"></i>
                    <div class="dropdown-menu" aria-labelledby="editMenu">
                        <div class="dropdown-item" id="edit-post" data-toggle="modal" data-target="#edit-text-post-{{$post->id}}"> Edit post</div>
                        <div class="dropdown-item" id="delete-post" data-toggle="modal" data-target="#deletePost{{$post->id}}"> Delete post</div>
                    </div>
                </span>
                @endif
            </span>
        </div>

        <div class="card-body">
            <h3 class="card-title">{{$post->title}}</h3>
            <p class="class-text"> {{$post->content}}
            </p>
        </div>

        <div class="card-footer text-muted">

            @if($post->voted_by->contains(Auth::user()))
            @if($post->voted_by->where('id', Auth::user()->id)->first()->pivot->vote_choice)
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="1" style="color:#3f51b5"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="0"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @else
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="0"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="1" style="color:#3f51b5"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @endif
            @else
            <i class="fa fa-thumbs-up hover-icon vote-button w3-large" id="post-{{$post->id}}-up" value="0"> {{$post->voted_by()->wherePivot("vote_choice", true)->count()}} </i>
            &nbsp;&nbsp;
            <i class=" fa fa-thumbs-down hover-icon vote-button w3-large" id="post-{{$post->id}}-down" value="0"> {{$post->voted_by()->wherePivot("vote_choice", false)->count()}} </i>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @endif

            <i class="far fa-comment-dots hover-icon w3-large" data-toggle="modal" id="post-{{$post->id}}" data-target="#postcomment-{{$post->id}}"></i>

            &nbsp;&nbsp;&nbsp;&nbsp;

        </div>
    </div>
</div>
@endif
<div>
    @include('components.postcomment')
    @include('components.editpost')
    @include('components.delete', ['deletedObject' => 'post', 'deleteModalId' => 'deletePost'.$post->id, 'deleteRoute'=>route('deletepost'), 'deleteItem'=>'post', 'itemId'=>$post->id])
    
</div>

@if($errors->hasBag('imagepost' . $post->id)>0)
<!-- toggle modal with error -->
<script>
    $('#gamepage-tabs a[href="#post"]').tab('show');
    var currentPost = parseInt(localStorage.getItem('currentPost'));
    $('html, body').animate({
        scrollTop: currentPost + "px"
    });
    $('#edit-image-post-{{$post->id}}').modal('show');
</script>
@elseif($errors->hasBag('textpost' . $post->id)>0)
<!-- toggle modal with error -->
<script>
    $('#gamepage-tabs a[href="#post"]').tab('show');
    $('html, body').animate({
        scrollTop: currentPost + "px"
    });
    $('#edit-text-post-{{$post->id}}').modal('show');
</script>
@endif

@if(session('editSuccess'.$post->id))
<!-- display success alert if the post is updated successfully -->
<script>
    $('#gamepage-tabs a[href="#post"]').tab('show');
    var currentPost = parseInt(localStorage.getItem('currentPost'));
    $('html, body').animate({
        scrollTop: currentPost + "px"
    });
    $("#post-{{$post->id}}").prepend(
        '<div class="alert alert-success" role="alert">{{session("editSuccess".$post->id)}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    );
</script>
@endif
@endforeach
@endif