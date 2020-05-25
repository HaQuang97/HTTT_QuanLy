<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

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
}