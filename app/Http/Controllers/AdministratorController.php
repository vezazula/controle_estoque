<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class AdministratorController extends Controller
{
    public function index(){

        /**
         * Access validation functions
         */
        
        parent::AdmValidator();
    	parent::LoginValidator();    	
       
        $user = Auth()->user();
        $permission = $user->permission;

        /**
         * Variables receive data
         */

    	$users = User::all();
    	$products = Product::all();
    	$total = 0;
    	
        /**
         * Calculation of total cost of products registered
         */
        
        foreach ($products as $product){
    		
            $total += ($product->cost * $product->quantity);
    	}

        /**
         * Sends data to the interface
         */
        
    return view('user.dashboard', compact('users', 'products', 'total', 'permission'));

    }
}
