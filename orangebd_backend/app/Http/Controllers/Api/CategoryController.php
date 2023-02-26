<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoty;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view()
    {   
        $categories = Categoty::all();
        return response()->json($categories);
    }

    public function postaddCategory(Request $rqst)
    {    
        $product = new Categoty;
        $product->id = $rqst->id;
        $product->name = $rqst->name;
        $product->save();
        $categories = Categoty::all();
        return response()->json($categories);
    }

    public function edit(Request $rqst)
    {
        $id =  $rqst->id;
        $category = Categoty::find($id);
        return response()->json($category);
    }

    public function postedit(Request $rqst)
    {   
        $product = Categoty::find($rqst->id);
        $product->name = $rqst->name;
        $product->update();
        $categories = Categoty::all();
        return response()->json($categories);
    }
}
