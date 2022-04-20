<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::latest()->paginate(4);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'        => 'required|min:3|max:255|unique:posts',
            'description'  => 'required|min:10|max:255'
        ]);
        $post = new Post([
            'title'        => $request->get('title'),
            'description'  => $request->get('description')
        ]);
        $post->save();

        return response()->json([
            'status'   =>  200,
            'message'  => 'Post "' . $post->title . '" added successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'        => 'required|min:3|max:255|unique:posts',
            'description'  => 'required|min:10|max:255'
        ]);
        $post = Post::find($id);
        $post->title       =  $request->get('title');
        $post->description =  $request->get('description');
        $post->save();

        return response()->json([
            'status'   =>  200,
            'message'  => 'Post "' . $post->title . '" updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id)->delete();
    }
}
