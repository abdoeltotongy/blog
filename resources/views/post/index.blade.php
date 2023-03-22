@extends('layouts.main')
@section('title')
    Posts
@endsection

@section('content')
    <div class="min-h-screen dark:bg-gray-900 ">
        <div class="container">

            <div class="add-post add-new">
                <a class="btn" href="{{ route('post.soft.delete') }}">
                    With Trashed</a>

                <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New
                    Post</button>

            </div>



            <!-- add Modal -->
            @include('inc.errors')
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content  dark:bg-gray-900">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Add New Post</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                                style="background-color: wheat"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{ route('blog.store') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">
                                    <label for="title" class="text-gray-400">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" placeholder="title" />
                                    {{-- @error('title')
                                        <p>{{ $message }}</p>
                                    @enderror --}}
                                </div>



                                <div class="form-group">
                                    <label for="author" class="text-gray-400">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ old('author') }}" placeholder="author" />
                                </div>


                                <div class="form-group">
                                    <label for="content" class="text-gray-400">Content</label>
                                    <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image" class="text-gray-400">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" />
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- show all post --}}
            <div class="row">
                <div class="col-12">
                    <div class="dark:bg-gray-800 max-w-full ">
                        <table class="table dark:text-gray-400">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Content</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: initial; ">
                                @foreach ($posts as $post)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <img src="{{ $post->image }}">
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author }}</td>
                                        <td>
                                            <p class="content-text"> {{ $post->content }}</p>
                                        </td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>

                                            <a href="{{ route('blog.show', $post->id) }}" type="button"
                                                class="btn btn-outline-secondary">Show</a>


                                            <a type="button" class="btn btn-outline-success"
                                                href="{{ route('blog.edit', $post->id) }}">
                                                Edit
                                            </a>


                                            <button class="btn btn-outline-danger " type="submit"
                                                onclick="removeItem('{{ route('blog.destroy', $post->id) }}')">
                                                Delete
                                            </button>
                                            <form id="deleteItem" action="{{ route('blog.destroy', $post->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function removeItem(url, e) {
        $('#deleteItem').attr("action", url);
        $('#deleteItem').submit();
        Swal.fire('Deleted successfully', '', 'success')
    };
</script>
