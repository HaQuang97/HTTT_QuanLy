<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order_details extends Model
{
    protected $table = 'order_details';
    protected $guarded = [];

    public function Orders(){
        return $this->belongsTo('App\Orders', 'order_id');
    }

    public function Books(){
        return $this->belongsTo('App\Books', 'book_id');
    }

    public static function getOrderDetail($id){
        $data = DB::table('order_details')->where('order_id','=',$id)
                ->first();
        return $data;
    }
}