<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutOrder;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(CheckoutOrder $request){
    
        if(auth()->check()){
            $user = Auth::user();
        }else{
            if($request->has('create_account') && $request->email != null && $request->password != null){  
                $user = User::create([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->shipping_address,
                    'password' => bcrypt($request->password),
                    'user_type' => 'customer',
                ]);  
            }else{
                $user = null;
            }
            
        } 
        $code_z = Order::latest()->first()->order_num ?? 0;
        $last_order_code = intval(str_replace('#','',strrchr($code_z,"#")));
        $order = new Order;
        $country = Country::findOrFail($request->country_id);
        $order->user_id  = $user->id ?? null;
        $order->country_id  = $country->id;  
        $order->first_name  = $request->first_name;
        $order->last_name  = $request->last_name;
        $order->phone_number  = $request->phone_number; 
        $order->shipping_cost  = $country->cost;
        $order->shipping_address = $request->shipping_address;  
        $order->order_num = 'customer#' . ($last_order_code + 1);
        $order->save();
        
        $total_cost = 0;
        
        foreach(session('cart') as $cartItem){ 
            $product = Product::findOrFail($cartItem['product_id']);
            $product->num_of_sale += $cartItem['quantity'];
            $product->save(); 

            $total_cost += $product->price * $cartItem['quantity'];

            for($i = 0 ; $i < $cartItem['quantity'] ; $i++){
                $order_items [] = [
                    'order_id' => $order->id,
                    'product_id' => $cartItem['product_id'],     
                    'quantity' => 1,
                    'price' => $product->price, 
                    'total_cost' => $product->price, 
                    'token' => $order->id . generateRandomString(5),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        OrderProduct::insert($order_items);

        $order->total_price = $total_cost;
        $order->save();
        
        if($request->has('create_account')){
            Auth::login($user);
        } 
        session()->put('cart',null);
        alert('Order Placed Successfully','','success');
        return redirect()->route('home');
    }

    public function orders(){
        $orderProducts = OrderProduct::with('order','product')->whereHas('order',function($q){
            $q->where('user_id',Auth::id());
        })->orderBy('created_at','desc')->simplePaginate(10);
        return view('frontend.dashboard.orders',compact('orderProducts'));
    }
}
