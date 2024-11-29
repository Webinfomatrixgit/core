<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;

    protected $table = 'company'; // Table name (optional if it follows Laravel conventions)
    
    // Define which fields are fillable (for mass assignment)
    protected $fillable = [
        'user_id', 'name', 'slug', 'description', 'email', 
        'phone', 'website', 'city_id', 'state_id', 'country_id', 'logo', 
        'status', 'created_at', 'updated_at', 'user_limit', 'storage_limit','company_name', 'address'
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Optional: Accessor for formatted publish date
    public function getFormattedPublishDateAttribute()
    {
        return $this->publish_datetime->format('F j, Y, g:i a');
    }
}
