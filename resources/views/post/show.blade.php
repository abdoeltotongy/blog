@extends('layouts.main')
@section('title')
    Update
@endsection
@include('layouts.header')

@section('content')
    <div class="dark:bg-gray-900 min-h-screen">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="add-post add-new">
                        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add comment
                        </button>
                    </div>
                    <!-- Add  comment -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('comment.store', $post->id) }}" method="POST">@csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />


                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea type="text" class="form-control" id="comment" name="comment" placeholder="comment...   "></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Add
                                                Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card mb-3" style="max-width: 700px; margin: auto">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="show-img" src="{{ $post->image }}" class="img-fluid rounded-start"
                                    alt="post">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $post->title }}</h3>
                                    <h6 class="card-text">{{ $post->author }}</h6>
                                    <hr>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <hr>
                                    <p class="card-text"><small class="text-muted"> {{ $post->created_at }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>


                    @foreach ($comments as $comment)
                        @if ($post->id === $comment->post_id)
                            <div class="card mb-3" style="max-width: 700px; margin: auto">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body comment-card">
                                            <p class="card-text">{{ auth()->user()->name }}</p>
                                            <p class="card-text">{{ $comment->comment }}</p>

                                            <div>
                                                <a type="button" class="btn btn-outline-success edit-btn"
                                                    data-id="{{ $comment->id }}" data-post-id="{{ $comment->post_id }}"
                                                    data-user-id="{{ $comment->user_id }}"
                                                    data-comment="{{ $comment->comment }}" data-bs-toggle="modal"
                                                    data-bs-target="#edit-modal"
                                                    href="{{ route('comment.edit', $comment->id) }}">
                                                    Edit
                                                </a>


                                                <button class="btn btn-outline-danger " type="submit"
                                                    onclick="removeItem('{{ route('comment.delete', $comment->id) }}')">
                                                    Delete
                                                </button>
                                                <form id="deleteItem" action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Comment -->
    @include('inc.errors')
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('comment.edit', $post->id) }}" id="edit-form"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id">
                        <input type="hidden" name="user_id">
                        <input type="hidden" name="post_id">

                        <div class="card-body">
                            <div class="form-group">
                                <label>Comment </label>
                                <input type="text" name="comment" class="form-control" value="{{ old('comment') }}">
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="edit-form" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
@section('scripts')
    <script>
        function removeItem(url, e) {
            $('#deleteItem').attr("action", url);
            $('#deleteItem').submit();
            Swal.fire('Deleted successfully', '', 'success')
        };
    </script>
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id');
            let user_id = $(this).attr('data-user-id');
            let post_id = $(this).attr('data-post-id');
            let comment = $(this).attr('data-comment');

            $("#edit-form input[name|='id']").val(id)
            $("#edit-form input[name|='user_id']").val(user_id)
            $("#edit-form input[name|='post_id']").val(post_id)
            $("#edit-form input[name|='comment']").val(comment)
        })
    </script>
@endsection
