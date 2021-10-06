<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCart(){
        //$carts = Cart::where('userId', Auth::id())->get();

        return response()->json([
            'state' => true,
            'message' => "Success",
            'data' => Cart::where('userId', Auth::id())->get(),
        ], 200);
    }

    public function removeFromCart(){}

    public function addToCart(){}
}
