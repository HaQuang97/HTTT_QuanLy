<?php


namespace App\Http\Controllers;


use App\Customers;
use App\Employees;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class StatisticalController extends BaseController
{

    public function getDefault(){
        $countEmployee = count(Employees::all());
        $countCustomer = count(Customers::all());
        $countOrder = count(Orders::all());
        return view('statisticals.index', ['countEmployee'=>$countEmployee, 'countCustomer'=>$countCustomer, 'countOrder'=>$countOrder]);
    }

    public function getStatistical(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $listOrder = Orders::listOrderStatistical($startDate, $endDate);
        $listCustomer = Customers::listCustomerStatistical($startDate, $endDate);
        return view('statisticals.statisticalDetail', ['listOrder'=>$listOrder, 'listCustomer'=>$listCustomer]);
    }
}