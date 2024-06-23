<?php

namespace App\Http\Controllers\Admin;


use App\Models\Sms;
use App\Models\Menu;
use App\Models\Admin;
use App\Models\Accounts;
use App\Models\AdminsRole;
use App\Models\WalletHCMS;
use App\Models\LevelSetting;
use Illuminate\Http\Request;
use App\Models\StateHeadHCMS;
use App\Models\IssueHealthCard;
use App\Models\WalletHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Healthcarddummywallet;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateHeadHCMSController extends Controller
{
    public function index()
    {
        Session::put('page','state-head-hcms');
              $stateheadhcms = StateHeadHCMS::join('states','states.id','=','stateheadhcmss.assign_state')->select('stateheadhcmss.*','states.state_name')->get()->toArray();
        $AdminsRoleModuleCount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'state-head-hcms'])->count();
        if(Auth::guard('admin')->user()->type=="admin"){
            $AdminsRoleModule['view_access']=1;
            $AdminsRoleModule['edit_access']=1;
            $AdminsRoleModule['full_access']=1;
        }else if($AdminsRoleModuleCount==0){
            $message = "This State Head HCMS Is restricted For You. If You Want Access .This State Head HCMS. Than Contact To Admin/SubAdmin";
            Session::flash('error_message',$message);
            return redirect('admin/create-health-card');
        }else{
            $AdminsRoleModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'state-head-hcms'])->first()->toArray();
        }
        return view('admin.hcms.state_head_hcms_list')->with(compact('stateheadhcms','AdminsRoleModule'));
    }
    public function create($id=null)
    {
        Session::put('page','state-head-hcms');
        $update_data= StateHeadHCMS::find($id);
        $state= DB::table('states')->where('status','1')->get();
        $commission_reqistation_amount= DB::table('commission_reqistation_amount')->where('admin_type','state-head-hcms')->first();

        return view('admin.hcms.add_state_head_hcms')->with(compact('update_data','state','commission_reqistation_amount'));
    }
    public function save(Request $request)
    {
        Session::put('page','state-head-hcms');
            if ($request->isMethod('post')) {
                $data = $request->all();

                $rules =[
                    "name" =>"required",
                    "email" =>"required|email|unique:admins|unique:stateheadhcmss",
                    "mobile" =>"required|min:10|numeric",
                    "assign_state" =>"required|unique:stateheadhcmss",
                ];
                $customMessages =[
                         "name.required" =>"Name is Required",
                         "email.required" =>"Email is Required",
                         "email.unique" =>" Email Already Exists",
                         "mobile.required" =>"Mobile is Required",
                         "assign_state.required" =>"Assign State is Required",
                         "assign_state.unique" =>"Assign State Already Exists",

                ];
                $validator =Validator::make($data,$rules,$customMessages);
                if($validator->fails()){
                    return Redirect::back()->withErrors($validator);
                }

                DB::beginTransaction();
                // insert state-head-hcms Details in state db table
                $state_head_hcms = new StateHeadHCMS();
                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/stateheadhcms/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $state_head_hcms->image = $imageName;
                    }
                } else {
                    $state_head_hcms->image = "";
                }
                $spom = 'ID-HCMS-' . rand(2222, 8888);
                $state_head_hcms->name = $data['name'];
                $state_head_hcms->mobile =$data['mobile'];
                $state_head_hcms->email = $data['email'];
                $state_head_hcms->dob = $data['dob'];
                $state_head_hcms->gender = $data['gender'];
                $state_head_hcms->aadhar_no = $data['aadhar_no'];
                $state_head_hcms->pan_no = $data['pan_no'];
                $state_head_hcms->father_name = $data['father_name'];
                $state_head_hcms->referred_by = Auth::guard('admin')->user()->id ;
                $state_head_hcms->assign_state = $data['assign_state'];
                $state_head_hcms->state = $data['state'];
                $state_head_hcms->district = $data['district'];
                $state_head_hcms->city = $data['city'];
                $state_head_hcms->street = $data['street'];
                $state_head_hcms->pincode = $data['pincode'];
                $state_head_hcms->country = $data['country'];
                $state_head_hcms->password = bcrypt($data['password']);
                $state_head_hcms->bank_name = $data['bank_name'];
                $state_head_hcms->account_no = $data['account_no'];
                $state_head_hcms->ifsc_code = $data['ifsc_code'];
                $state_head_hcms->account_holder_name = $data['account_holder_name'];
                $state_head_hcms->amount = $data['amount'];
                $state_head_hcms->commission = $data['commission'];
                $state_head_hcms->payment_mode = $data['payment_mode'];
                $state_head_hcms->member_id = $spom;
                $state_head_hcms->sponsor_id = Auth::guard('admin')->user()->member_id;
                $state_head_hcms->created_by = Auth::guard('admin')->user()->id ;
                $state_head_hcms->gst_percentage = $data['gst_percentage'];
                $state_head_hcms->gst_percentage_amount = $data['gst_percentage_amount'];
                $state_head_hcms->total_state_reqistation_amount = $data['total_state_reqistation_amount'];
                $state_head_hcms->status =1;
                $state_head_hcms->save();

                $state_head_hcms_id= DB::getPdo()->lastInsertId();

                  // Insert the state-head-hcms Details in Admins Table
            $admin = new Admin;
            if($request->hasFile('image'))
            {
             $file = $request->file('image');
             $ext = $file->getClientOriginalExtension();
             $filename = time().'.'.$ext;
             $file->move('admin_assets/uploads/adminlogin/',$filename);
             $admin->image = $filename;

            }
            $admin->type = 'state-head-hcms';
            $admin->state_head_hcms_id = $state_head_hcms_id;
            $admin->reference_code = 'HILCHCMS-000'.$state_head_hcms_id;
            $admin->district_head_hcms_id	 = 0;
            $admin->city_head_hcms_id	 = 0;
            $admin->health_card_customer_id	= 0;
            $admin->district_admin_id	 = 0;
            $admin->delivery_boy_id	 = 0;
            $admin->assign_state = $data['assign_state'];
            $admin->assign_district = 0;
            $admin->assign_city = 0;
            $admin->name = $data['name'];
            $admin->mobile =$data['mobile'];
            $admin->email =$data['email'];
            $admin->referred_by =Auth::guard('admin')->user()->id ;
            $admin->member_id = $spom;
            $admin->sponsor_id = Auth::guard('admin')->user()->member_id;
            $admin->commission =$data['commission'];
            $admin->amount =$data['amount'];
            $admin->password =bcrypt($data['password']);
            $admin->created_by = Auth::guard('admin')->user()->id ;
            $admin->parent_id = Auth::guard('admin')->user()->id;
            $admin->status =1;
            $admin->healthcard_status=1;
            $admin->save();

            $admin_id= DB::getPdo()->lastInsertId();
