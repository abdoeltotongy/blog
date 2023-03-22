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
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">Update Post</h5>
                        </div>
                        @include('inc.errors')
                        <div class="modal-body">

                            <form action="{{ route('blog.update', $post->id) }}" method="post">
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label for="title" class="text-gray-400">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $post->title }}" placeholder="title" />
                                </div>

                                <div class="form-group">
                                    <label for="author" class="text-gray-400">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ $post->author }}" placeholder="author" />
                                </div>


                                <div class="form-group">
                                    <label for="content" class="text-gray-400">Content</label>
                                    <textarea class="form-control" id="content" name="content" style="height: 150px">{{ $post->content }}</textarea>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="image" class="text-gray-400">Image</label>

                                    <input type="file" class="form-control" id="image" name="image" />
                                </div> --}}
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    @include('layouts.footer')
@endsection
