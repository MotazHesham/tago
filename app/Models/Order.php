<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'Pending',
        'on_review'   => 'on Review',
        'on_delivery' => 'on Delivery',
        'delivered'   => 'Delivered',
        'delay'       => 'Delay',
        'cancel'      => 'Cancel',
    ];
    public const ORDER_TYPE_SELECT = [
        'normal'     => 'Normal',
        'template' => 'Template', 
    ];

    protected $fillable = [
        'order_num',
        'order_type',
        'first_name',
        'last_name',
        'phone_number',
        'shipping_address',
        'total_price',
        'delivery_status',
        'shipping_cost',
        'country_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class,'order_id');
    }
    public function templates()
    {
        return $this->hasMany(OrderTemplate::class,'order_id');
    }
}
