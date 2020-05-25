<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function Employees(){
        return $this->belongsTo('App\Employees', 'employee_id');
    }

    public function Customers(){
        return $this->belongsTo('App\Customers', 'customer_id');
    }

    public function Oder_details(){
        return $this->hasMany('App\Order_details', 'order_id');
    }

}