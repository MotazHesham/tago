<?php

namespace App\Http\Resources\V1;

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
        if($this->photo){
            $image = $this->photo->getUrl('preview');
        }else{
            if($this->main_link && $this->main_link->photo){
                $image = $this->main_link->photo->getUrl('preview');
            }else{
                $image = null;
            }
        }
        return [
            'id' => $this->id,
            'priority' => $this->priority,
            'name' => $this->name,
            'photo' => $image,
        ];
    }
}
