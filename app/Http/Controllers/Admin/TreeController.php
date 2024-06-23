<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Tree;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// use App\Models\Admin;

class TreeController extends Controller
{
    
   public function index(){
   $admins = Admin::where('id','=',Auth::guard('admin')->user()->id)->get();
    $allAdmins = Admin::pluck('name','type','parent_id')->where('id','=',Auth::guard('admin')->user()->id)->all();
     
    return view('admin.tree.menuTreeview',compact('admins','allAdmins'));
    }

    public function show()
    {
        $admins = Admin::where('id','=',Auth::guard('admin')->user()->id)->get();
        return view('admin.tree.dynamicMenu',compact('admins'));
    }
    }
