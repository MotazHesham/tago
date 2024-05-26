<?php

namespace App\Http\Resources\V1;

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
        return [
            'profile_views' => count($this->views),
            'links' => UserLinksResource::collection($this->userUserLinks()->with('main_link','views')->orderBy('priority','asc')->orderBy('created_at','desc')->get()),
        ];
    }
}
