<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'identity',  
        'password_original',        
        'last_access_ip',
        'last_access_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'last_access_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function($model)
        {
        });
        self::saved(function($model)
        {
        });
        self::updated(function($model)
        {
        });
        self::deleting(function($model)
        {   
            Message::where(['receiver_id' => $model->id, 'receiver_type' => 0])->delete();
            Inquiry::where(['sender_id' => $model->id])->delete();
        });
    }
     public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }   
}
