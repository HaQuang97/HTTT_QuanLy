<?php


namespace App\Http\Controllers;


use App\Branchs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BranchController extends BaseController
{
    //    public function __construct()
//    {
//        $this->middleware('auth:web');
//    }

    public function getListBranch()
    {
        $branch = Branchs::orderBy('id', 'ASC')->paginate(10);
        $list_branch = Branchs::getAllBranch();
        return view('branchs.index', ['data' => $branch, 'list_branch' => $list_branch]);
    }

    public function postAddNewBranch(Request $request)
    {
        $branch = new Branchs();
        $branch->name = $request->txtBranchName;
        $branch->address = $request->txtAddressBranch;
        $branch->save();
        return redirect()->route('index-branch');
    }

    public function postEditBranch($id, Request $request)
    {
        $branch = Branchs::find($id);
        $branch->name = $request->txtBranchName;
        $branch->address = $request->txtAddressBranch;
        $branch->save();
        $data = Branchs::orderBy('id', 'ASC')->paginate(10);
        $list_branch = Branchs::getAllBranch();
        return view('branchs.index', ['data' => $data, 'list_branch' => $list_branch])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Chi Nhánh Thành Công !']);

    }

    public function getDeleteBranch($id)
    {
        $branch = Branchs::find($id);
        $branch->delete();
        $data = Branchs::orderBy('id', 'ASC')->paginate(10);
        $list_branch = Branchs::getAllBranch();

        return view('branchs.index', ['data' => $data, 'list_branch' => $list_branch])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Chi Nhánh Thành Công !']);
    }

}