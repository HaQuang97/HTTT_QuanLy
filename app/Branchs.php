<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    protected $table = 'branchs';
    protected $guarded = [];

    public function Employees(){
        return $this->hasMany('App\Employees', 'branch_id');
    }

    public static function getAllBranch(){
        $data = Branchs::all();
        return $data;
    }
}