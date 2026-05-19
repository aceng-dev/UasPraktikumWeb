<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['publisher_id', 'author_id','user_id', 'title', 'content', 'summary_ai', 'coverUrl', 'status', 'price', 'stock'];

    public function publisher(){
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function orders(){
        return $this->hasMany(Order::class, 'book_id');
    }
public function getAverageRatingAttribute() {
        return $this->reviews()->avg('rating') ?: 0;
    }
}
