<?php

namespace App\Http\Controllers;

use App\Models\Categoty;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function view()
    {
        $posts = Post::all();
        $categories = Categoty::all();
        foreach ($posts as $post) {
            $author = User::where('id', $post->uid)->first();
            $category = Categoty::where('id', $post->cid)->first();
            $post['author_name'] = $author['name'];
            $post['category_name'] =  $category['name'];
        }
        return view('post.posts', compact('categories', 'posts'));
    }

    public function postdetails(Request $rqst)
    {
        //dd($rqst->all());
        $id =  array_key_first($rqst->all());
        $post = Post::where('id', $id)->first();
        $author = User::where('id', $post->uid)->first();
        $category = Categoty::where('id', $post->cid)->first();
        $post['author_name'] = $author['name'];
        $post['category_name'] =  $category['name'];
        return view('post.postDetails',)->with('post', $post);
    }

    public function add()
    {
        $author = User::where('role', 2)->get();
        $category = Categoty::all();
        return view('post.postAdd', compact('author', 'category'));
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
        return redirect('/posts');
    }

    public function edit(Request $rqst)
    {
        $id =  array_key_first($rqst->all());
        $post = Post::find($id);
        $author = User::where('id', $post->uid)->first();
        $category = Categoty::where('id', $post->cid)->first();
        $post['author_name'] = $author['name'];
        $post['category_name'] =  $category['name'];
        $authors = User::where('role', 2)->get();
        $categories = Categoty::all();
        return view('post.postEdit', compact('authors', 'categories'))->with('post', $post);
    }

    public function postedit(Request $rqst)
    {
        $product = Post::find($rqst->id);
        $product->title = $rqst->title;
        $product->description = $rqst->description;
        $product->update();
        return redirect('/posts');
    }

    public function delete($id)
    {
        $category = Post::find($id);
        $category->delete();
        return redirect('/posts');
    }

    public function postsfilter(Request $rqst)
    {
        $posts = Post::where('cid', ((int)$rqst->role))->get();

        $categories = Categoty::all();
        foreach ($posts as $post) {
            $author = User::where('id', $post->uid)->first();
            $category = Categoty::where('id', $post->cid)->first();
            $post['author_name'] = $author['name'];
            $post['category_name'] =  $category['name'];
        }

        return view('post.posts', compact('categories', 'posts'));
    }

    public function authorview()
    {
        $authors = Auth::user();
        $categories = Categoty::all();
        $posts = Post::where('uid',  $authors->id)->get();
        foreach ($posts as $post) {

            $category = Categoty::where('id', $post->cid)->first();

            $post['category_name'] =  $category['name'];
        }
        //dd($user->id);

        return view('post.authorposts', compact('posts', 'categories'));
    }

    public function authoradd()
    {
        $category = Categoty::all();
        return view('post.authorpostAdd', compact('category'));
    }

    public function authorpostadd(Request $rqst)
    {
        $product = new Post;
        $product->cid = $rqst->cid;
        $product->uid = Auth::user()->id;
        $product->title = $rqst->title;
        $product->description = $rqst->description;
        $product->save();
        return redirect('/authorposts');
    }

    public function authoredit(Request $rqst)
    {
        $id =  array_key_first($rqst->all());
        $post = Post::find($id);
        $author = User::where('id', $post->uid)->first();
        $category = Categoty::where('id', $post->cid)->first();
        $post['author_name'] = $author['name'];
        $post['category_name'] =  $category['name'];
        $authors = User::where('role', 2)->get();
        $categories = Categoty::all();
        return view('post.authorpostEdit', compact('authors', 'categories'))->with('post', $post);
    }


    public function authorpostsedit(Request $rqst)
    {
        $product = Post::find($rqst->id);
        $product->title = $rqst->title;
        $product->description = $rqst->description;
        $product->update();
        return redirect('/authorposts');
    }

    public function authorpostsfilter(Request $rqst)
    {
        $posts = Post::where('cid', ((int)$rqst->role))
            ->where('uid', Auth::user()->id)->get();
        $categories = Categoty::all();
        foreach ($posts as $post) {
            $category = Categoty::where('id', $post->cid)->first();
            $post['category_name'] =  $category['name'];
        }
        return view('post.authorposts', compact('categories', 'posts'));
    }

    public function authorpostdetails(Request $rqst)
    {
        $id =  array_key_first($rqst->all());
        $post = Post::where('id', $id)->first();
        $author = User::where('id', $post->uid)->first();
        $category = Categoty::where('id', $post->cid)->first();
        $post['author_name'] = $author['name'];
        $post['category_name'] =  $category['name'];
        return view('post.authorpostDetails',)->with('post', $post);
    }
}
