<?php

namespace App\Http\Controllers;

use App\Models\post;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return Response(post::all());
    }

    public function show($id){
        return Response(post::findOrFail($id));
    }
}
