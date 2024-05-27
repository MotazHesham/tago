<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAnalysisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $profile_views = 0;
        $link_taps = 0;
        if($request->type == 'today'){
            $profile_views = $this->views()->whereDate('created_at', Carbon::today())->sum('counter');
            $link_taps = $this->link_views()->whereDate('created_at', Carbon::today())->sum('counter');
        }elseif($request->type == 'yesterday'){
            $profile_views = $this->views()->whereDate('created_at', date("Y-m-d", strtotime( '-1 days' ) ))->sum('counter'); 
            $link_taps = $this->link_views()->whereDate('created_at', date("Y-m-d", strtotime( '-1 days' ) ))->sum('counter'); 
        }elseif($request->type == 'this_week'){ 
            $profile_views = $this->views()->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('counter'); 
            $link_taps = $this->link_views()->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->sum('counter'); 
        }elseif($request->type == 'this_month'){ 
            $profile_views = $this->views()->whereMonth('created_at', Carbon::now()->month)->sum('counter'); 
            $link_taps = $this->link_views()->whereMonth('created_at', Carbon::now()->month)->sum('counter'); 
        }
        return [ 
            'profile_views' => +$profile_views,
            'link_taps' => +$link_taps,
            'links' => UserLinksResource::collection($this->userUserLinks()->with('main_link','views')->orderBy('priority','asc')->orderBy('created_at','desc')->get()),
        ];
    }
}
