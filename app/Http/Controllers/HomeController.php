<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::user()->id){
            $cart_items = Cart::all();
        }
       
        $products = Products::all();
        return view('welcome', compact('products', 'cart_items'));
    }
}
