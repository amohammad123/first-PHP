<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(){
        return Response(post::all());
    }

    public function show($id){
        return Response(post::findOrFail($id));
    }

    public function store(Request $request){
        # get the user requested:
        $user = Auth::user();
        // $user = auth()->user();
        
        # create post 1:
        // $post = new post();
        // $post->user_id = request('user_id');
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->save();

        # create post 2: should add $fillable in model
        $post = post::create([
            // 'user_id' => request('user_id'),
            // 'title' => request('title'),
            // 'body' => request('body'),

            'user_id' => $user->id,
            'title' => $request->title,
            'body' => $request->body
        ]);


        return Response($post, 201);
        // return Response('post');
    }

    public function destroy(){
        $id = request('id');
        $post = post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Successfully Deleted']);

    }

    public function update($id){
        $post = post::findOrFail($id);
        if(request('title')){
            if(request('title') === $post->title){
                return Response()->json(['message'=>'No change found']);
            }
            $post->title = request('title');
        }
        if(request('body')){
            if(request('body') === $post->body){
                return Response()->json(['message'=>'No change found']);
            }
            $post->body = request('body');
        }
        if(!request('title') && !request('body')){
            return Response()->json(['message'=>'data is invalid']);
        }
        $post->save();
        return Response()->json(['message'=>'Successfully Update', 'data'=>$post]);
    }
}
