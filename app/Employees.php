<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employees extends Model
{
    protected $table = 'employees';
    protected $guarded = [];

    public function Branchs(){
        return $this->belongsTo('App\Branchs', 'branch_id');
    }

    public function Oders(){
        return $this->hasMany('App\Orders', 'employee_id');
    }

    public static function getAllEmployee(){
        $allData = Employees::all();
        return $allData;
    }

    public static function getIDEmployee($name){
        $employeeID = DB::table('employees')->where('name', '=', $name)->first();
        return $employeeID->id;
    }

    public static function getNameEmployee($id){
        $employee = DB::table('employees')->where('id', '=', $id)->first();
        return $employee->name;
    }
}