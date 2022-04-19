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
        $validator = Validator::make($request->all(), [
            'title'        => 'required|max:255',
            'description'  => 'required|max:255'
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'  => 422,
                'errors'  => $validator->messages()
            ]);

        } else {
            $post = new Post([
                'title'        => $request->get('title'),
                'description'  => $request->get('description')
            ]);
            $post->save();

            return response()->json([
                'status'   =>  200,
                'message'  => 'Post added successfully'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|max:255',
            'description'  => 'required|max:255'
        ]);
        if ($vakidator->fails()) {

        } else {
            $post = Post::find($id);
            $post->title       =  $request->get('title');
            $post->description =  $request->get('description');
            $post->save();

            return response()->json([
                'status'   =>  200,
                'message'  => 'Post updated successfully'
            ]);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id)->delete();
    }
}
