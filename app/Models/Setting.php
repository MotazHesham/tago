<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'settings';

    protected $appends = [
        'supporters',
        'shapes',
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'website_name',
        'description',
        'how_it_work_description',
        'how_it_work',
        'contact_description',
        'email',
        'phone_number',
        'address',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'keywords_seo',
        'author_seo',
        'sitemap_link_seo',
        'description_seo',
        'why_us_en',
        'why_us_ar',
        'our_mission_ar',
        'our_mission_en',
        'privacy_policy_en',
        'privacy_policy_ar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getWhyUsAttribute(){
        
        $why_us = 'why_us_' . app()->getLocale();
        return $this->$why_us;
    }
    public function getOurMissionAttribute(){
        
        $our_mission = 'our_mission_' . app()->getLocale();
        return $this->$our_mission;
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('icon')->width(50)->height(50)->keepOriginalImageFormat(); 
    }

    public function getSupportersAttribute()
    {
        $files = $this->getMedia('supporters');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
    public function getShapesAttribute()
    {
        $files = $this->getMedia('shapes');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview'); 
        });

        return $files;
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->icon   = $file->getUrl('icon');
        }

        return $file;
    }
}
