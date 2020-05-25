<?php


namespace App\Http\Controllers;


use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class EmployeeController extends BaseController
{
    //    public function __construct()
//    {
//        $this->middleware('auth:web');
//    }

    public function getListEmployee()
    {
        $employee = Employees::orderBy('id', 'ASC')->paginate(10);
        $list_employee = Employees::getAllEmployee();
        return view('employees.index', ['data' => $employee, 'list_employee' => $list_employee]);
    }

    public function postAddNewEmployee(Request $request)
    {
        $employee = new Employees();
        $employee->name = $request->txtBranchName;
        $employee->address = $request->txtAddressBranch;
        $employee->save();
        return redirect()->route('index-employee');
    }

    public function postEditEmployee($id, Request $request)
    {
        $employee = Employees::find($id);
        $employee->name = $request->txtBranchName;
        $employee->address = $request->txtAddressBranch;
        $employee->save();
        $data = Employees::orderBy('id', 'ASC')->paginate(10);
        $list_employee = Employees::getAllBranch();
        return view('employees.index', ['data' => $data, 'list_employee' => $list_employee])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Nhân Viên Thành Công !']);

    }

    public function getDeleteEmployee($id)
    {
        $employee = Employees::find($id);
        $employee->delete();
        $employee = Employees::orderBy('id', 'ASC')->paginate(10);
        $list_employee = Employees::getAllBranch();

        return view('employees.index', ['data' => $employee, 'list_employee' => $list_employee])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Nhân Viên Thành Công !']);
    }

}