// Assign Role And Permission to Admin Type User for District assign view Permission only
            $adminsRole = new AdminsRole;
            $adminsRole->admin_id = $admin_id;
            $adminsRole->module = 'district-head-hcms';
            $adminsRole->view_access = 1;
            $adminsRole->edit_access = 0;
            $adminsRole->full_access = 0;
            $adminsRole->save();

// Assign Role And Permission to Admin Type User for Health Card assign view Permission only
            $adminsRole = new AdminsRole;
            $adminsRole->admin_id = $admin_id;
            $adminsRole->module = 'create-health-card';
            $adminsRole->view_access = 1;
            $adminsRole->edit_access = 0;
            $adminsRole->full_access = 0;
            $adminsRole->save();




            $state_head_hcms->reference_code = 'HILCHCMS-000'.$state_head_hcms_id;

            $state_head_hcms->save();


           // wallet section start here
            $user = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
            $userdata = DB::table('admins')->where('state_head_hcms_id',$state_head_hcms_id )->first();
            $findstate = DB::table('states')->where('id',$userdata->assign_state)->first();
            $finddistrict = DB::table('districts')->where('id',$userdata->assign_district)->first();
            $findcity = DB::table('cities')->where('id',$userdata->assign_city)->first();
            $find_dist_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','district-head-hcms']])->first();
            $find_state_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','state-head-hcms']])->first();
            $find_city_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','city-head-hcms']])->first();
            $find_healthcard_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','Health_card_Customer']])->first();


           //admin create state head
            if($user->type == 'admin')
            {
             $data_wallet = array(
              'select_refer_user_type' =>  'Admin',
              'registration_amt' =>  $request->get('amount'),
              'admin_transfered_amt' =>  $request->get('amount'),
              'admin_percentage' => '100',
              'selected_referred_user_id' => Auth::guard('admin')->user()->id,
              'created_by' => Auth::guard('admin')->user()->id,
              'remark' => ' State Created by Admin '." ".'Account of State'.$findstate->state_name."  ".'of '.''.$userdata->name." ".'is Now'." ".$userdata->type,
             );
             DB::table('wallet')->insert($data_wallet);
            }
            // admin create state head  end here

          //wallet section end here

           //Send Conifirmation Email
            $email= $data['email'];
            $messageData=[
              'email' =>$data['email'],
              'password' =>$data['password'],
              'name' =>$data['name'],
              'mobile' =>$data['mobile'],
            ];
            Mail::send('emails.state_head_accoun_opening',$messageData,function($message)use($email){
                $message->to($email)->subject('Account Created Mail Of Hello India Life Care For State Head');
            });

                //   Send Login Sms
                // $username = 'HELLOINDIA';
                // $apiKey = 'AAED2-350A8';
                // $apiRequest = 'Text';
                // $numbers = $data['mobile']; // Multiple numbers separated by comma
                // $sender = 'HILCPL';
                // $customer = $data['name'];
                // $email = $data['email'];
                // $password = $data['password'];
                // $message = 'Dear'. $customer .'.'.
                // $sender. 'Dear Customer, Now you are State Head and your membership is started with Hello India Life Care.And Your Email is.'.'. '.$email.'.'.'. and Password is.'.'. '.$password.'.'.'..Now You Can Login To Your Panel.'.
                // 'HILCPL';
                // $templateid = "1507165891841356955";
                // $apiRoute = 'TRANS';
                // $datas = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$sender."&TemplateID=".$templateid."&message=".$message;
                // $url = 'http://tagsolutions.in/sms-panel/api/http/index.php?'.$datas;
                // $url = preg_replace("/ /", "%20", $url);
                // $response = file_get_contents($url);

            DB::commit();
            $message = "Thanks For Registering as State Head In Hello India Management System.";
            return redirect('admin/state-head-hcms')->with('success_message', $message);
            }
    }
    public function update(Request $request, $id)
    {
        Session::put('page','state-head-hcms');

            $savedata = StateHeadHCMS::find($id);

            $data = $request->all();
            if($request->hasFile('image'))
            {
             $file = $request->file('image');
             $ext = $file->getClientOriginalExtension();
             $filename = time().'.'.$ext;
             $file->move('admin_assets/uploads/stateheadhcms/',$filename);
             $savedata->image = $filename;

            }
            $savedata->name = $data['name'];
            $savedata->mobile = $data['mobile'];
            $savedata->dob = $data['dob'];
            $savedata->gender = $data['gender'];
            $savedata->aadhar_no = $data['aadhar_no'];
            $savedata->father_name = $data['father_name'];
            $savedata->state = $data['state'];
            $savedata->district = $data['district'];
            $savedata->city = $data['city'];
            $savedata->street = $data['street'];
            $savedata->pincode = $data['pincode'];
            $savedata->country = $data['country'];
            $savedata->status = 1;
            $savedata->save();
              //Send Conifirmation Email
           $email= $data['email'];
           $messageData=[
              'email' =>$data['email'],
              'password' =>$data['password'],
              'name' =>$data['name'],
              'mobile' =>$data['mobile'],
           ];
           Mail::send('emails.state_head_accoun_opening',$messageData,function($message)use($email){
               $message->to($email)->subject('Account Updated Mail Of Hello India Life Care For State Head');
           });
            $message = "State Head In Hello India Management System Is Updated Sucessfully!.";
            return redirect('admin/state-head-hcms')->with('success_message', $message);
    }

    public function ChangeStatus(Request $request)
    {
        Session::put('page','state-head-hcms');
        $status_id=$request->get('status_id');

        $statuschange=DB::table('stateheadhcmss')
            ->where('id',$status_id)
            ->first();

        DB::table('stateheadhcmss')
        ->where('id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        DB::table('admins')
        ->where('state_head_hcms_id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        $message = "State Head In Hello India Management System Status Is  Updated Sucessfully!.";
        return redirect('admin/state-head-hcms')->with('success_message', $message);
    }
    public function delete($id)
    {
        Session::put('page','state-head-hcms');

        $deleted_data=DB::table('stateheadhcmss')->where('id',$id)->first();
        try{
            DB::table('stateheadhcmss')->where('id',$id)->delete();
            DB::table('admins')->where('state_head_hcms_id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/state-head-hcms')->withErrors([' Data Deleted successfully ']);
    }


    public function AccountStateHead()
    {

        if(Auth::guard('admin')->user()->type = "state-head-hcms")
        {
            $accountstate = Admin::where('admins.id',Auth::guard('admin')->user()->id)
            ->join('states as stateaddress','stateaddress.id','=','admins.assign_state')
            ->select('admins.*','stateaddress.state_name')
            ->first();
            $wallet = WalletHCMS::join('admins','admins.assign_state','=','wallet.assign_state')->where('admins.state_head_hcms_id','=',Auth::guard('admin')->user()->state_head_hcms_id)->select('wallet.*','admins.image')->orderby('id', 'desc')->Paginate(10);
            $walletHealthCard = WalletHealthCard::join('admins','admins.assign_state','=','wallet_healthcard.assign_state')->select('wallet_healthcard.*','admins.image')->where('admins.state_head_hcms_id','=',Auth::guard('admin')->user()->state_head_hcms_id)->orderby( 'wallet_healthcard.id','desc')->Paginate(10);
            // state reg wallet
            $regstatewalletamt = WalletHCMS::join('admins','admins.assign_state','=','wallet.assign_state')->where('admins.state_head_hcms_id','=',Auth::guard('admin')->user()->state_head_hcms_id)->sum('state_hcms_trans_amt');
            $healthCardWalletstate = WalletHealthCard::join('admins','admins.assign_state','=','wallet_healthcard.assign_state')->where('admins.state_head_hcms_id','=',Auth::guard('admin')->user()->state_head_hcms_id)->sum('state_hcms_trans_amt');
        }
        $totalHealthCardAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('total');
        $totalWalletAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('wallet_total_amount');
        $totalHospitalAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('hospital_commision');
        $totalClinicDoctorAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('doctor_commision');
        $totalWalletHealthCardAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('health_card_value');
        $totalHealthCardAmountgetalldata = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
        $totalClinicPathologyAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('pathology_commision');
        //end hrere



          $gettbldatawallet_hospital = DB::table('wallet_hospital')->join('admins','admins.id','wallet_hospital.hospital_id')
        ->join('states','states.id','admins.state')
        ->where('admins.state','=',Auth::guard('admin')->user()->assign_state)
        ->get();
        $gettbldatawallet_doctor = DB::table('wallet_doctor')->join('admins','admins.id','wallet_doctor.doctor_id')
        ->join('states','states.id','admins.state')
        ->where('admins.state','=',Auth::guard('admin')->user()->assign_state)
        ->get();
        $gettbldatawallet_pathology = DB::table('wallet_pathologys')->join('admins','admins.id','wallet_pathologys.pathology_id')
        ->join('states','states.id','admins.state')
        ->where('admins.state','=',Auth::guard('admin')->user()->assign_state)
        ->get();


        return view('admin.hcms.account_statehead_details')->with(compact('gettbldatawallet_pathology','totalClinicPathologyAmount','totalClinicDoctorAmount','gettbldatawallet_doctor','totalWalletHealthCardAmount','totalWalletAmount','totalHealthCardAmountgetalldata',
        'totalHealthCardAmount','accountstate','regstatewalletamt','healthCardWalletstate','wallet','walletHealthCard','gettbldatawallet_hospital','totalHospitalAmount'));
    }
    public function AccountStateHeadadmin($id)
    {
        if(Auth::guard('admin')->user()->type = "admin")
        {
            $accountstate = StateHeadHCMS::join('admins','admins.state_head_hcms_id','stateheadhcmss.id')
            ->join('states as stateaddress','stateaddress.id','=','admins.assign_state')
            ->select('stateheadhcmss.*','stateaddress.state_name','admins.name as admins_name','admins.type','admins.image')
            ->find($id);

            $wallet = WalletHCMS::join('admins','admins.assign_state','=','wallet.assign_state')->where('admins.state_head_hcms_id','=',$id)->select('wallet.*','admins.image')->orderby('id', 'desc')->Paginate(10);
            $walletHealthCard = WalletHealthCard::join('admins','admins.assign_state','=','wallet_healthcard.assign_state')->where('admins.state_head_hcms_id','=',$id)->orderby('wallet_healthcard.id', 'desc')->Paginate(10);
            // state reg wallet
            $regstatewalletamt = WalletHCMS::join('admins','admins.assign_state','=','wallet.assign_state')->where('admins.state_head_hcms_id','=',$id)->sum('state_hcms_trans_amt');
            $healthCardWalletstate = WalletHealthCard::join('admins','admins.assign_state','=','wallet_healthcard.assign_state')->where('admins.state_head_hcms_id','=',$id)->sum('state_hcms_trans_amt');
        }
        return view('admin.hcms.account_statehead_details_admin')->with(compact('accountstate','regstatewalletamt','healthCardWalletstate','wallet','walletHealthCard'));
    }

    public function viewbillstate($id)
    {
       $InvoiceData= StateHeadHCMS::join('states as stateaddress','stateaddress.id','=','stateheadhcmss.assign_state')
      ->join('states','states.id','=','stateheadhcmss.state')
      ->join('districts','districts.id','=','stateheadhcmss.district')
      ->join('cities','cities.id','=','stateheadhcmss.city')
      ->select('stateheadhcmss.*','states.state_name','districts.district_name','cities.city_name','stateaddress.state_name as statenameassign')
      ->find($id);
        return view('admin.bill.view_bill_state')->with(compact('InvoiceData'));
    }

    public function stateInovice()
    {
        $InvoiceData= StateHeadHCMS::join('states as stateaddress','stateaddress.id','=','stateheadhcmss.assign_state')
        ->join('states','states.id','=','stateheadhcmss.state')
        ->join('districts','districts.id','=','stateheadhcmss.district')
        ->join('cities','cities.id','=','stateheadhcmss.city')
        ->select('stateheadhcmss.*','states.state_name','districts.district_name','cities.city_name','stateaddress.state_name as statenameassign')
        ->where('member_id',Auth::guard('admin')->user()->member_id)->first();
          return view('admin.bill.view_bill_state')->with(compact('InvoiceData'));
    }




}
