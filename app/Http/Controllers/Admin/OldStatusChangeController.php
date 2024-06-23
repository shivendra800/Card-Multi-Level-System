<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\IssueHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Healthcarddummywallet;
use Illuminate\Support\Facades\Session;

class StatusUpdateHealthCardController extends Controller
{
    public function InactiveHealth()
    {
        $InactiveHealthUser = Admin::where('healthcard_status','==',0)->where('type','=','Health_card_Customer')->get()->toArray();
         return view('admin.hcms.inactive_healthcard_user')->with(compact('InactiveHealthUser'));
    }



    public function updatestatus(Request $request)
    {

        Session::put('page','state-head-hcms');
        $status_id = $request->get('status_id');
        $statuschange=DB::table('admins')->where('id',$status_id)->first();
        $freshid = $statuschange->member_id;//freshid by akash sir code
        $sponsor_id = $statuschange->sponsor_id;
        $authmemberid= Auth::guard('admin')->user()->member_id;
        $admin_dummy_wallet = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $companyid  =  $admin_dummy_wallet->member_id;//companyid by akash sir code

        $admininuser = Admin::where('member_id', $freshid)->first();
        $memberid= $admininuser->member_id; // memberid  by akash sir code
        $custname= $admininuser->name; // custname  by akash sir code
        $custnewid= $admininuser->member_id; // custnewid  by akash sir code
         $timeofgeneration= $admininuser->card_activited_date; // timeofgeneration  by akash sir code

        $admininactive = Admin::where('id', $status_id)->first();
        $issueHealth= IssueHealthCard::where('id',$admininactive->health_card_customer_id)->first();

        $package= $issueHealth->health_card_amount; //package   by akash sir code

        // DB::enableQueryLog();

          $getactivesponsorid = Admin::where('member_id', $statuschange->sponsor_id)->first();

        if ($getactivesponsorid->healthcard_status == 1) {
            if ($admin_dummy_wallet->dummy_wallet >= $issueHealth['total_healthcard_reqistation_amount']) {

                // akash sir code
                  DB::table('admins') ->where('id',$status_id) ->update(array(
                    'healthcard_status'=>$request->get('status'),
                     'card_activited_date'=>date('Y-m-d'),

                 ));
                 DB::table('create_health_card')
                 ->where('id', $admininactive->health_card_customer_id)
                 ->update(array(
                     'healthcard_status'=>$request->get('status'),
                     'card_activited_date'=>date('Y-m-d'),
                 ));
               //    if auth ki member id and sponsor id same h to is condition me ni jayega qki yha se hme lastinserted id ni mil payegi
               if($sponsor_id != $authmemberid)
               {
                 if($freshid != $companyid)
                 {


                  $aa = 1;
                  while ($memberid != $companyid)
                  {


                     if($aa == 1)
                     {

                        //  $amount = ( 10 * $package)/100;
                        //  $remainng_amount =$package-$amount;
                         $amount = ( 10 * $package)/100;
                         $percentage = 10;
                     }

                     if($aa == 2)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount =$remainng_amount1-$amount;
                        //   $percentage = 5;

                        $amount = ( 5 * $package)/100;
                        $percentage = 5;


                     }
                     elseif($aa == 3)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount =$remainng_amount2-$amount;
                        //   $percentage = 3;
                        $amount = ( 3 * $package)/100;
                        $percentage = 3;


                     }
                     elseif($aa == 4)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount =$remainng_amount3-$amount;
                        //   $percentage = 2;
                        $amount = ( 2 * $package)/100;
                        $percentage = 2;


                     }
                     elseif($aa == 5)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount =$remainng_amount4-$amount;
                        //   $percentage = 1;

                        $amount = ( 1 * $package)/100;
                        $percentage = 1;

                     }
                     elseif($aa == 6)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount =$remainng_amount5-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;


                     }
                     elseif($aa == 7)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount =$remainng_amount6-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;


                     }
                     elseif($aa == 8)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount =$remainng_amount7-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;


                     }
                     elseif($aa == 9)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount =$remainng_amount8-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;


                     }
                     elseif($aa == 10)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount =$remainng_amount9-$amount;
                        //   $percentage = 0.5;

                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;



                     }
                     elseif($aa == 11)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount10 = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount10 =$remainng_amount9-$amount10;
                          

                        //   $amount = ( 0.5 * $remainng_amount10)/100;
                        //   $remainng_amount =$remainng_amount10-$amount;
                        //   $percentage = 0.5;

                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;



                     }
                     elseif($aa == 12)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount10 = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount10 =$remainng_amount9-$amount10;
                          

                        //   $amount11 = ( 0.5 * $remainng_amount10)/100;
                        //   $remainng_amount11 =$remainng_amount10-$amount11;
                         

                        //   $amount = ( 0.5 * $remainng_amount11)/100;
                        //   $remainng_amount =$remainng_amount11-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;



                     }
                     elseif($aa == 13)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount10 = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount10 =$remainng_amount9-$amount10;
                          

                        //   $amount11 = ( 0.5 * $remainng_amount10)/100;
                        //   $remainng_amount11 =$remainng_amount10-$amount11;
                         

                        //   $amount12 = ( 0.5 * $remainng_amount11)/100;
                        //   $remainng_amount12 =$remainng_amount11-$amount12;
                          

                        //   $amount = ( 0.5 * $remainng_amount12)/100;
                        //   $remainng_amount =$remainng_amount12-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;



                     }
                     elseif($aa == 14)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount10 = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount10 =$remainng_amount9-$amount10;
                          

                        //   $amount11 = ( 0.5 * $remainng_amount10)/100;
                        //   $remainng_amount11 =$remainng_amount10-$amount11;
                         

                        //   $amount12 = ( 0.5 * $remainng_amount11)/100;
                        //   $remainng_amount12 =$remainng_amount11-$amount12;
                          

                        //   $amount13 = ( 0.5 * $remainng_amount12)/100;
                        //   $remainng_amount13 =$remainng_amount12-$amount13;
                          

                        //   $amount = ( 0.5 * $remainng_amount13)/100;
                        //   $remainng_amount =$remainng_amount13-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;



                     }
                     elseif($aa == 15)
                     {
                        //   $amount1 = ( 10 * $package)/100;
                        //   $remainng_amount1 =$package-$amount1;

                        //   $amount2 = ( 5 * $remainng_amount1)/100;
                        //   $remainng_amount2 =$remainng_amount1-$amount2;

                        //   $amount3 = ( 3 * $remainng_amount2)/100;
                        //   $remainng_amount3 =$remainng_amount2-$amount3;

                        //   $amount4 = ( 2 * $remainng_amount3)/100;
                        //   $remainng_amount4 =$remainng_amount3-$amount4;

                        //   $amount5 = ( 1 * $remainng_amount4)/100;
                        //   $remainng_amount5 =$remainng_amount4-$amount5;

                        //   $amount6 = ( 0.5 * $remainng_amount5)/100;
                        //   $remainng_amount6 =$remainng_amount5-$amount6;
                          

                        //   $amount7 = ( 0.5 * $remainng_amount6)/100;
                        //   $remainng_amount7 =$remainng_amount6-$amount7;
                           

                        //   $amount8 = ( 0.5 * $remainng_amount7)/100;
                        //   $remainng_amount8 =$remainng_amount7-$amount8;
                        

                        //   $amount9 = ( 0.5 * $remainng_amount8)/100;
                        //   $remainng_amount9 =$remainng_amount8-$amount9;
                         
                        //   $amount10 = ( 0.5 * $remainng_amount9)/100;
                        //   $remainng_amount10 =$remainng_amount9-$amount10;
                          

                        //   $amount11 = ( 0.5 * $remainng_amount10)/100;
                        //   $remainng_amount11 =$remainng_amount10-$amount11;
                         

                        //   $amount12 = ( 0.5 * $remainng_amount11)/100;
                        //   $remainng_amount12 =$remainng_amount11-$amount12;
                          

                        //   $amount13 = ( 0.5 * $remainng_amount12)/100;
                        //   $remainng_amount13 =$remainng_amount12-$amount13;
                          

                        //   $amount14 = ( 0.5 * $remainng_amount13)/100;
                        //   $remainng_amount14 =$remainng_amount13-$amount14;
                          

                        //   $amount = ( 0.5 * $remainng_amount14)/100;
                        //   $remainng_amount =$remainng_amount14-$amount;
                        //   $percentage = 0.5;
                        $amount = ( 0.5 * $package)/100;
                        $percentage = 0.5;


                     }






                     $issueHealthtbl= Admin::where('member_id',$memberid)->first();
                     $introducerid = $issueHealthtbl->sponsor_id;

                    $healthcardtbl= Admin::where('member_id','=',$introducerid)->first();

                      $introid = $healthcardtbl->health_card_customer_id;

                    $introducerid = $healthcardtbl->member_id;
                    $introname = $healthcardtbl->name;
                    $introstatus = $healthcardtbl->healthcard_status;
                    if($introstatus != 0 && $amount>0)
                    {


                      $user['introid'] = $introid;
                      $user['intronewid'] =  $introducerid;
                      $user['introname'] = $introname;
                      $user['rs'] = $amount;
                      $user['date'] = date('d');
                      $user['month'] =  date('m');
                      $user['year'] =  date('Y');
                      $user['status'] = 1;
                      $user['point'] = 5;
                      $user['package'] = $package;
                      $user['remainng_amount'] = 0;
                      $user['nextsunday'] = $timeofgeneration;
                      $user['members'] = $memberid;
                      $user['position'] = $aa ;
                      $user['custid'] = 0;
                      $user['custnewid'] = $custnewid;
                      $user['custname'] =  $custname;
                      $user['paidstatus'] = 1;
                      $user['lastpaiddate'] = $timeofgeneration;
                      $user['percentage'] = $percentage;
                    $lastinsertedID =  DB::table('income2')->insertGetId($user);
                    $lastremainingamount = DB::table('income2')->select('package')->where('id',$lastinsertedID)->first();
                    }

                 //    income level insert in total_withdraw_transection
                 $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$healthcardtbl->id)->first();
                 if($check_inserted_id !=null){
                      $total_healthcard_amount = $check_inserted_id->level_income_value + $amount;
                     //$total_amount =  $total_healthcard_amount + $check_inserted_id->health_card_value;
                      $total_amount = $check_inserted_id->total+$amount;
                     $inser_total_withdraw_trasection = array(
                         'total' =>$total_amount,
                         'level_income_value' => $total_healthcard_amount,
                         'updated_at' => date('Y-m-d H:i:s'),
                         'update_by' => Auth::guard('admin')->user()->id,
                     );
                     DB::table('total_withdraw_trasection')->where('admin_id',$healthcardtbl->id)->update($inser_total_withdraw_trasection);
                 }else{
                         $inser_total_withdraw_trasection = array(
                             'admin_id' =>   $healthcardtbl->id,
                             'health_card_value' => 0,
                             'level_income_value' => $amount,
                             'wallet_total_amount' => 0,
                             'total' => $amount,
                             'created_at' => date('Y-m-d H:i:s'),
                             'created_by' => Auth::guard('admin')->user()->id,
                         );

                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                     }
                 // end income level insert in total_withdraw_transection



                    $memberid=$introducerid;
                    $aa=$aa+1;
                    if ($aa>15)
                    {
                      $memberid=$companyid;
                    }


                  }

                 }



                 // end akash sir code
                 $user = DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
                 $userdata = DB::table('admins')->where('id', $status_id)->first();
                 $findstate = DB::table('states')->where('id', $userdata->state)->first();
                 $finddistrict = DB::table('districts')->where('id', $userdata->district)->first();
                 $findcity = DB::table('cities')->where('id', $userdata->city)->first();
                 $find_dist_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'district-head-hcms']])->first();
                 $find_state_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'state-head-hcms']])->first();
                 $find_city_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'city-head-hcms']])->first();
                 $find_healthcard_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'Health_card_Customer']])->first();

                 $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $issueHealth['total_healthcard_reqistation_amount'];
                 $healthcardummyWalletHis = new  Healthcarddummywallet;

                 $healthcardummyWalletHis->created_by= $userdata->id;
                 $healthcardummyWalletHis->user_id= $userdata->id;
                 $healthcardummyWalletHis->admin_name= Auth::guard('admin')->user()->name;
                 $healthcardummyWalletHis->Health_card_user_name= $userdata->name;
                 $healthcardummyWalletHis->deducted_amount= $issueHealth['total_healthcard_reqistation_amount'];
                 $healthcardummyWalletHis->reaming_amount=  $new_dummy_wallet;
                 $healthcardummyWalletHis->healthcard_status_updated_by=  Auth::guard('admin')->user()->id;
                // dd($healthcardummyWalletHis);
                 $healthcardummyWalletHis->save();

                 // save data in wallet_

                 if ($user->type == 'admin') {
                     $data_wallet = array(
                         'select_refer_user_type' =>  'Admin',

                         'health_card_amount' =>  $lastremainingamount->package,
                         'admin_transfered_amt' =>  $lastremainingamount->package,
                         'admin_percentage' => '100',

                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'Health Card Created by Admin ' . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                 }
                 if ($user->type == 'state-head-hcms') {
                     $health_card_amount = $lastremainingamount->package;
                     $commisssion_referred_user = $find_state_user->state_commission;
                     $tranfser_amount_to_admin = $health_card_amount - ($health_card_amount * $commisssion_referred_user) / 100;
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user) / 100;

                     $data_wallet = array(
                         'select_refer_user_type' =>  'state-head-hcms',
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,

                         'assign_state' =>  $user->assign_state,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by State Head of' . " " . $findstate->state_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,
                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                     //withdrwa  healthcard transection
                                  //   insert data in to total_withdraw_trasection
                                  $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                                  $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                                  $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                                  if($check_inserted_id !=null){
                                       $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                                    //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                                    $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                                      $inser_total_withdraw_trasection = array(
                                          'total' =>$total_amount,
                                          'health_card_value' => $total_healthcard_amount,
                                          'updated_at' => date('Y-m-d H:i:s'),
                                          'update_by' => Auth::guard('admin')->user()->id,
                                      );
                                      DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                                  }else{
                                      $inser_total_withdraw_trasection = array(
                                          'admin_id' => $find_parent_state->id,
                                          'health_card_value' => $tranfser_amount_to_statehead,
                                          'level_income_value' => 0,
                                          'total' => $tranfser_amount_to_statehead,
                                          'created_at' => date('Y-m-d H:i:s'),
                                          'created_by' => Auth::guard('admin')->user()->id,
                                      );
                                      DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                                  }
                     // end withdwar helath card transection
                 }
                 if ($user->type == 'district-head-hcms') {
                     // $health_card_amount = $issueHealth['health_card_amount'];
                     $health_card_amount = $lastremainingamount->package;
                     $commisssion_referred_user_dist = $find_dist_user->district_commission;
                     $commisssion_referred_user_state = $find_dist_user->state_commission;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($health_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $health_card_amount - ($tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'district-head-hcms',
                         // 'health_card_amount' =>  $issueHealth['health_card_amount'],
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,

                         'assign_state' =>  $user->assign_state,
                         'assign_dist' =>  $user->assign_district,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by District Head of' . " " . $finddistrict->district_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                     // district withdra amount
                     $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                     $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                     $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();

                     $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                     if($check_inserted_id !=null){
                      $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                                //  $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                                $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                         $inser_total_withdraw_trasection = array(
                             'total' =>$total_amount,
                             'health_card_value' => $total_healthcard_amount,
                             'updated_at' => date('Y-m-d H:i:s'),
                             'update_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                     }else{
                         $inser_total_withdraw_trasection = array(
                             'admin_id' => $find_parent_district->id,
                             'health_card_value' => $tranfser_amount_to_disthead,
                             'level_income_value' => 0,
                             'total' => $tranfser_amount_to_disthead,
                             'created_at' => date('Y-m-d H:i:s'),
                             'created_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                     }
                          // for state inservtion
                          $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                          if($check_inserted_id !=null){
                              $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                            //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                              $inser_total_withdraw_trasection = array(
                                  'total' =>$total_amount,
                                  'health_card_value' => $total_healthcard_amount,
                                  'updated_at' => date('Y-m-d H:i:s'),
                                  'update_by' => Auth::guard('admin')->user()->id,
                              );
                              DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                          }else{
                              $inser_total_withdraw_trasection = array(
                                  'admin_id' => $find_parent_state->id,
                                  'health_card_value' => $tranfser_amount_to_statehead,
                                  'level_income_value' => 0,
                                  'total' => $tranfser_amount_to_statehead,
                                  'created_at' => date('Y-m-d H:i:s'),
                                  'created_by' => Auth::guard('admin')->user()->id,
                              );
                              DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                          }
                 }

                 if ($user->type == 'city-head-hcms') {

                  $healh_card_amount = $lastremainingamount->package;
                     $commisssion_referred_user_city = $find_city_user->city_commission;
                     $commisssion_referred_user_dist = $find_city_user->district_commission;
                     $commisssion_referred_user_state = $find_city_user->state_commission;
                     // city commission and tranfser_amount
                     $tranfser_amount_to_cityhead = ($healh_card_amount * $commisssion_referred_user_city) / 100;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($healh_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($healh_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $healh_card_amount - ($tranfser_amount_to_cityhead + $tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'city-head-hcms',
                         'health_card_amount' =>  $healh_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'city_percentage' => $commisssion_referred_user_city,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,
                         'city_hcms_trans_amt' =>  $tranfser_amount_to_cityhead,

                         'assign_state' =>  $user->assign_state,
                         'assign_dist' =>  $user->assign_district,
                         'assign_city' =>  $user->assign_city,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by City Head of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );

                     DB::table('wallet_healthcard')->insert($data_wallet);

                     // city----
                     $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                     $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                     $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();
                     $find_parent_city = Admin::where('assign_city',$find_parent_id->city)->where('assign_state',$find_parent_state->assign_state)->where('assign_district',$find_parent_district->assign_district)->first();

                     $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->first();
                     if($check_inserted_id !=null){
                        $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_cityhead;
                        // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_cityhead;
                         $inser_total_withdraw_trasection = array(
                             'total' =>$total_amount,
                             'health_card_value' => $total_healthcard_amount,
                             'updated_at' => date('Y-m-d H:i:s'),
                             'update_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->update($inser_total_withdraw_trasection);
                     }else{
                         $inser_total_withdraw_trasection = array(
                             'admin_id' => $find_parent_city->id,
                             'health_card_value' => $tranfser_amount_to_cityhead,
                             'wallet_total_amount'=>0,
                             'level_income_value' => 0,
                             'total' => $tranfser_amount_to_cityhead,
                             'created_at' => date('Y-m-d H:i:s'),
                             'created_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                     }
                    // for district inservtion
                     $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                     if($check_inserted_id !=null){
                        $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                        // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                         $inser_total_withdraw_trasection = array(
                             'total' =>$total_amount,
                             'health_card_value' => $total_healthcard_amount,
                             'updated_at' => date('Y-m-d H:i:s'),
                             'update_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                     }else{
                         $inser_total_withdraw_trasection = array(
                             'admin_id' => $find_parent_district->id,
                             'health_card_value' => $tranfser_amount_to_disthead,
                             'level_income_value' => 0,
                             'total' => $tranfser_amount_to_disthead,
                             'created_at' => date('Y-m-d H:i:s'),
                             'created_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                     }
                    // for district insertion

                    // For State Start

                    $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                    if($check_inserted_id !=null){
                        $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                        //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                        $inser_total_withdraw_trasection = array(
                            'total' =>$total_amount,
                            'health_card_value' => $total_healthcard_amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'update_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                    }else{
                        $inser_total_withdraw_trasection = array(
                            'admin_id' => $find_parent_state->id,
                            'health_card_value' => $tranfser_amount_to_statehead,
                            'level_income_value' => 0,
                            'total' => $tranfser_amount_to_statehead,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                    }
                 }


                 if ($user->type == 'Health_card_Customer') {
                     $health_card_amount = $lastremainingamount->package;
                     $commisssion_referred_user_healthcard = $find_healthcard_user->healthcard_commission;
                     $commisssion_referred_user_city = $find_healthcard_user->city_commission;
                     $commisssion_referred_user_dist = $find_healthcard_user->district_commission;
                     $commisssion_referred_user_state = $find_healthcard_user->state_commission;
                     // healthcard commission and tranfser_amount
                     $tranfser_amount_to_healthcard = ($health_card_amount * $commisssion_referred_user_healthcard) / 100;
                     // city commission and tranfser_amount
                     $tranfser_amount_to_cityhead = ($health_card_amount * $commisssion_referred_user_city) / 100;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($health_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $health_card_amount - ($commisssion_referred_user_healthcard + $tranfser_amount_to_cityhead + $tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'Health_card_Customer',
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'city_percentage' => $commisssion_referred_user_city,
                         'healthcard_percentage' => $commisssion_referred_user_healthcard,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,
                         'city_hcms_trans_amt' =>  $tranfser_amount_to_cityhead,
                         'healthcard_hcms_trans_amt' =>  $tranfser_amount_to_healthcard,
                         'assign_state' =>  $user->state,
                         'assign_dist' =>  $user->district,
                         'assign_city' =>  $user->city,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by  HealthCard User of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                     // healthcard
                      //   insert data in to total_withdraw_trasection
                            $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                      $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                      $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();
                      $find_parent_city = Admin::where('assign_city',$find_parent_id->city)->where('assign_state',$find_parent_state->assign_state)->where('assign_district',$find_parent_district->assign_district)->first();

                           //Healthcard total_wid start
                                 $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
                           if($check_inserted_id !=null){
                              $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_healthcard;
                            //   $total_amount =  $total_healthcard_amount + $check_inserted_id->level_income_value;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_healthcard;
                               $inser_total_withdraw_trasection = array(
                                   'total' =>$total_amount,
                                   'health_card_value' => $total_healthcard_amount,
                                   'updated_at' => date('Y-m-d H:i:s'),
                                   'update_by' => Auth::guard('admin')->user()->id,
                               );
                               DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->update($inser_total_withdraw_trasection);
                           }else{
                               $inser_total_withdraw_trasection = array(
                                   'admin_id' => Auth::guard('admin')->user()->id,
                                   'health_card_value' => $tranfser_amount_to_healthcard,
                                   'wallet_total_amount'=>0,
                                   'level_income_value' => 0,
                                   'total' => $tranfser_amount_to_healthcard,
                                   'created_at' => date('Y-m-d H:i:s'),
                                   'created_by' => Auth::guard('admin')->user()->id,
                               );
                               DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                           }
                             //healthcard total_wid end
                         //city total_wid start
                                  $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->first();
                         if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_cityhead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_cityhead;
                             $inser_total_withdraw_trasection = array(
                                 'total' =>$total_amount,
                                 'health_card_value' => $total_healthcard_amount,
                                 'updated_at' => date('Y-m-d H:i:s'),
                                 'update_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->update($inser_total_withdraw_trasection);
                         }else{
                             $inser_total_withdraw_trasection = array(
                                 'admin_id' => $find_parent_city->id,
                                 'health_card_value' => $tranfser_amount_to_cityhead,
                                 'wallet_total_amount'=>0,
                                 'level_income_value' => 0,
                                 'total' => $tranfser_amount_to_cityhead,
                                 'created_at' => date('Y-m-d H:i:s'),
                                 'created_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                         }
                           //city total_wid end
                        // for district inservtion
                                $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                         if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                             $inser_total_withdraw_trasection = array(
                                 'total' =>$total_amount,
                                 'health_card_value' => $total_healthcard_amount,
                                 'updated_at' => date('Y-m-d H:i:s'),
                                 'update_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                         }else{
                             $inser_total_withdraw_trasection = array(
                                 'admin_id' => $find_parent_district->id,
                                 'health_card_value' => $tranfser_amount_to_disthead,
                                 'level_income_value' => 0,
                                 'total' => $tranfser_amount_to_disthead,
                                 'created_at' => date('Y-m-d H:i:s'),
                                 'created_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                         }
                        // for district insertion

                        // For State Start
                        $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                        if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                            //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                            $inser_total_withdraw_trasection = array(
                                'total' =>$total_amount,
                                'health_card_value' => $total_healthcard_amount,
                                'updated_at' => date('Y-m-d H:i:s'),
                                'update_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                        }else{
                            $inser_total_withdraw_trasection = array(
                                'admin_id' => $find_parent_state->id,
                                'health_card_value' => $tranfser_amount_to_statehead,
                                'level_income_value' => 0,
                                'total' => $tranfser_amount_to_statehead,
                                'created_at' => date('Y-m-d H:i:s'),
                                'created_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                        }
                        // End Start

                 }
                 // wallet end section here
                 //Dummy wallet Section

                 $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $issueHealth['total_healthcard_reqistation_amount'];
                 Admin::where('id', Auth::guard('admin')->user()->id)->update(['dummy_wallet' => $new_dummy_wallet]);
                 //Dummy wallet Section End


                 //Send Conifirmation Email

               }
               elseif($sponsor_id == $authmemberid){
                 $user = DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
                 $userdata = DB::table('admins')->where('id', $status_id)->first();
                 $findstate = DB::table('states')->where('id', $userdata->state)->first();
                 $finddistrict = DB::table('districts')->where('id', $userdata->district)->first();
                 $findcity = DB::table('cities')->where('id', $userdata->city)->first();
                 $find_dist_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'district-head-hcms']])->first();
                 $find_state_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'state-head-hcms']])->first();
                 $find_city_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'city-head-hcms']])->first();
                 $find_healthcard_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'Health_card_Customer']])->first();

                 $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $issueHealth['total_healthcard_reqistation_amount'];
                 $healthcardummyWalletHis = new  Healthcarddummywallet;

                 $healthcardummyWalletHis->created_by= $userdata->id;
                 $healthcardummyWalletHis->user_id= $userdata->id;
                 $healthcardummyWalletHis->admin_name= Auth::guard('admin')->user()->name;
                 $healthcardummyWalletHis->Health_card_user_name= $userdata->name;
                 $healthcardummyWalletHis->deducted_amount= $issueHealth['total_healthcard_reqistation_amount'];
                 $healthcardummyWalletHis->reaming_amount=  $new_dummy_wallet;
                 $healthcardummyWalletHis->healthcard_status_updated_by=  Auth::guard('admin')->user()->id;
                 // dd($healthcardummyWalletHis);
                 $healthcardummyWalletHis->save();

                 if ($user->type == 'admin') {
                     $data_wallet = array(
                         'select_refer_user_type' =>  'Admin',
                         'health_card_amount' =>  $issueHealth['health_card_amount'],
                         'admin_transfered_amt' =>  $issueHealth['health_card_amount'],
                         'admin_percentage' => '100',
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'Health Card Created by Admin ' . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                 }
                 if ($user->type == 'state-head-hcms') {
                     $health_card_amount = $issueHealth['health_card_amount'];
                     $commisssion_referred_user = $find_state_user->state_commission;
                     $tranfser_amount_to_admin = $health_card_amount - ($health_card_amount * $commisssion_referred_user) / 100;
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user) / 100;

                     $data_wallet = array(
                         'select_refer_user_type' =>  'state-head-hcms',
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,

                         'assign_state' =>  $user->assign_state,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by State Head of' . " " . $findstate->state_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,
                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);

                        //   insert data in to total_withdraw_trasection
                        $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                        $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();

                        $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                        if($check_inserted_id !=null){
                             $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                            $inser_total_withdraw_trasection = array(
                                'total' =>$total_amount,
                                'health_card_value' => $total_healthcard_amount,
                                'updated_at' => date('Y-m-d H:i:s'),
                                'update_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                        }else{
                            $inser_total_withdraw_trasection = array(
                                'admin_id' => $find_parent_state->id,
                                'health_card_value' => $tranfser_amount_to_statehead,
                                'level_income_value' => 0,
                                'total' => $tranfser_amount_to_statehead,
                                'created_at' => date('Y-m-d H:i:s'),
                                'created_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                        }
                 }
                 if ($user->type == 'district-head-hcms') {
                     // $health_card_amount = $issueHealth['health_card_amount'];
                     $health_card_amount = $issueHealth['health_card_amount'];
                     $commisssion_referred_user_dist = $find_dist_user->district_commission;
                     $commisssion_referred_user_state = $find_dist_user->state_commission;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($health_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $health_card_amount - ($tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'district-head-hcms',
                         // 'health_card_amount' =>  $issueHealth['health_card_amount'],
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,

                         'assign_state' =>  $user->assign_state,
                         'assign_dist' =>  $user->assign_district,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by District Head of' . " " . $finddistrict->district_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);

                          // district  insert data in to total_withdraw_trasection
                          $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                          $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                          $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();

                $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                if($check_inserted_id !=null){
                 $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                    $inser_total_withdraw_trasection = array(
                        'total' =>$total_amount,
                        'health_card_value' => $total_healthcard_amount,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'update_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                }else{
                    $inser_total_withdraw_trasection = array(
                        'admin_id' => $find_parent_district->id,
                        'health_card_value' => $total_healthcard_amount,
                        'level_income_value' => 0,
                        'total' => $tranfser_amount_to_disthead,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                }
                     // for state inservtion
                     $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                     if($check_inserted_id !=null){
                         $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                        //  $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                         $inser_total_withdraw_trasection = array(
                             'total' =>$total_amount,
                             'health_card_value' => $total_healthcard_amount,
                             'updated_at' => date('Y-m-d H:i:s'),
                             'update_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                     }else{
                         $inser_total_withdraw_trasection = array(
                             'admin_id' => $find_parent_state->id,
                             'health_card_value' => $tranfser_amount_to_statehead,
                             'level_income_value' => 0,
                             'total' => $tranfser_amount_to_statehead,
                             'created_at' => date('Y-m-d H:i:s'),
                             'created_by' => Auth::guard('admin')->user()->id,
                         );
                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                     }
                 }

                 if ($user->type == 'city-head-hcms') {

                 $healh_card_amount = $issueHealth['health_card_amount'];
                     $commisssion_referred_user_city = $find_city_user->city_commission;
                     $commisssion_referred_user_dist = $find_city_user->district_commission;
                     $commisssion_referred_user_state = $find_city_user->state_commission;
                     // city commission and tranfser_amount
                     $tranfser_amount_to_cityhead = ($healh_card_amount * $commisssion_referred_user_city) / 100;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($healh_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($healh_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $healh_card_amount - ($tranfser_amount_to_cityhead + $tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'city-head-hcms',
                         'health_card_amount' =>  $healh_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'city_percentage' => $commisssion_referred_user_city,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,
                         'city_hcms_trans_amt' =>  $tranfser_amount_to_cityhead,

                         'assign_state' =>  $user->assign_state,
                         'assign_dist' =>  $user->assign_district,
                         'assign_city' =>  $user->assign_city,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by City Head of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );

                     DB::table('wallet_healthcard')->insert($data_wallet);

                                      //   insert data in to total_withdraw_trasection
                                      $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                                      $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                                      $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();
                                      $find_parent_city = Admin::where('assign_city',$find_parent_id->city)->where('assign_state',$find_parent_state->assign_state)->where('assign_district',$find_parent_district->assign_district)->first();

                                      $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->first();
                                      if($check_inserted_id !=null){
                                         $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_cityhead;
                                        //  $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_cityhead;
                                          $inser_total_withdraw_trasection = array(
                                              'total' =>$total_amount,
                                              'health_card_value' => $total_healthcard_amount,
                                              'updated_at' => date('Y-m-d H:i:s'),
                                              'update_by' => Auth::guard('admin')->user()->id,
                                          );
                                          DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->update($inser_total_withdraw_trasection);
                                      }else{
                                          $inser_total_withdraw_trasection = array(
                                              'admin_id' => $find_parent_city->id,
                                              'health_card_value' => $tranfser_amount_to_cityhead,
                                              'wallet_total_amount'=>0,
                                              'level_income_value' => 0,
                                              'total' => $tranfser_amount_to_cityhead,
                                              'created_at' => date('Y-m-d H:i:s'),
                                              'created_by' => Auth::guard('admin')->user()->id,
                                          );
                                          DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                                      }
                                     // for district inservtion
                                      $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                                      if($check_inserted_id !=null){
                                         $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                                        //  $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                                          $inser_total_withdraw_trasection = array(
                                              'total' =>$total_amount,
                                              'health_card_value' => $total_healthcard_amount,
                                              'updated_at' => date('Y-m-d H:i:s'),
                                              'update_by' => Auth::guard('admin')->user()->id,
                                          );
                                          DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                                      }else{
                                          $inser_total_withdraw_trasection = array(
                                              'admin_id' => $find_parent_district->id,
                                              'health_card_value' => $tranfser_amount_to_disthead,
                                              'level_income_value' => 0,
                                              'total' => $tranfser_amount_to_disthead,
                                              'created_at' => date('Y-m-d H:i:s'),
                                              'created_by' => Auth::guard('admin')->user()->id,
                                          );
                                          DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                                      }
                                     // for district insertion

                                     // For State Start
                                     $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                                     if($check_inserted_id !=null){
                                         $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                                        //    $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                                         $inser_total_withdraw_trasection = array(
                                             'total' =>$total_amount,
                                             'health_card_value' => $total_healthcard_amount,
                                             'updated_at' => date('Y-m-d H:i:s'),
                                             'update_by' => Auth::guard('admin')->user()->id,
                                         );
                                         DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                                     }else{
                                         $inser_total_withdraw_trasection = array(
                                             'admin_id' => $find_parent_state->id,
                                             'health_card_value' => $tranfser_amount_to_statehead,
                                             'level_income_value' => 0,
                                             'total' => $tranfser_amount_to_statehead,
                                             'created_at' => date('Y-m-d H:i:s'),
                                             'created_by' => Auth::guard('admin')->user()->id,
                                         );
                                         DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                                     }
                                     // End Start
                 }


                 if ($user->type == 'Health_card_Customer') {
                     $health_card_amount = $issueHealth['health_card_amount'];
                     $commisssion_referred_user_healthcard = $find_healthcard_user->healthcard_commission;
                     $commisssion_referred_user_city = $find_healthcard_user->city_commission;
                     $commisssion_referred_user_dist = $find_healthcard_user->district_commission;
                     $commisssion_referred_user_state = $find_healthcard_user->state_commission;
                     // healthcard commission and tranfser_amount
                     $tranfser_amount_to_healthcard = ($health_card_amount * $commisssion_referred_user_healthcard) / 100;
                     // city commission and tranfser_amount
                     $tranfser_amount_to_cityhead = ($health_card_amount * $commisssion_referred_user_city) / 100;
                     // district commission and tranfser_amount
                     $tranfser_amount_to_disthead = ($health_card_amount * $commisssion_referred_user_dist) / 100;
                     //state commission and tranfser_amount
                     $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user_state) / 100;
                     // admin transfer amount
                     $tranfser_amount_to_admin = $health_card_amount - ($commisssion_referred_user_healthcard + $tranfser_amount_to_cityhead + $tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                     $data_wallet = array(
                         'select_refer_user_type' => 'Health_card_Customer',
                         'health_card_amount' =>  $health_card_amount,
                         'state_percentage' => $commisssion_referred_user_state,
                         'district_percentage' => $commisssion_referred_user_dist,
                         'city_percentage' => $commisssion_referred_user_city,
                         'healthcard_percentage' => $commisssion_referred_user_healthcard,
                         'admin_transfered_amt' => $tranfser_amount_to_admin,
                         'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                         'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,
                         'city_hcms_trans_amt' =>  $tranfser_amount_to_cityhead,
                         'healthcard_hcms_trans_amt' =>  $tranfser_amount_to_healthcard,
                         'assign_state' =>  $user->state,
                         'assign_dist' =>  $user->district,
                         'assign_city' =>  $user->city,
                         'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                         'created_by' => Auth::guard('admin')->user()->id,
                         'remark' => 'HealthCard Created by  HealthCard User of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                     );
                     DB::table('wallet_healthcard')->insert($data_wallet);
                         //   insert data in to total_withdraw_trasection
                         $find_parent_id =  DB::table('admins')->where('id',$status_id)->first();
                         $find_parent_state = Admin::where('assign_state',$find_parent_id->state)->where('assign_district',0)->where('assign_city',0)->first();
                         $find_parent_district = Admin::where('assign_district',$find_parent_id->district)->where('assign_state',$find_parent_state->assign_state)->where('assign_city',0)->first();
                         $find_parent_city = Admin::where('assign_city',$find_parent_id->city)->where('assign_state',$find_parent_state->assign_state)->where('assign_district',$find_parent_district->assign_district)->first();
                           //Healthcard total_wid start
                           $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
                           if($check_inserted_id !=null){
                              $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_healthcard;
                            //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount +  $check_inserted_id->level_income_value;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_healthcard;
                            $inser_total_withdraw_trasection = array(
                                   'total' =>$total_amount,
                                   'health_card_value' => $total_healthcard_amount,
                                   'updated_at' => date('Y-m-d H:i:s'),
                                   'update_by' => Auth::guard('admin')->user()->id,
                               );
                               DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->update($inser_total_withdraw_trasection);
                           }else{
                               $inser_total_withdraw_trasection = array(
                                   'admin_id' => Auth::guard('admin')->user()->id,
                                   'health_card_value' => $tranfser_amount_to_healthcard,
                                   'wallet_total_amount'=>0,
                                   'level_income_value' => 0,
                                   'total' => $tranfser_amount_to_healthcard,
                                   'created_at' => date('Y-m-d H:i:s'),
                                   'created_by' => Auth::guard('admin')->user()->id,
                               );
                               DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                           }
                             //healthcard total_wid end
                         //city total_wid start
                            $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->first();
                         if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_cityhead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_cityhead;
                             $inser_total_withdraw_trasection = array(
                                 'total' =>$total_amount,
                                 'health_card_value' => $total_healthcard_amount,
                                 'updated_at' => date('Y-m-d H:i:s'),
                                 'update_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_city->id)->update($inser_total_withdraw_trasection);
                         }else{
                             $inser_total_withdraw_trasection = array(
                                 'admin_id' => $find_parent_city->id,
                                 'health_card_value' => $tranfser_amount_to_cityhead,
                                 'wallet_total_amount'=>0,
                                 'level_income_value' => 0,
                                 'total' => $tranfser_amount_to_cityhead,
                                 'created_at' => date('Y-m-d H:i:s'),
                                 'created_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                         }
                           //city total_wid end
                        // for district inservtion

                         $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->first();
                         if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_disthead;
                            // $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_disthead;
                             $inser_total_withdraw_trasection = array(
                                 'total' =>$total_amount,
                                 'health_card_value' => $total_healthcard_amount,
                                 'updated_at' => date('Y-m-d H:i:s'),
                                 'update_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_district->id)->update($inser_total_withdraw_trasection);
                         }else{
                             $inser_total_withdraw_trasection = array(
                                 'admin_id' => $find_parent_district->id,
                                 'health_card_value' => $tranfser_amount_to_disthead,
                                 'level_income_value' => 0,
                                 'total' => $tranfser_amount_to_disthead,
                                 'created_at' => date('Y-m-d H:i:s'),
                                 'created_by' => Auth::guard('admin')->user()->id,
                             );
                             DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                         }
                        // for district insertion

                        // For State Start

                        $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->first();
                        if($check_inserted_id !=null){
                            $total_healthcard_amount = $check_inserted_id->health_card_value + $tranfser_amount_to_statehead;
                            //   $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                            $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                            $inser_total_withdraw_trasection = array(
                                'total' =>$total_amount,
                                'health_card_value' => $total_healthcard_amount,
                                'updated_at' => date('Y-m-d H:i:s'),
                                'update_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->where('admin_id',$find_parent_state->id)->update($inser_total_withdraw_trasection);
                        }else{
                            $inser_total_withdraw_trasection = array(
                                'admin_id' => $find_parent_state->id,
                                'health_card_value' => $tranfser_amount_to_statehead,
                                'level_income_value' => 0,
                                'total' => $tranfser_amount_to_statehead,
                                'created_at' => date('Y-m-d H:i:s'),
                                'created_by' => Auth::guard('admin')->user()->id,
                            );
                            DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                        }
                        // End Start
                 }
                 // wallet end section here
                 //Dummy wallet Sect

                 $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $issueHealth['total_healthcard_reqistation_amount'];
                 Admin::where('id', Auth::guard('admin')->user()->id)->update(['dummy_wallet' => $new_dummy_wallet]);
                 //Dummy wallet Section End
                 //Send Conifirmation Email

               }
         } else {
             $message = "Your Dummy wallet Section is Empty! . Contact To Admin/Account";
             return redirect('admin/inactive-healthcard')->with('error_message', $message);
         }
        }else{
            $message = "Your Sponsor ID is not Active yet ,So Plz contact to your sponsor Member!";
             return redirect('admin/inactive-healthcard')->with('error_message', $message);
        }

          // dd(DB::getQueryLog());
        $message = "Health Card Status Is  Updated Sucessfully!.";
        return redirect()->back()->with('success_message', $message);
    }

}
