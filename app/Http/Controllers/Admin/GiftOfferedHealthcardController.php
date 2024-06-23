<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GiftOfferedHealthcardController extends Controller
{
      public function HealthCardgiftOfferedlist()
     {
          $tabledata = Admin::where('id',Auth::guard('admin')->user()->id)->first();
          $getall_sponserdata = Admin::where('sponsor_id',$tabledata->member_id)->count();
          $AdminView = Admin::where('type','!=','admin')->where('type','!=','Sub-Admin')->where('type','!=','Accountant')->get();
        $admins = Admin::where('id','=',Auth::guard('admin')->user()->id)->get();

        return view('admin.gift_offered_healthcard_list')->with(compact('getall_sponserdata','AdminView','tabledata','admins'));
     }
     public function giftoffereduserwisecount($id)
     {
        $tabledata = Admin::where('id',$id)->first();
        $getall_sponserdata = Admin::where('sponsor_id',$tabledata->member_id)->count();

        $count = 0;
      $query = Admin::where('parent_id', $id)->get();
    
        if ($query->toArray() > 0)
        {
            foreach($query->toArray() AS $objChild)
            {
                $count += $this->giftoffereduserwisecount($objChild['id']);
                ++ $count;
            }
        }
        return $count;
      // return view('admin.gift_offered_healthcard_user')->with(compact('getall_sponserdata','tabledata'));
     }
     public function giftoffereduserwise($id)
     {
        $tabledata = Admin::where('id',$id)->first();
        $getall_sponserdata = Admin::where('sponsor_id',$tabledata->member_id)->count();
        $datacount = $this->giftoffereduserwisecount($id);
      return view('admin.gift_offered_healthcard_user')->with(compact('getall_sponserdata','tabledata','datacount'));
     }

     public function giftOfferedlist()
     {
      return view('admin.gift_Offered_List');
     }
}
