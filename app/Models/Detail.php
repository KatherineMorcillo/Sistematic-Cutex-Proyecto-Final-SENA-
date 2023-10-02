<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'price',
        'stock',
        'subtotal',
        'status',
        'invoice_id',
        'product_id'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
