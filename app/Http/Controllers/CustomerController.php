<?php


namespace App\Http\Controllers;


use App\Customers;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
{

    //    public function __construct()
//    {
//        $this->middleware('auth:web');
//    }

    public function getListCustomer()
    {
        $customer = Customers::orderBy('id', 'ASC')->paginate(10);
        $list_customer = Customers::getAllCustomer();
        return view('customers.index', ['data' => $customer, 'list_customer' => $list_customer]);
    }

    public function postAddNewCustomer(Request $request)
    {
        $customer = new Customers();
        $customer->name = $request->txtCustomerName;
        $customer->address = $request->txtAddressCustomer;
        $customer->save();
        return redirect()->route('index-customer');
    }

    public function postEditcustomer($id, Request $request)
    {
        $customer = Customers::find($id);
        $customer->name = $request->txtCustomerName;
        $customer->address = $request->txtAddressCustomer;
        $customer->save();
        $data = Customers::orderBy('id', 'ASC')->paginate(10);
        $list_customer = Customers::getAllcustomer();
        return view('customers.index', ['data' => $data, 'list_customer' => $list_customer])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Chi Nhánh Thành Công !']);

    }

    public function getDeleteCustomer($id)
    {
        $customer = Customers::find($id);
        $customer->delete();
        $data = Customers::orderBy('id', 'ASC')->paginate(10);
        $list_customer = Customers::getAllCustomer();

        return view('customers.index', ['data' => $data, 'list_customer' => $list_customer])->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Chi Nhánh Thành Công !']);
    }

}