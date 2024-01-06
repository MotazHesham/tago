<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;  

class OrderTemplate extends Model 
{
    use HasFactory; 
    public $table = 'order_template';

    protected $dates = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'quantity',
        'price',
        'has_nfc',
        'total_cost',
        'canvas_pages',
        'token',
        'order_id',
        'template_id',
        'scanned_user_id',
        'created_at',
        'updated_at', 
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function template(){
        return $this->belongsTo(Template::class,'template_id')->withTrashed();
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'scanned_user_id');
    }
}
