<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model 
{
    use HasFactory, SoftDeletes, Auditable; 
    public $table = 'order_product';

    protected $dates = [
        'created_at',
        'updated_at', 
        'deleted_at', 
    ];

    protected $fillable = [
        'quantity',
        'price',
        'total_cost',
        'variant',
        'token',
        'order_id',
        'product_id',
        'scanned_user_id',
        'created_at',
        'updated_at', 
        'deleted_at', 
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'scanned_user_id');
    }
}
