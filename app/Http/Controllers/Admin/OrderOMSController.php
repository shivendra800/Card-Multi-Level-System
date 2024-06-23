<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderOMSController extends Controller
{
    public function Newrequest()
    {
        return view('admin.ecomorder.new_request');
    }
    public function PendingOrder()
    {
        return view('admin.ecomorder.pending_order');
    }
    public function ShippingOrder()
    {
        return view('admin.ecomorder.shipping_order');
    }
    public function dispatchOrder()
    {
        return view('admin.ecomorder.dispatch_order');
    }
    public function deliveryOrder()
    {
        return view('admin.ecomorder.delivery_order');
    }
    public function outfordeliveryOrder()
    {
        return view('admin.ecomorder.out_for_delivery');
    }
    public function undeliveryOrder()
    {
        return view('admin.ecomorder.undelivery');
    }
    public function cancleOrder()
    {
        return view('admin.ecomorder.cancle_order');
    }
}
