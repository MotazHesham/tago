<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderTemplate;
use App\Models\Setting;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MagicoController extends Controller
{
    public function GETAPI($url,$headers){ 
        try{
            $client = new Client();
        
            $response = $client->request('GET', $url, [
                'headers' => $headers,
            ]); 
            // $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            return json_decode($body);
        }catch(\Exception $ex){
            // do nothing
        }
        return [];
    }

    public function pixaby_key(){
        return '41304177-d394b6a189a7aed6081a3e047';
    }
    public function unsplash_client_id(){
        return 'opfef79WNIhEgjaQ2HxGpGVojXAbfU8AQ6bAq40QmRQ';
    }
    public function iconscout_client_id(){
        return '172636883689370';
    }
    public function pexels_key(){
        return 'nu6ZdVIN8S5eLzKXd5uCM6rUe7IeXxD0FaJvveQcdhcM9ctB1Ivna1hk';
    }
    public function ordertemplate(Request $request){   
        $rules = [ 
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],   
            'email' => [
                'nullable',
                'email',
                'unique:users'
            ], 
            'password' => [
                'nullable',
                'min:6', 
            ], 
            'phone_number' => [
                'regex:' . config('panel.phone_number_format'), 
                'size:' . config('panel.phone_number_size'), 
                'required',
            ], 
            'shipping_address' => [
                'required',
            ],
            'country_id' => [
                'required',
                'integer',
            ], 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => $validator->errors()],200);
        } 

        $template = Template::find($request->template_id);  
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
        $order->order_type  = 'template';  
        $order->country_id  = $country->id;  
        $order->first_name  = $request->first_name;
        $order->last_name  = $request->last_name;
        $order->phone_number  = $request->phone_number; 
        $order->shipping_cost  = $country->cost;
        $order->shipping_address = $request->shipping_address;  
        $order->order_num = 'customer#' . ($last_order_code + 1);
        $order->save(); 

        $price = $request->card_type == 'nfc' ? $template->price + 100 : $template->price;
        
        if($request->card_type == 'nfc'){
            for($i = 0 ; $i < $request->quantity ; $i++){
                $order_items [] = [
                    'order_id' => $order->id, 
                    'template_id' => $template->id, 
                    'quantity' => 1,
                    'price' => $price,
                    'total_cost' => $price,
                    'has_nfc' => $request->card_type == 'nfc' ? 1 : 0,
                    'canvas_pages' => $request->canvas_pages,
                    'token' => $order->id . generateRandomString(5),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]; 
            }
        }else{
            $order_items [] = [
                'order_id' => $order->id, 
                'template_id' => $template->id, 
                'quantity' => $request->quantity,
                'price' => $price,
                'total_cost' => $price * $request->quantity,
                'has_nfc' => $request->card_type == 'nfc' ? 1 : 0,
                'canvas_pages' => $request->canvas_pages, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]; 
        }
        OrderTemplate::insert($order_items);

        $order->total_price = $price * $request->quantity;
        $order->save();
        
        if($request->has('create_account')){
            Auth::login($user);
        }  
        return response()->json(['status' => true],200);
    } 

    public function magico(Request $request){    

        $order_template = $request->order_template;
        if($order_template){
            $order_template = OrderTemplate::find($request->order_template)->canvas_pages;
        }

        $template_id = $request->template;
        if(!$template_id || !Template::find($template_id)){
            $template = Template::first();
            $template_id = $template ? $template->id : null;
        }

        $setting = Setting::first();  
        $templates = Cache::remember('templates', 3600, function () { 
            return Template::all();
        });   
        $iconscout_images = Cache::remember('iconscout_images', 3600, function () {
            $url = 'https://api.iconscout.com/v3/search';
            $headers = [  
                'Content-Type' => 'application/json', 
                'Client-ID' => $this->iconscout_client_id(), 
            ];
            return $this->GETAPI($url,$headers)->response->items ?? [];
        });     
        $pixabay_images = Cache::remember('pixabay_images', 3600, function () {
            $url = 'https://pixabay.com/api/?key='.$this->pixaby_key();
            $headers = [  
                'Content-Type' => 'application/json', 
            ];
            return $this->GETAPI($url,$headers)->hits ?? [];
        });     
        
        $pexels_images = Cache::remember('pexels_images', 3600, function () {
            $url = 'https://api.pexels.com/v1/curated?per_page=40';
            $headers = [  
                'Content-Type' => 'application/json', 
                'Authorization' => $this->pexels_key(), 
            ];
            return $this->GETAPI($url,$headers) ?? [];
        });  
        // $unsplash_images = Cache::remember('unsplash_images', 3600, function () {
        //     $url = 'https://api.unsplash.com/photos?per_page=20';
        //     $headers = [  
        //         'Content-Type' => 'application/json',
        //         'Authorization' => 'Client-ID '. $this->unsplash_client_id(), 
        //     ]; 
        //     return $this->GETAPI($url,$headers);
        // });  
        $unsplash_images = [];
        
        return view('magico.magico',compact('unsplash_images','pixabay_images','templates','iconscout_images','template_id','pexels_images','setting','order_template'));
    }

    public function unsplash_loading_more_images(Request $request){
        $page = $request->page;
        $unsplash_images = Cache::remember('unsplash_images-'.$page, 3600, function () use ($page) {
            $url = 'https://api.unsplash.com/photos?per_page=20&page=' . $page;
            $headers = [  
                'Content-Type' => 'application/json',
                'Authorization' => 'Client-ID '. $this->unsplash_client_id(), 
            ];
            return $this->GETAPI($url,$headers);
        });   
        return view('magico.integrations.unsplash',compact('unsplash_images'));
    }

    public function unsplash_query_images(Request $request){
        $page = $request->page;
        $search = $request->search; 
        
        $unsplash_images = Cache::remember('unsplash_images-' . $page . '-' . $search , 3600, function () use ($page,$search) {
            $url = 'https://api.unsplash.com/search/photos?per_page=20&page=' . $page . '&query='. $search;
            $headers = [  
                'Content-Type' => 'application/json',
                'Authorization' => 'Client-ID '. $this->unsplash_client_id(), 
            ];
            
            return $this->GETAPI($url,$headers)->results;
        });   
        return view('magico.integrations.unsplash',compact('unsplash_images'));
    }
    public function pixabay_loading_images(Request $request){
        $page = $request->page;
        $search = $request->search; 
        
        $pixabay_images = Cache::remember('pixabay_images-' . $page . '-' . $search , 3600, function () use ($page,$search) {
            $url = 'https://pixabay.com/api/?key='.$this->pixaby_key() . '&' . '?per_page=20&page=' . $page . '&q='. $search ;
            $headers = [  
                'Content-Type' => 'application/json', 
            ];
            return $this->GETAPI($url,$headers)->hits;
        });   
        return view('magico.integrations.pixabay',compact('pixabay_images'));
    }

    public function iconscout_loading_images(Request $request){ 
        $search = $request->search; 
        
        $url = 'https://api.iconscout.com' . $request->page_url . "&query=" . $search;

        $iconscout_images = Cache::remember($url , 3600, function () use ($url) {
            $headers = [  
                'Content-Type' => 'application/json', 
                'Client-ID' => $this->iconscout_client_id(), 
            ];
            return $this->GETAPI($url,$headers)->response->items; 
        });     
        return view('magico.integrations.iconscout',compact('iconscout_images'));
    }

    public function pexels_loading_images(Request $request){  
        $url = $request->page_url;
        
        $pexels_images = Cache::remember($url , 3600, function () use ($url) {
            $headers = [  
                'Content-Type' => 'application/json', 
                'Authorization' => $this->pexels_key(), 
            ];
            return  $this->GETAPI($url,$headers);  
        });     
        return view('magico.integrations.pexels',compact('pexels_images'));
    }

    public function upload_magico_images(Request $request){
        $user = Auth::user(); 
        if($user){
            if($request->hasFile('image')){
                $image = $user->addMedia($request->image)->toMediaCollection('magico_images'); 
                return view('magico.partials.uploaded_images',compact('image'));
            }
        }else{
            return 0;
        } 
    }

    public function delete_upload_magico_images(Request $request){
        $media = Media::findOrFail($request->id);
        $media->delete();
        return 1;
    }

}
