<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'colors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'color_code',
        'status'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
