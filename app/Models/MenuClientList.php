<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuClientList extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    protected $appends = [
        'logo',
        'background',
    ];

    public $table = 'menu_client_lists';

    public const FONT_FAMILY_SELECT = [
        "Arial" => "Arial", 
        "cursive" => "Cursive",
        "Courier" => "Courier",  
        "Tahoma" => "Tahoma", 
        "serif" => "Serif", 
        "Rubik" => "Rubik",  
        "Borel" => "Borel", 
        "Cairo" => "Cairo", 
        "Lato" => "Lato", 
        "REM" => "REM", 
        "Inter" => "Inter", 
        "Roboto Mono" => "Roboto Mono", 
        "Oswald" => "Oswald", 
        "Raleway" => "Raleway", 
        "Roboto Slab" => "Roboto Slab", 
        "Handjet" => "Handjet", 
        "Nunito" => "Nunito",  
        "Mukta" => "Mukta", 
        "Edu SA Beginner" => "Edu SA Beginner", 
        "Victor Mono" => "Victor Mono", 
        "Dosis" => "Dosis", 
        "Anton" => "Anton", 
        "Abel" => "Abel", 
        "Dancing Script" => "Dancing Script", 
        "Source Code Pro" => "Source Code Pro", 
        "EB Garamond" => "EB Garamond", 
        "Barlow Condensed" => "Barlow Condensed", 
        "Vina Sans" => "Vina Sans", 
        "Crimson Text" => "Crimson Text", 
        "Pacifico" => "Pacifico", 
        "Teko" => "Teko", 
        "Fjalla One" => "Fjalla One", 
        "IBM Plex Mono" => "IBM Plex Mono", 
        "Arvo" => "Arvo", 
        "Asap" => "Asap", 
        "Caveat" => "Caveat", 
        "Abril Fatface" => "Abril Fatface", 
        "Shadows Into Light" => "Shadows Into Light", 
        "Indie Flower" => "Indie Flower", 
        "Play" => "Play", 
        "Cookie" => "Cookie", 
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'link',
        'title',
        'font_family',
        'font_color',
        'header_color',
        'logo_size',
        'header_size',
        'about_us',
        'facebook',
        'twitter',
        'google',
        'linkedin',
        'tiktok',
        'youtube',
        'instagram',
        'whatsapp',
        'active',
        'menu_client_id',
        'menu_theme_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function categories()
    {
        return $this->belongsToMany(MenuCategory::class);
    }

    public function menu_theme()
    {
        return $this->belongsTo(MenuTheme::class, 'menu_theme_id');
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getBackgroundAttribute()
    {
        $file = $this->getMedia('background')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function menu_client()
    {
        return $this->belongsTo(MenuClient::class, 'menu_client_id');
    }
}
