<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type','!=', 1)->get();
        return view('admin.pages.accounts',compact('users'));
    }

    public function save(Request $request)
    {


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->save();

        return $user;

    }

    public function update(Request $request)
    {

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->user_type = $request->user_type;
        $user->save();

        return $user;

    }

    public function delete(Request $request){

        $user = User::where('id',$request->user_id)->delete();

        return $user;

    }
}
