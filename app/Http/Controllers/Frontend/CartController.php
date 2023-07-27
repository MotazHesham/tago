<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        $not_include_subscribe = true; 
        $not_include_cart_popup = true; 
        $countries = Country::where('status',1)->get();
        return view('frontend.cart',compact('not_include_subscribe','countries','not_include_cart_popup'));
    } 

    public function store(Request $request){
        $product = Product::find($request->id);
        $quantity = 1;
        $newCartItem = [
            'product_id' => $request->id,
            'quantity' => $quantity,
        ]; 
        if(session('cart')){
            $cart = collect();

            foreach (session('cart') as $cartItem){
                if($cartItem['product_id'] == $request->id){ 
                    return false;
                }
                $cart->push($cartItem);
            }

            $cart->push($newCartItem); 
            session()->put('cart', $cart);
        } else{
            $cart = collect([$newCartItem]);
            session()->put('cart', $cart);
        } 
        return view('frontend.partials.cartItem',compact('product','quantity'));
    }
    
    public function update(Request $request){ 
        $cart = collect();
        $total = 0;
        foreach(session('cart') as $cartItem){  
            $product = Product::find($cartItem['product_id']);
            if($cartItem['product_id'] == $request->id){
                $cartItem['quantity'] = $request->quantity; 
            }
            $cart->push($cartItem);
            $total += ($request->quantity * $product->price);
        } 
        session()->put('cart', $cart); 
        return frontend_currency($total)['as_text'];
    }

    public function delete(Request $request){
        if(session()->has('cart')){ 
            $cart = session('cart');
            $cart = $cart->where('product_id','!=',$request->id);
            session()->put('cart',$cart); 
        } 
        return 1;
    }
}
