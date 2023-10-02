<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'status',
        'category_id'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
