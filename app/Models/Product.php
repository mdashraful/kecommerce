<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product){
            $product->slug = Str::slug($product->title);
        }); 
 
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
