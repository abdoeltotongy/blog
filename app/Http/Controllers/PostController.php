<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::get();
        return view('post.index',compact('posts'));
    }

    public function softDelete()
    {
        $posts = Post::withTrashed()->whereNotNull('deleted_at')->get();;
        return view('post.trashed',compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('blog.index')->with('success', 'Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::get();
        return view('post.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit',compact('post'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request,$id)
    {
        Post::where('id' , $id)->update($request->only('title' , 'author','content'));

        return redirect()->route('blog.index')->with('msg', 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();
        return redirect()->back()->with('msg', 'Deleted successfully');;
    }
    public function restore($id)
    {
        Post::where('id',$id)->restore();
        return redirect()->back()->with('msg', 'restore successfully');;
    }
    public function forceDelete($id)
    {
        Post::where('id',$id)->forceDelete();
        return redirect()->back()->with('msg', 'forceDelete successfully');;
    }



    public function comment()
    {
        $data['posts'] = Post::get();
        $data['comment'] = Comment::get();

        return view('comment.index')->with($data);
    }

    public function createComment(Request $request){

       Comment::create([
            'user_id' =>  $request->user_id,
            'post_id' =>  $request->post_id,
            'comment' =>  $request->comment,
        ]);

         return redirect()->back()->with('msg', 'Added successfully');
    }


    public function editComment(Request $request , $id)
    {
        Comment::findOrFail($request->id)->update([
            'post_id' =>  $request->post_id,
            'user_id' =>  $request->user_id,
            'comment' =>  $request->comment,
        ]);


        return redirect()->back()->with('msg', ' Updated Successfully');
    }

    public function deleteComment($id)
    {
        Comment::where('id',$id)->delete();
        return redirect()->back()->with('msg', 'Deleted successfully');;
    }
}