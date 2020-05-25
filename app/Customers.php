<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $guarded = [];

    public function Oders(){
        return $this->hasMany('App\Orders', 'customer_id');
    }
}