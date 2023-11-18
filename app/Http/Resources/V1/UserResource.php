<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo ? $this->photo->getUrl() : null,
            'cover' => $this->cover ? $this->cover->getUrl() : null,
            'phone_number' => $this->phone_number,
            'nickname' => $this->nickname,
            'bio' => $this->bio,
            'email_active' => $this->email_active,
            'nickname_active' => $this->nickname_active,
            'bio_active' => $this->bio_active,
            'fcm_token' => $this->fcm_token,
            'profile_link' => route('frontend.user',$this->id),
            'links' => UserLinksResource::collection($this->userUserLinks()->with('main_link')->orderBy('priority','asc')->orderBy('created_at','desc')->get())
        ];
    }
}
