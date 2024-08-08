<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [
        "code",
        "name",
        "description"
    ];

    public function Product() 
    {
        return $this->hasMany(Product::class);
    }

}