<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable=[
        'ProductID','UserProduct_id','ProductTitle','ProductType','ProductDescriptions',
        'ImageSource','Price','Stock','ProductStatus','created_at',
        'updated_at'
    ];
}
