@extends('layouts.main')
@section('title')
    Posts
@endsection
@include('layouts.header')

@section('content')
    <div class="min-h-screen dark:bg-gray-900 ">
        <div class="container">

            <div class="add-post add-new">
                <a class="btn" href="{{ route('blog.index') }}">
                    With Out Trashed</a>
            </div>



            {{-- show all post --}}
            <div class="row">
                <div class="col-12">
                    <div class="  dark:bg-gray-800 max-w-full ">
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
                            <tbody style="vertical-align: middle; ">
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
                                        <td style="display: inline-grid; ">


                                            <button class="btn btn-outline-success " type="submit"
                                                onclick="removeItem('{{ route('post.restore', $post->id) }}')">
                                                Restore
                                            </button>
                                            <form id="deleteItem" action=" " method="POST">
                                                @csrf
                                            </form>


                                            <form id="deleteItem" action="{{ route('post.forceDelete', $post->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" type="submit">
                                                    Force Delete
                                                </button>
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



    @include('layouts.footer')
@endsection
<script>
    function removeItem(url, e) {
        $('#deleteItem').attr("action", url);
        $('#deleteItem').submit();
        Swal.fire('Deleted successfully', '', 'success')
    };
</script>
