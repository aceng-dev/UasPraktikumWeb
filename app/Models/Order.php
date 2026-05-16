<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'total_price', 'status', 'shipping_address'
    ];

    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

   
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
