<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover_image',
        'category_id',
        'user_id',
        'is_published',
        'publish_time',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
        'publish_time' => 'datetime',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get formatted published date
     */
    public function getFormattedDateAttribute()
    {
        if ($this->publish_time) {
            return $this->publish_time instanceof Carbon 
                ? $this->publish_time->format('F d, Y') 
                : Carbon::parse($this->publish_time)->format('F d, Y');
        }
        
        return $this->created_at instanceof Carbon 
            ? $this->created_at->format('F d, Y') 
            : Carbon::parse($this->created_at)->format('F d, Y');
    }

    /**
     * Get reading time estimate
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        
        return $minutes . ' min read';
    }

    /**
     * Get cover image URL
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        return asset('images/default-article-cover.jpg');
    }
    
    /**
     * Increment view count
     */
    public function incrementViewCount()
    {
        $this->views = ($this->views ?? 0) + 1;
        return $this->save();
    }
    
    /**
     * Get formatted publish time
     */
    public function getFormattedPublishTimeAttribute()
    {
        if (!$this->publish_time) {
            return null;
        }
        
        try {
            if (is_string($this->publish_time)) {
                return Carbon::parse($this->publish_time)->format('F j, Y');
            }
            
            return $this->publish_time->format('F j, Y');
        } catch (\Exception $e) {
            return $this->publish_time;
        }
    }
    
    /**
     * Get formatted created time
     */
    public function getFormattedCreatedAtAttribute()
    {
        try {
            if (is_string($this->created_at)) {
                return Carbon::parse($this->created_at)->format('F j, Y');
            }
            
            return $this->created_at->format('F j, Y');
        } catch (\Exception $e) {
            return $this->created_at;
        }
    }
}