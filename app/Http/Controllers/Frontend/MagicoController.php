<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MagicoController extends Controller
{
    public function GETAPI($url,$headers){ 
        $client = new Client();
    
        $response = $client->request('GET', $url, [
            'headers' => $headers,
        ]); 
        // $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        return json_decode($body);
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
    
    public function magico(){ 
        $templates = Cache::remember('templates', 3600, function () { 
            return Template::all();
        });   
        $iconscout_images = Cache::remember('iconscout_images', 3600, function () {
            $url = 'https://api.iconscout.com/v3/search';
            $headers = [  
                'Content-Type' => 'application/json', 
                'Client-ID' => $this->iconscout_client_id(), 
            ];
            return $this->GETAPI($url,$headers)->response->items;
        });     
        $pixabay_images = Cache::remember('pixabay_images', 3600, function () {
            $url = 'https://pixabay.com/api/?key='.$this->pixaby_key();
            $headers = [  
                'Content-Type' => 'application/json', 
            ];
            return $this->GETAPI($url,$headers)->hits;
        });     
        $unsplash_images = Cache::remember('unsplash_images', 3600, function () {
            $url = 'https://api.unsplash.com/photos?per_page=20';
            $headers = [  
                'Content-Type' => 'application/json',
                'Authorization' => 'Client-ID '. $this->unsplash_client_id(), 
            ]; 
            return $this->GETAPI($url,$headers);
        });   
        return view('magico.magico',compact('unsplash_images','pixabay_images','templates','iconscout_images'));
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
        return view('magico.unsplash_images',compact('unsplash_images'));
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
        return view('magico.unsplash_images',compact('unsplash_images'));
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
        return view('magico.pixabay_images',compact('pixabay_images'));
    }

    public function iconscout_loading_images(Request $request){ 
        $search = $request->search; 
        
        $url = 'https://api.iconscout.com' . $request->page_url . "&query=" . $search;
        $headers = [  
            'Content-Type' => 'application/json', 
            'Client-ID' => $this->iconscout_client_id(), 
        ];
        $iconscout_images =  $this->GETAPI($url,$headers)->response->items;  
        return view('magico.iconscout_images',compact('iconscout_images'));
    }

    public function upload_magico_images(Request $request){
        $user = Auth::user(); 
        if($user){
            if($request->hasFile('image')){
                $image = $user->addMedia($request->image)->toMediaCollection('magico_images'); 
                return view('magico.uploaded_images',compact('image'));
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
