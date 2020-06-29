<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Books extends Model
{
    protected $table = 'books';
    protected $guarded = [];

    public function Oder_details(){
        return $this->hasMany('App\Order_details', 'book_id');
    }

    public static function getAllBook(){
        $data = Books::all();
        return $data;
    }

    public static function getBookID($name){
        $bookID = DB::table('books')->where('name', '=', $name)->first();
        return $bookID->id;
    }

    public static function getBookByID($id){
        $data = DB::table('books')->where('id','=',$id)
            ->first();
        return $data->name;
    }
}