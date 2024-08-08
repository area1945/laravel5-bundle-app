<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Category;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        "brand_id",
        "image",
        "code",
        "stock",
        "price",
        "name",
        "description"
    ];

    public function Brand() 
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function Categories() 
    {
        return $this->belongsToMany(Category::class, "products_categories");
    }

}