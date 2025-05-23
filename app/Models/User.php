<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Get all articles by this user
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    
    /**
     * Get published articles by this user
     */
    public function publishedArticles()
    {
        return $this->articles()->where('is_published', 1)->orderBy('publish_time', 'desc');
    }
    
    /**
     * Get draft articles by this user
     */
    public function draftArticles()
    {
        return $this->articles()->where('is_published', 0)->orderBy('updated_at', 'desc');
    }
    
    /**
     * Get profile image URL
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/profiles/' . $this->profile_image);
        }
        
        return asset('images/default-avatar.png');
    }
}