<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ValidatePostForm;
use App\Models\Post;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::latest()->paginate(10);

    if ($posts) {
      return $posts;
    } else {
      return response()->json([
        'status'   => 500,
        'message'  => "Posts can not be found"
      ]);
    }
  }

  public function store(ValidatePostForm $request)
  {
    $post = new Post([
      'title'        => $request->get('title'),
      'description'  => $request->get('description')
    ]);
    $post->save();

    if ($post) {
      return response()->json([
        'status'   =>  200,
        'message'  => 'Post "' . $post->title . '" added successfully'
      ]);

    } else {
      return response()->json([
        'status'  => 500
      ]);
    }
  }

  public function update(ValidatePostForm $request, $id)
  {
    $post = Post::find($id);

    if ($post) {
      $post->title       =  $request->get('title');
      $post->description =  $request->get('description');
      $post->save();

      return response()->json([
        'status'   =>  200,
        'message'  => 'Post "' . $post->title . '" updated successfully'
      ]);
    } else {
      return response()->json([
        'status'  => 404
      ]);
    }
  }

  public function destroy($id)
  {
    $post = Post::find($id);

    if ($post) {
      $post->delete();

      return response()->json([
        'status'    => 200,
        'message'   => 'Post ' . $post->title . 'deleted successfully.'
      ]);
    } else {
      return response()->json([
        'status'  => 404,
        'message' => 'Post can not be found'
      ]);
    }
  }
}
