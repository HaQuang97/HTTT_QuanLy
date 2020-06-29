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
        $list_employee = Employees::all();
        return view('employees.index', ['data' => $employee, 'list_employee' => $list_employee]);
    }

    public function postAddNewEmployee(Request $request)
    {
        $employee = new Employees();
        $employee->name = $request->txtEmployeeName;
        $employee->email = $request->txtEmail;
        $employee->role = $request->txtRole;
        $employee->address = $request->txtAddressEmployee;
        $employee->branch_id = 1;
        $employee->branch_code = "HN";
        $employee->save();
        return redirect()->route('index-employee');
    }

    public function postEditEmployee($id, Request $request)
    {
        $employee = Employees::find($id);
        $employee->name = $request->txtEmployeeName;
        $employee->email = $request->txtEmail;
        $employee->role = $request->txtRole;
        $employee->address = $request->txtAddressEmployee;
        $employee->updated_at = time();
        $employee->save();
        $data = Employees::orderBy('id', 'ASC')->paginate(10);
        $list_employee = Employees::all();
        return view('employees.index', ['data' => $data, 'list_employee' => $list_employee])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Nhân Viên Thành Công !']);

    }

    public function getDeleteEmployee($id)
    {
        $employee = Employees::find($id);
        $employee->delete();
        $employee = Employees::orderBy('id', 'ASC')->paginate(10);
        $list_employee = Employees::all();

        return view('employees.index', ['data' => $employee, 'list_employee' => $list_employee])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Nhân Viên Thành Công !']);
    }

}