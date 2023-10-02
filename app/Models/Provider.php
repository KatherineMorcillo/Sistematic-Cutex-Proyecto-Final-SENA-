<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'providers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'business_name',
        'admin_name',
        'cellphone',
        'email',
        'address',
        'status'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
