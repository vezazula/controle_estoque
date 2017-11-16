<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  	/**
    * access validation functions
   	*/    

    public function LoginValidator(){
    	
    	if(auth()->user() == null){
    		abort(403); 
    	}
    }

    public function AdmValidator(){
    	$user = Auth()->user();
        
        if ($user->permission == 0){
            abort(403);
           //USUÁRIO COMUM
        }
	}
}
