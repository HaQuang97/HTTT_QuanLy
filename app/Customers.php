<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    protected $table = 'customers';
    protected $guarded = [];

    public function Oders(){
        return $this->hasMany('App\Orders', 'customer_id');
    }

    public static function getAllCustomer(){
        $data = Customers::all();
        return $data;
    }

    public static function getCustomerID($name, $address, $phone){
        $check_exist = DB::table('customers')->where('name', '=', $name)
                            ->first();
        if ($check_exist == null){
            $object = new Customers();
            $object->name = $name;
            $object->address = $address;
            $object->phone = $phone;
            $object->branch_code = "HN";
            $object->save();
            return $object->id;
        }
        else{
            return $check_exist->id;
        }
    }

    public static function getCustomerByID($id){
        $customer = DB::table('customers')->where('id', '=', $id)->first();
        return $customer;
    }
}