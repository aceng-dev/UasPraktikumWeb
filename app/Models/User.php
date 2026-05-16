<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
protected $fillable = ['name','email','password','role', 'balance' ];


    public function authoredBooks(){
        return $this->hasMany(Book::class, 'author_id');
    }

    public function publishedBooks(){
        return $this->hasMany(Book::class, 'publisher_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}