<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getAllOrder(){
        $data = Orders::all();
        return $data;
    }

    public static function getOrderByID($id){
        $data = DB::table('orders')->where('id','=',$id)
                ->first();
        return $data;
    }

    public static function listOrderStatistical($startDate, $endDate){
        if ($startDate < $endDate){
            $result = DB::table('orders')->where('created_at','>=',$startDate)
                ->where('created_at','<=',$endDate)
                ->get();
        }
        else{
            $result = DB::table('orders')->where('created_at','>=',$endDate)
                ->where('created_at','<=',$startDate)
                ->get();
        }

        return $result;
    }
}