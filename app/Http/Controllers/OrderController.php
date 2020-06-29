<?php


namespace App\Http\Controllers;


use App\Books;
use App\Customers;
use App\Employees;
use App\Order_details;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{
    //    public function __construct()
//    {
//        $this->middleware('auth:web');
//    }

    public function getListOrder()
    {
        $order = Orders::orderBy('id', 'ASC')->paginate(10);
        $list_order= Orders::getAllOrder();
        return view('orders.index', ['data' => $order, 'list_order' => $list_order]);
    }

    public function getAddNewOrder(){
        return view('orders.create');
    }

    public function postAddNewOrder(Request $request)
    {
        $name = $request->employeeName;
        $nameCustomer = $request->customerName;
        $address = $request->address;
        $phone = $request->phone;
        $employeeID = Employees::getIDEmployee($name);
        $customerID = Customers::getCustomerID($nameCustomer, $address, $phone);

        $product = $request->product;
        $quantity = intval($request->quantity);
        $price = intval($request->price);

        $bookID = Books::getBookID($product);

        $order = new Orders();
        $order->employee_id = $employeeID;
        $order->customer_id = $customerID;
        $order->branch_code = "HN";
        $order->total_price	 = $quantity*$price;
        $order->save();

        $orderDetail = new Order_details();
        $orderDetail->quantity=	$quantity;
        $orderDetail->unit_price= $price;
        $orderDetail->book_id=$bookID;
        $orderDetail->order_id= $order->id;
        $orderDetail->branch_code= "HN";
        $orderDetail->save();
        return redirect()->route('index-order');
    }

    public function getEditOrder($id){
        $dataOrder = Orders::getOrderByID($id);
        $nameEmployee = Employees::getNameEmployee($dataOrder->employee_id);
        $customer = Customers::getCustomerByID($dataOrder->customer_id);

        $orderDetail = Order_details::getOrderDetail($id);
        $nameBook = Books::getBookByID($orderDetail->book_id);

        $object = array(
            'id'=>$id,
            'nameEmployee'=>$nameEmployee,
            'nameCustomer'=>$customer->name,
            'addressCustomer'=>$customer->address,
            'phoneCustomer'=>$customer->phone,
            'book'=>$nameBook,
            'quantity'=>$orderDetail->quantity,
            'unitPrice'=>$orderDetail->unit_price,
        );
        return view('orders.update',['data'=>$object]);
    }

    public function postEditOrder($id, Request $request)
    {
        $order = Orders::find($id);
        $name = $request->employeeName;
        $nameCustomer = $request->customerName;
        $address = $request->address;
        $phone = $request->phone;
        $employeeID = Employees::getIDEmployee($name);
        $customerID = Customers::getCustomerID($nameCustomer, $address, $phone);

        $product = $request->product;
        $quantity = intval($request->quantity);
        $price = intval($request->price);

        $bookID = Books::getBookID($product);

        $order->employee_id = $employeeID;
        $order->customer_id = $customerID;
        $order->branch_code = "HN";
        $order->total_price	 = $quantity*$price;
        $order->save();

        $orderDetail = Order_details::find($id);
        $orderDetail->quantity=	$quantity;
        $orderDetail->unit_price= $price;
        $orderDetail->book_id=$bookID;
        $orderDetail->order_id= $order->id;
        $orderDetail->branch_code= "HN";
        $orderDetail->save();
        return redirect()->route('index-order')->with(['flash_level' => 'result_msg', 'flash_massage' => ' Sửa Đơn Hàng Thành Công !']);
    }

    public function getDeleteOrder($id)
    {
        $order = Orders::find($id);
        $order->delete();
        $orderDeatil = Order_details::find($id);
        $orderDeatil->delete();
        $order = Orders::orderBy('id', 'ASC')->paginate(10);
        $list_order= Orders::getAllOrder();
        return redirect()->route('index-order')->with(['flash_level' => 'result_msg', 'flash_massage' => ' Xóa Đơn Hàng Thành Công !']);
    }

    public function getOrderDetail($id){
        $dataOrder = Orders::getOrderByID($id);
        $nameEmployee = Employees::getNameEmployee($dataOrder->employee_id);
        $customer = Customers::getCustomerByID($dataOrder->customer_id);

        $orderDetail = Order_details::getOrderDetail($id);
        $nameBook = Books::getBookByID($orderDetail->book_id);

        $object = array(
            'id'=>$id,
            'nameEmployee'=>$nameEmployee,
            'nameCustomer'=>$customer->name,
            'addressCustomer'=>$customer->address,
            'phoneCustomer'=>$customer->phone,
            'book'=>$nameBook,
            'quantity'=>$orderDetail->quantity,
            'unitPrice'=>$orderDetail->unit_price,
            'totalPrice'=>$orderDetail->unit_price * $orderDetail->quantity,
        );
        return view('orders.orderDetail',['data'=>$object]);
    }
}