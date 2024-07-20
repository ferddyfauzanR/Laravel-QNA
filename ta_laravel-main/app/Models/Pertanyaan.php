<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $fillable = ['judul', 'images', 'content', 'categories_id', 'user_id'];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Category', 'user_id');
    }

    public function jawaban()
    {
        // return $this->hasMany('App\Jawaban', 'pertanyaan_id');
    }
}
