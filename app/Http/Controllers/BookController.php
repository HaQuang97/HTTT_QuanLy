<?php


namespace App\Http\Controllers;


use App\Books;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class BookController extends BaseController
{

    //    public function __construct()
//    {
//        $this->middleware('auth:web');
//    }

    public function getListBook()
    {
        $book = Books::orderBy('id', 'ASC')->paginate(10);
        $list_book = Books::getAllBook();
        return view('books.index', ['data' => $book, 'list_book' => $list_book]);
    }

    public function postAddNewBook(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'price' => 'required',
//            'description' => 'required',
//            'supplier' => 'required',
//            'status' => 'required',
//            'image' => 'required'
//        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $request->file($image)->storeAs('public/images', $image_name);

        }
        $book = new Books();
        $book->name = $request->txtBookName;
        $book->description = $request->txtDescriptionBook;
        $book->price = $request->txtPriceBook;
        $book->supplier = $request->txtSupplierBook;
        $book->status = $request->txtStatusBook;
//        $book->image = $image_name;
        $book->save();
        return redirect()->route('index-book');
    }

    public function postEditBook($id, Request $request)
    {
        $book = Books::find($id);
        $book->name = $request->txtBookName;
        $book->description = $request->txtDescriptionBook;
        $book->price = $request->txtPriceBook;
        $book->supplier = $request->txtSupplierBook;
        $book->status = $request->txtStatusBook;
        $book->updated_at = time();
        $book->save();
        $data = Books::orderBy('id', 'ASC')->paginate(10);
        $list_book = Books::getAllBook();
        return view('books.index', ['data' => $data, 'list_book' => $list_book])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Thông Tin Sách Thành Công !']);

    }

    public function getDeletebook($id)
    {
        $book = Books::find($id);
        $book->delete();
        $data = Books::orderBy('id', 'ASC')->paginate(10);
        $list_book = Books::getAllBook();

        return view('books.index', ['data' => $data, 'list_book' => $list_book])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Sách Thành Công !']);
    }
}