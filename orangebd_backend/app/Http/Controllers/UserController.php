<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view()
    {
        $users = User::all();
        return view('user.users')->with('users',$users);
    }

    public function addUser()
    {
        return view('user.userAdd');
    }

    public function postaddUser(Request $rqst)
    {  
        $user = new User;
        $user->name = $rqst->name;
        $user->email = $rqst->email;
        $user->password = Hash::make($rqst->password);
        $user->role = $rqst->role;
        $user->save();
        return redirect('/users');
    }

    public function edit(Request $rqst)
    {
        $id =  array_key_first($rqst->all());
        $user = User::find($id);
        return view('user.userEdit')->with('user',$user);
    }

    public function postedit(Request $rqst)
    {
       
        $product = User::find($rqst->id);
        $product->name = $rqst->name;
        $product->email = $rqst->email;
        //$product->role = $rqst->role;
        $product->update();
        return redirect('/users');
    }
}
