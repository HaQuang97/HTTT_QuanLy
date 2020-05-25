<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $guarded = [];

    public function Oder_details(){
        return $this->hasMany('App\Order_details', 'book_id');
    }
}