<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'photo',
        'name',
        'reference',
        'description',
        'stock',
        'price',
        'measure',
        'status',
        'company_id',
        'provider_id',
        'color_id',
        'subcategory_id',
        'user_id'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
