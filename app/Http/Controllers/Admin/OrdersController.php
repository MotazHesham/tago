<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    public function delete_product($id){
        $order_product = OrderProduct::findOrFail($id);
        $order_product->delete();
        return redirect()->route('admin.orders.show',$order_product->order_id);
    }
    public function add_product(Request $request){
        $order = Order::find($request->order_id);
        $product = Product::find($request->product_id);
        for($i = 0 ; $i < $request->quantity ; $i++){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,     
                'quantity' => 1,
                'price' => $product->price, 
                'total_cost' => $product->price, 
                'token' => $order->id . generateRandomString(5)
            ]);
        }
        $order->total_price += $product->price * $request->quantity;
        $order->save(); 
        return redirect()->route('admin.orders.show',$order->id);
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::with(['user', 'products'])->select(sprintf('%s.*', (new Order)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_show';
                $editGate      = 'order_edit';
                $deleteGate    = 'order_delete';
                $crudRoutePart = 'orders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('order_num', function ($row) {
                
                if($row->order_type == 'template'){
                    $order_type = '<span class="badge badge-success">Design</span>';
                }else{
                    $order_type = '<span class="badge badge-info">Products</span>';
                } 
                return $row->order_num ? $row->order_num . '<br>' . $order_type : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('shipping_address', function ($row) {
                return $row->shipping_address ? $row->shipping_address : '';
            });
            $table->editColumn('total_price', function ($row) {
                return $row->total_price ? ($row->total_price +$row->shipping_cost) : '';
            });
            $table->editColumn('delivery_status', function ($row) {
                return $row->delivery_status ? Order::DELIVERY_STATUS_SELECT[$row->delivery_status] : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            }); 

            $table->rawColumns(['actions', 'placeholder', 'user', 'order_num']);

            return $table->make(true);
        }

        return view('admin.orders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact( 'users'));
    }

    public function store(StoreOrderRequest $request)
    {
        $code_z = Order::latest()->first()->order_num ?? 0;
        $last_order_code = intval(str_replace('#','',strrchr($code_z,"#")));
        $country = Country::findOrFail($request->country_id);

        $validatedRequest = $request->all();
        $validatedRequest['order_type'] = 'normal'; 
        $validatedRequest['country_id']  = $country->id;   
        $validatedRequest['shipping_cost']  = $country->cost;
        $validatedRequest['order_num'] = 'customer#' . ($last_order_code + 1);
        $order = Order::create($validatedRequest); 

        return redirect()->route('admin.orders.show',$order->id);
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $order->load('user', 'products');

        return view('admin.orders.edit', compact('order', 'users'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $country = Country::findOrFail($request->country_id);
        $validatedRequest = $request->all();
        $validatedRequest['order_type'] = 'normal'; 
        $validatedRequest['country_id']  = $country->id;   
        $validatedRequest['shipping_cost']  = $country->cost; 
        $order->update($validatedRequest); 

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('user', 'products.product','templates.template');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        $orders = Order::find(request('ids'));

        foreach ($orders as $order) {
            $order->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
