<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'article'; // Table name (optional if it follows Laravel conventions)
    
    // Define which fields are fillable (for mass assignment)
    protected $fillable = [
        'user_id', 'package_id', 'category_id', 'country_id', 'company_id', 
        'title', 'author', 'slug', 'content', 'description', 'image', 
        'alt_tag', 'feed', 'most_viewed', 'publish_datetime', 'meta_title', 
        'meta_description', 'meta_keywords', 'press_type', 'status', 'type', 
        'video_url', 'created_by', 'updated_by'
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     // Get the article
     public static function getByUserId($userId)
     {
         return self::where('user_id', $userId)->get();
     }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Optional: Accessor for formatted publish date
    public function getFormattedPublishDateAttribute()
    {
        return $this->publish_datetime->format('F j, Y, g:i a');
    }
}
