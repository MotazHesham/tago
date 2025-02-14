<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'users';

    protected $appends = [
        'photo',
        'magico_images',
        'cover',
    ];

    public const ACTIVE_SELECT = [
        '0' => 'De Activate',
        '1' => 'Active',
    ];
    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'provider_id',
        'name',
        'email',
        'user_type',
        'phone_number',
        'email_verified_at',
        'password',
        'remember_token',
        'nickname',
        'bio',
        'email_active',
        'nickname_active',
        'bio_active',
        'active_byqr',
        'approved',
        'fcm_token',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    { 
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('preview2')->width(368)->height(232)->keepOriginalImageFormat(); 
    } 

    public function getMagicoImagesAttribute()
    {
        $files = $this->getMedia('magico_images');
        $files->each(function ($item) {
            $item->url       = $item->getUrl(); 
            $item->preview   = $item->getUrl('preview'); 
            $item->preview2   = $item->getUrl('preview2'); 
        });

        return $files;
    }

    public function userUserLinks()
    {
        return $this->hasMany(UserLink::class, 'user_id', 'id');
    }

    public function userConnections()
    {
        return $this->hasMany(Connection::class, 'user_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function views(){
        return $this->hasMany(ProfileView::class, 'user_id', 'id');
    }
    public function link_views(){
        return $this->hasMany(UserLinkView::class, 'user_id', 'id');
    }
    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCoverAttribute()
    {
        $file = $this->getMedia('cover')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    public function company_owner()
    {
        return $this->hasOne(Company::class, 'user_id');
    }
}
