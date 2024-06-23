<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WithDrawAmountController extends Controller
{


    public function withdrwawalletamount(Request $request)
    {
       $data = array(
        'witdrarw_amount'=> $request->get('witdrarw_amount'),
        'type' =>'withdrawRequest',
        'total_deduction_withdraw'=>$request->get('total_deduction_withdraw'),
       );
       DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->update($data);
       $withdraw = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
       $data = array(
        'withdraw_request_amount'=> $request->get('witdrarw_amount'),
        'type' =>'withdrawRequest',
        'admin_id' =>Auth::guard('admin')->user()->id,
        'admin_name'=>Auth::guard('admin')->user()->name,
        'admin_type' =>Auth::guard('admin')->user()->type,
        'admin_member_id'=>Auth::guard('admin')->user()->member_id,
         'orangial_amount'=>$withdraw->total,
         'remaing_amount'=>0,
         'withdraw_request_date'=>date('Y-m-d H:i:s'),
         'created_by'=>Auth::guard('admin')->user()->id,
       );
       DB::table('withdraw_history')->insert($data);

       return redirect()->back();
    }

    public function Withdrawrequest()
    {
        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        if($user->type == 'admin')
        {
            $withdrawRequest = DB::table('total_withdraw_trasection')->join('admins','admins.id','total_withdraw_trasection.admin_id')->where('total_withdraw_trasection.type','withdrawRequest')->select('total_withdraw_trasection.*','admins.name as admin_name','admins.member_id')->get();

        }
        else{
            $withdrawRequest = DB::table('total_withdraw_trasection')->join('admins','admins.id','total_withdraw_trasection.admin_id')->where('total_withdraw_trasection.type','withdrawRequest')->select('total_withdraw_trasection.*','admins.name as admin_name','admins.member_id')->where('admin_id',$user->id)->get();
        }


        return view('admin.withdraw.request_withdraw_amount')->with(compact('withdrawRequest'));
    }
    public function approvewithdrawamount($id)
    {

        $getdata=DB::table('total_withdraw_trasection')->where('id',$id)->first();
        $userdata = DB::table('total_withdraw_trasection')->join('admins','admins.id','total_withdraw_trasection.admin_id')->where('total_withdraw_trasection.id',$id)->first();
        $tax_amount = ($getdata->witdrarw_amount * 5 )/100;
         $admin_charges_amount = ($getdata->witdrarw_amount * 5 )/100;
            $updatedamount =  ($getdata->total - ($getdata->witdrarw_amount+$tax_amount+$admin_charges_amount));

        try{
            DB::table('total_withdraw_trasection')->where('id',$id)
              ->update(array(
                'updated_at'=>date('Y-m-d H:i:s'),
                'type'=>'Withdraw Request Approval',
                'witdrarw_amount' => 0,
                'total' => $updatedamount,
            ));

            $data = array(
                'withdraw_request_amount'=> $getdata->witdrarw_amount,
                'type' =>'Withdraw Request Approval',
                'admin_id' =>$getdata->admin_id,
                'admin_name'=>$userdata->name,
                'admin_type' =>$userdata->type,
                'admin_member_id'=>$userdata->member_id,
                 'orangial_amount'=> $getdata->total,
                 'remaing_amount'=>$updatedamount,
                 'withdraw_approvel_date'=>date('Y-m-d H:i:s'),
                 'updated_by'=>Auth::guard('admin')->user()->id,
               );
               DB::table('withdraw_history')->insert($data);
                // insert dara in withdrwa charges table

               $datainsert_inwithdrwachages = array(

                'user_id' =>$getdata->admin_id,
                'user_name'=>$userdata->name,
                 'tax_percentage'=>5,
                 'tax_amount'=>$admin_charges_amount,
                 'admin_charge_perc'=>5,
                 'admin_charge_amount'=>$admin_charges_amount,
                 'created_at'=>date('Y-m-d H:i:s'),
                 'created_by'=>Auth::guard('admin')->user()->id,
               );
               DB::table('withdraw_charges_admin')->insert($datainsert_inwithdrwachages);



        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect()->back()->withError(' Transection withdraw completed');

    }
    public function ApprovelWithdrawSection()
    {
        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        if($user->type == 'admin')
        {
            $withdrawRequestApprovel = DB::table('total_withdraw_trasection')->join('admins','admins.id','total_withdraw_trasection.admin_id')->where('total_withdraw_trasection.type','Withdraw Request Approval')->select('total_withdraw_trasection.*','admins.name as admin_name','admins.member_id')->get();

        }
        else{
            $withdrawRequestApprovel = DB::table('total_withdraw_trasection')->join('admins','admins.id','total_withdraw_trasection.admin_id')->where('total_withdraw_trasection.type','Withdraw Request Approval')->select('total_withdraw_trasection.*','admins.name as admin_name','admins.member_id')->where('admin_id',$user->id)->get();
        }


        return view('admin.withdraw.approve_withdraw_amount')->with(compact('withdrawRequestApprovel'));
    }

    public function WithDrawHistory()
    {
        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        if($user->type == 'admin')
        {
            $withdrawhistroy = DB::table('withdraw_history')->get();

        }
        else{
            $withdrawhistroy = DB::table('withdraw_history')->where('admin_id',$user->id)->get();
        }


        return view('admin.withdraw.withdraw_amount_histroy')->with(compact('withdrawhistroy'));
    }

    public function WithDrawCharges()
    {
        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        if($user->type == 'admin')
        {

            $withdrawChargeshistroy = DB::table('withdraw_charges_admin')->get();


        }
        else{
            $withdrawChargeshistroy = DB::table('withdraw_charges_admin')->where('user_id',$user->id)->get();
        }

        $totalwithdrwatax = DB::table('withdraw_charges_admin')->sum('tax_amount');
        $todaywithdrwatax = DB::table('withdraw_charges_admin')->whereDate('created_at',$todayDate)->sum('tax_amount');
        $thisMonthwithdrwatax = DB::table('withdraw_charges_admin')->whereMonth('created_at',$thisMonth)->sum('tax_amount');
        $thisYearwithdrwatax = DB::table('withdraw_charges_admin')->whereYear('created_at', $thisYear)->sum('tax_amount');

        $totalwithdrawadmincharges = DB::table('withdraw_charges_admin')->sum('admin_charge_amount');
        $todaywithdrawadmincharges = DB::table('withdraw_charges_admin')->whereDate('created_at',$todayDate)->sum('admin_charge_amount');
        $thisMonthwithdrawadmincharges = DB::table('withdraw_charges_admin')->whereMonth('created_at',$thisMonth)->sum('admin_charge_amount');
        $thisYearwithdrawadmincharges = DB::table('withdraw_charges_admin')->whereYear('created_at', $thisYear)->sum('admin_charge_amount');

        return view('admin.withdraw.withdraw_charges')->with(compact('withdrawChargeshistroy','totalwithdrwatax','todaywithdrwatax',
        'thisMonthwithdrwatax','thisMonthwithdrwatax','thisYearwithdrwatax','totalwithdrawadmincharges','todaywithdrawadmincharges',
        'thisMonthwithdrawadmincharges','thisYearwithdrawadmincharges'));
    }

    public function TransferToDummyWallet(Request $request)
    {
        $getdata=DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
        $transferDummyWalletAmount= $getdata->total -  $request->get('witdrarw_amount_dummywallet');
        $data1 = array(
            'witdrarw_amount_dummywallet'=> $request->get('witdrarw_amount_dummywallet'),
            'type' =>'Transfer-to-dummyWalletAmount',
            'total'=>$transferDummyWalletAmount,
           );
           DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->update($data1);
           $withdraw = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
             // this is histroy section start
        $data2 = array(
            'witdrarw_amount_dummywallet'=> $request->get('witdrarw_amount_dummywallet'),
            'type' =>'Transfer-to-dummyWalletAmount',
            'admin_id' =>Auth::guard('admin')->user()->id,
            'admin_name'=>Auth::guard('admin')->user()->name,
            'admin_type' =>Auth::guard('admin')->user()->type,
            'admin_member_id'=>Auth::guard('admin')->user()->member_id,
             'orangial_amount'=>$getdata->total,
             'remaing_amount'=>$transferDummyWalletAmount,
             'witdrarw_amount_dummywallet_date'=>date('Y-m-d H:i:s'),
             'created_by'=>Auth::guard('admin')->user()->id,
           );
           DB::table('withdraw_history')->insert($data2);
             // this is histroy section end

             // dummy wallet to total Amount start
             $AdminsDetails = Admin::where('id',Auth::guard('admin')->user()->id)->first();
             $walletToDummy = $AdminsDetails->dummy_wallet +  $request->get('witdrarw_amount_dummywallet');
           $data3 = array(
                'dummy_wallet' => $walletToDummy,
           );
           DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->update($data3);
                           // dummy wallet to total Amount end

        return redirect()->back();
    }
}
