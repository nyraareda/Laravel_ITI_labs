<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str class
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;
    
    protected $fillable = ['title', 'content'];
    protected $guarded = ['slug'];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->generateSlugFromTitle();
    }

    protected function generateSlugFromTitle()
    {
        $this->setSlugAttribute($this->title);
    }
    
    /**
     * Boot method to generate slug if it's null when retrieved from the database.
     */
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($post) {
            if (is_null($post->slug)) {
                $post->slug = Str::slug($post->title);
                $post->save();
            }
        });
    }
}
