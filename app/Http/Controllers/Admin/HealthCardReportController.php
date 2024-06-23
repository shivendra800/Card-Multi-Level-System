<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HealthCardReportController extends Controller
{
    public function healthcarduser()
    {
        if(Auth::guard('admin')->user()->type == 'admin')
        {
            $tabledata = Admin::where('type','=','Health_card_Customer')->get();
        }
       else
        {
            $tabledata = Admin::where('type','=','Health_card_Customer')->where('sponsor_id',Auth::guard('admin')->user()->id)->get();
        }
        // dd($tabledata);
        return view('admin.report.healthcard_user')->with(compact('tabledata'));
    }
}
