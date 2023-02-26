<?php

namespace App\Http\Controllers;

use App\Models\Categoty;
use Illuminate\Http\Request;

class CategotyController extends Controller
{
    public function view()
    {
        $products = Categoty::all();
        return view('category.categories')->with('products',$products);
    }
    public function addCategory()
    {
        return view('category.categoryAdd');
    }

    public function postaddCategory(Request $rqst)
    {
        $product = new Categoty;
        $product->name = $rqst->name;
        $product->save();
        return redirect('/categories');
    }

    public function edit(Request $rqst)
    {
        $id =  array_key_first($rqst->all());
        $category = Categoty::find($id);
        //dd($category);
        return view('category.categoryEdit')->with('category',$category);
    }

    public function postedit(Request $rqst)
    {
        
        $product = Categoty::find($rqst->id);
        $product->name = $rqst->name;
        $product->update();
        return redirect('/categories');
    }

    public function delete($id)
    {
        $category = Categoty::find($id);
        $category->delete();
        return redirect('/categories');
    }
}
