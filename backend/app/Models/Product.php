<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'brand_id',
        'category_id',
        'supplier_id',
        'name',
        'code',
        'variant',
        'description',
        'is_show',
        'photo',
        'price'
    ];
}
