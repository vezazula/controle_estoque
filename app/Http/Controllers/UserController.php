<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	parent::AdmValidator();
        parent::LoginValidator();   
        $user = Auth()->user();
        $permission = $user->permission;
        
    	$showUsers = User::orderBy('name', 'ASC')->get();

    	return view('user.index', compact('showUsers', 'user', 'status', 'permission'));
    }

    public function store(Request $request){
    	parent::AdmValidator();
        parent::LoginValidator();   
    	$listUser = new User;

    	$listUser->name = $request->name;
    	$listUser->email = $request->email;
    	$listUser->password = bcrypt($request->password);
        $listUser->status = 'active';
    	$listUser->permission = $request->permission;

    	$listUser->save();

    	return redirect('/user');
    }

    public function update(Request $request){
    	parent::AdmValidator();
        parent::LoginValidator();   

    	$upUser = User::where('id', $request->id)->first();

    	$upUser->name = $request->name;
        $upUser->email = $request->email;
        $upUser->status = $request->status;
        $upUser->permission = $upUser->permission;

    	$upUser->save();

    	return redirect('/user');
    }

    public function disabled(Request $request){
    	parent::AdmValidator();
        parent::LoginValidator();   

    	$disUser = User::where('id', $request->id)->first();
    	$disUser->status = 0;
    	$disUser->save();

    	return redirect('/user');
    }

    public function reactivate(Request $request){
        parent::AdmValidator();
        parent::LoginValidator();   

        $reUser = User::where('id', $request->id)->first();
        $reUser->status = 1;
        $reUser->save();

        return redirect('/user');
    }
}
