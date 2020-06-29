<?php


namespace App\Http\Controllers;


use App\Customers;
use App\Employees;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class StatisticalController extends BaseController
{

    public function getDefault(){
        if (Session::has('sessionLogin')) {
            $countEmployee = count(Employees::all());
            $countCustomer = count(Customers::all());
            $countOrder = count(Orders::all());
            return view('statisticals.index', ['countEmployee' => $countEmployee, 'countCustomer' => $countCustomer, 'countOrder' => $countOrder]);
        }
        else{
            return view('auth.login')->with(['flash_level' => 'result_msg', 'flash_massage' => 'Vui Lòng Đăng Nhập !']);
        }
    }

    public function getStatistical(Request $request){
        if (Session::has('sessionLogin')) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $listOrder = Orders::listOrderStatistical($startDate, $endDate);
            $listCustomer = Customers::listCustomerStatistical($startDate, $endDate);
            return view('statisticals.statisticalDetail', ['listOrder' => $listOrder, 'listCustomer' => $listCustomer]);
        }
        else{
            return view('auth.login')->with(['flash_level' => 'result_msg', 'flash_massage' => 'Vui Lòng Đăng Nhập !']);
        }
    }
}