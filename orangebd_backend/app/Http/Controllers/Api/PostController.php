<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoty;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function view()
    {
        $posts = Post::all();
        $categories = Categoty::all();
        foreach($posts as $post)
        {
            $author = User::where('id' , $post->uid)->first();
            $category = Categoty::where('id' , $post->cid)->first();
            $post['author_name'] = $author['name'];
            $post['category_name'] =  $category['name'];
          
        }
       
        return response()->json($posts);
    }

    public function add()
    {
        $author = User::where('role' , 2)->get();
        $category = Categoty::all();
        $data = array("author"=>$author , "category"=>$category);
        return response()->json($data);
    }

    public function postadd(Request $rqst)
    {
        // dd($rqst->all());
        $product = new Post;
        $product->cid = $rqst->cid;
        $product->uid = $rqst->uid;
        $product->title = $rqst->title;
        $product->description = $rqst->description;
        $product->save();
        $posts = Post::all();
        foreach($posts as $post)
        {
            $author = User::where('id' , $post->uid)->first();
            $category = Categoty::where('id' , $post->cid)->first();
            $post['author_name'] = $author['name'];
            $post['category_name'] =  $category['name'];
          
        }
        return response()->json( $posts );
    }

    public function edit(Request $rqst)
    {
        $id =  $rqst->id;
        $post = Post::find($id);
        $author = User::where('id' , $post->uid)->first();
        $category = Categoty::where('id' , $post->cid)->first();
        $post['author_name'] = $author['name'];
        $post['category_name'] =  $category['name'];   
        return response()->json( $post );
    }

    public function postedit(Request $rqst)
    {
        $product = Post::find($rqst->id);
        $product->title = $rqst->title;
        $product->description = $rqst->description;
        $product->update();
        $posts = Post::all();
        foreach($posts as $post)
        {
            $author = User::where('id' , $post->uid)->first();
            $category = Categoty::where('id' , $post->cid)->first();
            $post['author_name'] = $author['name'];
            $post['category_name'] =  $category['name'];
          
        }
        return response()->json(  $posts );
    }

    public function delete(Request $rqst)
    {
        $category = Post::find($rqst->id);
        $category->delete();
        return response()->json(["isConfirmed"=>true]);
    }
}
