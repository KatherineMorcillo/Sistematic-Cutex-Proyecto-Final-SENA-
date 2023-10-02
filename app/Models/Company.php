<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'nit',
        'owner_name',
        'date_fundation',
        'email',
        'address',
        'cellphone',
        'status'
    ];
    protected $dates = [
        'deleted_at',
    ];
}
