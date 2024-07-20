<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'region',
        'postal_code',
        'birthday',
        'image',
        'user_id'
    ];
}
