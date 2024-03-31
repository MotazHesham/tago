<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactuRequest;
use App\Http\Requests\StoreSubscribeRequest;
use App\Models\Connection;
use App\Models\Contactu;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;
use App\Models\Subscribe;
use App\Models\Template;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function index(){   
        $templates = Template::where('type','business_card')->orderBy('created_at','desc')->take(8)->get();
        $products = Product::orderBy('created_at','desc')->take(8)->get();
        $counted_products = count(Product::get());
        $counted_customers = count(User::where('user_type','customer')->get());
        $rates = Review::orderBy('created_at','desc')->take(15)->get();
        $faq_category = FaqCategory::where('category','how_it_work')->first();
        $faq_questions = $faq_category ? FaqQuestion::where('category_id',$faq_category->id)->get() : [];
        $site_settings = get_site_setting();
        return view('frontend.home',compact('products','counted_products','counted_customers','rates','faq_questions','site_settings','templates'));
    }

    public function privacy(){ 
        return view('frontend.privacy'); 
    }

    public function about(){ 
        $site_settings = get_site_setting();
        $faq_category = FaqCategory::where('category','about')->first(); 
        $faq_questions = $faq_category ?  FaqQuestion::where('category_id',$faq_category->id)->get() : []; 
        return view('frontend.about',compact('site_settings','faq_questions')); 
    }

    public function tutorials(){ 
        $tutorials = Tutorial::get();
        return view('frontend.tutorials',compact('tutorials')); 
    }

    public function contact(){ 
        $site_settings = get_site_setting();
        return view('frontend.contact',compact('site_settings')); 
    }

    public function contact_store(StoreContactuRequest $request){
        
        Contactu::create($request->all());

        alert('تم الأرسال وسيتم التواصل معك','','success');
        return redirect()->route('frontend.contact');
    }

    public function subscribe_store(StoreSubscribeRequest $request){
        
        $subscribe = Subscribe::where('email',$request->email)->first();
        if($subscribe){
            alert('أنت مشترك بالفعل','','warning');
            return redirect()->route('home');
        }else{
            $subscribe = Subscribe::create($request->all());
            alert('تم الأشتراك في الخدمة البريدية بنجاح','','success');
            return redirect()->route('home');
        }  
    }
    public function products($categoryId){ 
        $category = ProductCategory::find($categoryId);
        if($category){
            $categoryName = $category->name;
            $meta_title = $category->meta_title;
            $meta_description = $category->meta_description;
            $products = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->paginate(12);
        }else{
            $categoryName = 'All Products';
            $meta_title = 'All Products';
            $meta_description = null;
            $products = Product::orderBy('created_at','desc')->paginate(12);
        }
        return view('frontend.products',compact('products','categoryName','meta_title','meta_description')); 
    }

    public function product($productId){
        $product = Product::findOrFail($productId);
        $faq_category = FaqCategory::where('category','product')->first();
        $faq_questions = $faq_category ? FaqQuestion::where('category_id',$faq_category->id)->get() : [];
        return view('frontend.product',compact('product','faq_questions'));
    }

    public function user($id){ 
        $user = User::with(['media','userUserLinks.main_link','userUserLinks' => function($q){
            $q->where('active',1)->orderBy('priority','asc');
        }])->findOrFail($id);
        if(!$user->active_byqr){
            alert('لم يتم التفعيل حتي الأن','','error');
            return redirect()->route('home');
        }
        return view('frontend.profile',compact('user'));
    }

    public function user_by_token($token){ 

        $orderProduct = OrderProduct::where('token',$token)->first();

        if(!$orderProduct){
            alert('كود غير صحيح','','error');
            return redirect()->route('home');
        } 
        if($orderProduct->scanned_user_id == null){
            alert('لم يتم التفعيل حتي الأن','','error');
            return redirect()->route('home');
        } 
        
        $user = User::with(['media','userUserLinks.main_link','userUserLinks' => function($q){
            $q->where('active',1)->orderBy('priority','asc');
        }])->find($orderProduct->scanned_user_id);
        return view('frontend.profile',compact('user'));
    }

    public function exchange_contact(Request $request){
        Connection::create($request->all()); 
        $user = User::find($request->user_id);
        if($user && $user->fcm_token != null){
            Http::withHeaders([
                'Authorization' => 'key='.config('app.fcm_token_key'),
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "notification" => [
                    "title"=> $request->name,
                    "body" => 'Want To Exchange Contact With You'
                ]
            ]);
        }
        
        return redirect()->back();
    }
}
