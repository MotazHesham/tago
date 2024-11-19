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
use App\Models\ProfileView;
use App\Models\Review;
use App\Models\Subscribe;
use App\Models\Template;
use App\Models\Tutorial;
use App\Models\User;
use App\Models\UserLink;
use App\Models\UserLinkView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Astrotomic\Vcard\Properties\Email;
use Astrotomic\Vcard\Properties\Gender;
use Astrotomic\Vcard\Properties\Kind;
use Astrotomic\Vcard\Properties\Tel;
use Astrotomic\Vcard\Vcard;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index(){   
        $templates = Template::where('type','business_card')->orderBy('created_at','desc')->take(8)->get();
        $products = Product::orderBy('created_at','desc')->take(8)->get();
        $counted_products = count(Product::get());
        $counted_customers = count(User::where('user_type','customer')->get());
        // $counted_customers = 1000;
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

        if(request()->has('view') && request()->view == 0){   
            return view('frontend.profile',compact('user')); 
        }else{ 
            $view = ProfileView::where('user_id',$user->id)->where('ip' , request()->ip())->whereDate('created_at', Carbon::today())->first();
            if(!$view){ 
                ProfileView::create([
                    'ip' => request()->ip(),
                    'user_id' => $user->id
                ]);
            }else{
                $view->counter += 1;
                $view->save(); 
            }

            return view('frontend.profile',compact('user'));
        }
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

        $view = ProfileView::where('user_id',$user->id)->where('ip' , request()->ip())->whereDate('created_at', Carbon::today())->first();
        if(!$view){ 
            ProfileView::create([
                'ip' => request()->ip(),
                'user_id' => $user->id
            ]);
        }else{
            $view->counter += 1;
            $view->save(); 
        }

        return view('frontend.profile',compact('user'));
    }

    public function tap_link(Request $request){
        $user_link = UserLink::find($request->id);
        $view = UserLinkView::where('user_link_id',$request->id)->where('ip' , request()->ip())->whereDate('created_at', Carbon::today())->first();
        if(!$view){ 
            UserLinkView::create([
                'ip' => request()->ip(),
                'user_link_id' => $request->id,
                'user_id' => $user_link->user_id,
            ]);
        }else{
            $view->counter += 1;
            $view->save(); 
        }
        return true;
    }

    public function save_contact($id){
        $user = User::with(['media','userUserLinks.main_link','userUserLinks' => function($q){
            $q->where('active',1)->orderBy('priority','asc');
        }])->find($id);
        
        $vcard =  Vcard::make() 
        ->fullName($user->name ?? '') 
        ->name($user->name ?? '') 
        ->email($user->email ?? '') 
        ->tel($user->phone_number ?? '', [Tel::HOME, Tel::VOICE]);

        foreach($user->userUserLinks as $userLink){
            $base_url = $userLink->main_link->base_url ?? null;
            $vcard = $vcard->url($base_url ? $base_url . $userLink->link : $userLink->link);
        }  
                
        if($user->photo){
            $vcard = $vcard->photo('data:image/jpeg;base64,'.base64_encode(file_get_contents($user->photo->getUrl())));
        }{ 
            $vcard = $vcard->photo('data:image/jpeg;base64,'.base64_encode(file_get_contents(asset('user.png'))));
        }

        $vcard = $vcard->title($user->nickname ?? ''); 
        if($user->photo){
            $vcard = $vcard->photo('ENCODING=BASE64;TYPE=jpeg:'.base64_encode(file_get_contents($user->photo->getUrl())));
        }else{ 
            $vcard = $vcard->photo('ENCODING=BASE64;TYPE=jpeg:'.base64_encode(file_get_contents(asset('user.png'))));
        }

        return $vcard;
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
