<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Supplier;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        parent::LoginValidator();
        $user = Auth()->user();
        $permission = $user->permission;
        $products = Product::all();
        $suppliers = Supplier::orderBy('name', 'DESC')->get();
        // O QUE É DESC
        return view('product.index', compact('products', 'suppliers', 'permission'));
    }
    
    public function search(Request $request){
        parent::LoginValidator();
        $suppliers = Supplier::all();
        $products = DB::select('SELECT * FROM products WHERE name LIKE ?', ['%'.$request->name.'%']);
        return view('product.search', compact('products', 'suppliers'));
    }

    public function debit(Request $request){
        parent::LoginValidator();
        $product = Product::find($request->id);
        $product->quantity -= $request->quantity;
        $product->save();
        return redirect()->back();
    }

    public function store(Request $request){
        parent::LoginValidator();
        $product = new Product;
        $product->suppliers_id = $request->suppliers;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->quantity = $request->quantity;
       

        if (!empty($request->suppliers)) {
              $product->suppliers_id = $request->suppliers;
            $product->save();
        }

        return redirect()->back();
    }

    public function edit(Request $request){
        parent::LoginValidator();
        $product = Product::find($request->id);
        $product->suppliers_id = $request->suppliers;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->quantity = $request->quantity;
        
        if (!empty($request->suppliers)) {
            $product->save();
        }
        return redirect()->back();
    }

    public function listSuppliers($id){
        parent::LoginValidator();
        $bySupplier = Supplier::where('id', $id)->first();
        $suppliers = Supplier::all();
        $products = DB::select('SELECT * FROM products WHERE suppliers_id = ?', [$id]);
        return view('supplier.products', compact('products', 'suppliers', 'bySuppliers'));
    }
}
