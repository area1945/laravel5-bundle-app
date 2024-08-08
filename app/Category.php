<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        "code",
        "name",
        "description"
    ];

    public function Products() 
    {
        return $this->belongsToMany(Product::class, "products_categories");
    }

}