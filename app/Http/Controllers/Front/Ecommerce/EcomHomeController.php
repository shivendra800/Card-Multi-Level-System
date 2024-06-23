<?php

namespace App\Http\Controllers\Front\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcomHomeController extends Controller
{
    public function ECommerceindex()
    {
           return view('front.Ecommerce.E_Commerce_index');
    }
}
