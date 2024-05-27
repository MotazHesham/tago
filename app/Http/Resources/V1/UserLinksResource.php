<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLinksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $taps = 0;
        if($request->type == 'today'){
            $taps = $this->views()->whereDate('created_at', Carbon::today())->sum('counter'); 
        }elseif($request->type == 'yesterday'){
            $taps = $this->views()->whereDate('created_at', date("Y-m-d", strtotime( '-1 days' ) ))->sum('counter');  
        }elseif($request->type == 'this_week'){ 
            $taps = $this->views()->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('counter'); 
        }elseif($request->type == 'this_month'){ 
            $taps = $this->views()->whereMonth('created_at', Carbon::now()->month)->sum('counter');  
        }
        
        if($this->photo){
            $image = $this->photo->getUrl('preview');
        }else{
            if($this->main_link && $this->main_link->photo){
                $image = $this->main_link->photo->getUrl('preview');
            }else{
                $image = null;
            }
        }
        $base_url = $this->main_link->base_url ?? null;
        return [ 
            'id' => $this->id,
            'priority' => $this->priority,
            'active' => $this->active,
            'name' => $this->name,
            'link' => $this->link ?? '',
            'photo' => $image,
            'taps' => +$taps
        ];
    }
}
