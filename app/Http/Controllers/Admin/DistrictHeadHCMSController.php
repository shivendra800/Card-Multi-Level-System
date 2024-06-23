<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Admin;
use App\Models\Accounts;
use App\Models\AdminsRole;
use App\Models\WalletHCMS;
use App\Models\LevelSetting;
use Illuminate\Http\Request;
use App\Models\StateHeadHCMS;
use App\Models\DistrictHeadHCMS;
use App\Models\WalletHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DistrictHeadHCMSController extends Controller
{
    public function index()
    {
        Session::put('page','district-head-hcms');
        $districthead = DistrictHeadHCMS::join('districts','districts.id','=','districtheadhcms.assign_district')->select('districtheadhcms.*','districts.district_name')->get()->toArray();
         $AdminsRoleModuleCount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'district-head-hcms'])->count();
        //  dd($AdminsRoleModuleCount); die;
        if(Auth::guard('admin')->user()->type=="admin"){
            $AdminsRoleModule['view_access']=1;
            $AdminsRoleModule['edit_access']=1;
            $AdminsRoleModule['full_access']=1;
          }else if($AdminsRoleModuleCount==0){
            $message = "This District Head HCMS Feature Is restricted For You. If You Want Access this District Head HCMS Feature. Than Contact To Admin/SubAdmin";
            Session::flash('error_message',$message);
            return redirect('admin/assign-card-customer-list');
           }else{
            $AdminsRoleModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'district-head-hcms'])->first()->toArray();
            // dd($AdminsRoleModule); die;
        }
        return view('admin.hcms.district_head_hcms_list')->with(compact('districthead','AdminsRoleModule'));
    }
    public function create($id=null)
    {
        Session::put('page','district-head-hcms');
        $update_data= DistrictHeadHCMS::find($id);
        $state= DB::table('states')->where('status','1')->get();

        $commission_reqistation_amount= DB::table('commission_reqistation_amount')->where('admin_type','district-head-hcms')->first();
        return view('admin.hcms.add_district_head_hcms')->with(compact('update_data','state','commission_reqistation_amount'));
    }
    public function save(Request $request)
    {
        Session::put('page','district-head-hcms');
            if ($request->isMethod('post')) {
                $data = $request->all();

                $rules =[
                    "name" =>"required",
                    "email" =>"required|email|unique:admins|unique:districtheadhcms",
                    "mobile" =>"required|min:10|numeric",
                    "assign_district" =>"required|unique:districtheadhcms",
                         'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];
                $customMessages =[
                         "name.required" =>"Name is Required",
                         "email.required" =>"Email is Required",
                         "email.unique" =>" Email Already Exists",
                         "mobile.required" =>"Mobile is Required",
                         "mobile.unique" =>" Mobile Number Already Exists",
                         "assign_state.required" =>"Assign State is Required",
                         "assign_district.required" =>"Assign District is Required",
                         "assign_district.unique" =>"Assign District Already Exists",

                ];
                $validator =Validator::make($data,$rules,$customMessages);
                if($validator->fails()){
                    return Redirect::back()->withErrors($validator);
                }

                DB::beginTransaction();
                // insert state-head-hcms Details in state db table
                $district_head_hcms = new DistrictHeadHCMS();
                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/districtheadhcms/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $district_head_hcms->image = $imageName;
                    }
                } else {
                    $district_head_hcms->image = "";
                }
                $spom = 'ID-HCMS-' . rand(3333, 7777);
                $district_head_hcms->name = $data['name'];
                $district_head_hcms->mobile =$data['mobile'];
                $district_head_hcms->email = $data['email'];
                $district_head_hcms->dob = $data['dob'];
                $district_head_hcms->gender = $data['gender'];
                $district_head_hcms->aadhar_no = $data['aadhar_no'];
                $district_head_hcms->pan_no = $data['pan_no'];
                $district_head_hcms->father_name = $data['father_name'];
                $district_head_hcms->referred_by = Auth::guard('admin')->user()->id ;
                $district_head_hcms->assign_by_state = $data['assign_by_state'];
                $district_head_hcms->assign_district = $data['assign_district'];
                $district_head_hcms->state = $data['state'];
                $district_head_hcms->district = $data['district'];
                $district_head_hcms->city = $data['city'];
                $district_head_hcms->street = $data['street'];
                $district_head_hcms->pincode = $data['pincode'];
                $district_head_hcms->country = $data['country'];
                $district_head_hcms->password = bcrypt($data['password']);
                $district_head_hcms->bank_name = $data['bank_name'];
                $district_head_hcms->account_no = $data['account_no'];
                $district_head_hcms->ifsc_code = $data['ifsc_code'];
                $district_head_hcms->account_holder_name = $data['account_holder_name'];
                $district_head_hcms->amount = $data['amount'];
                $district_head_hcms->commission = $data['commission'];
                $district_head_hcms->payment_mode = $data['payment_mode'];
                $district_head_hcms->created_by = Auth::guard('admin')->user()->id ;
                $district_head_hcms->member_id = $spom;
                $district_head_hcms->sponsor_id = Auth::guard('admin')->user()->member_id;
                $district_head_hcms->gst_percentage = $data['gst_percentage'];
                $district_head_hcms->gst_percentage_amount = $data['gst_percentage_amount'];
                $district_head_hcms->total_state_reqistation_amount = $data['total_state_reqistation_amount'];
                $district_head_hcms->status =1;
                $district_head_hcms->save();

                $district_head_hcms_id= DB::getPdo()->lastInsertId();

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

            $admin->type = 'district-head-hcms';
            $admin->state_head_hcms_id = 0;
            $admin->district_head_hcms_id	 = $district_head_hcms_id;
            $admin->reference_code = 'HILCHCMS-00'.$district_head_hcms_id;
            $admin->city_head_hcms_id	 = 0;
            $admin->health_card_customer_id	= 0;
            $admin->district_admin_id	 = 0;
            $admin->delivery_boy_id	 = 0;
            $admin->assign_state = $data['assign_by_state'];
            $admin->assign_district = $data['assign_district'];
            $admin->assign_city = 0;
            $admin->name = $data['name'];
            $admin->mobile =$data['mobile'];
            $admin->email =$data['email'];
            $admin->referred_by =Auth::guard('admin')->user()->id ;
            $admin->commission =$data['commission'];
            $admin->amount =$data['amount'];
            $admin->password =bcrypt($data['password']);
            $admin->created_by = Auth::guard('admin')->user()->id ;
            $admin->parent_id = Auth::guard('admin')->user()->id;
            $admin->member_id = $spom;
            $admin->sponsor_id = Auth::guard('admin')->user()->member_id;
            $admin->status =1;
            $admin->healthcard_status=1;
            $admin->save();

            $admin_id= DB::getPdo()->lastInsertId();
            // Assign Role And Permission to Admin Type User for District assign view Permission only
                        $adminsRole = new AdminsRole;
                        $adminsRole->admin_id = $admin_id;
                        $adminsRole->module = 'city-head-hcms';
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




            $district_head_hcms->reference_code = 'HILCHCMS-00'.$district_head_hcms_id;
             $district_head_hcms->save();



            // wallet section start here
             $user = DB::table('admins')->where('id',Auth::guard('admin')->user()->id )->first();
             $userdata = DB::table('admins')->where('district_head_hcms_id',$district_head_hcms_id )->first();
             $findstate = DB::table('states')->where('id',$userdata->assign_state)->first();
             $finddistrict = DB::table('districts')->where('id',$userdata->assign_district)->first();
             $findcity = DB::table('cities')->where('id',$userdata->assign_city)->first();
             $find_dist_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','district-head-hcms']])->first();
             $find_state_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','state-head-hcms']])->first();
             $find_city_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','city-head-hcms']])->first();
             $find_healthcard_user = DB::table('commission_reqistation_amount')->where([['admin_type','=','Health_card_Customer']])->first();


             if($user->type == 'admin')
             {
              $data_wallet = array(
               'select_refer_user_type' =>  'Admin',
               'registration_amt' =>  $request->get('amount'),
               'admin_transfered_amt' =>  $request->get('amount'),
               'admin_percentage' => '100',
               'selected_referred_user_id' => Auth::guard('admin')->user()->id ,
               'created_by' => Auth::guard('admin')->user()->id,
               'remark' => 'District Created by Admin'." ".'Account of State'.$findstate->state_name." ".'and District of '." ".$finddistrict->district_name." ".'of '.''.$userdata->name." ".'is Now'." ".$userdata->type,

              );
              DB::table('wallet')->insert($data_wallet);
             }
             if($user->type == 'state-head-hcms')
             {
               $registration_amt = $request->get('amount');
               $commisssion_referred_user = $find_dist_user->state_commission;
               $tranfser_amount_to_admin = $registration_amt - ($registration_amt *$commisssion_referred_user )/100 ;
               $tranfser_amount_to_statehead = ($registration_amt *$commisssion_referred_user )/100 ;

               $data_wallet = array(
                   'select_refer_user_type' =>  'state-head-hcms',
                   'registration_amt' =>  $request->get('amount'),
                   'state_percentage' => $commisssion_referred_user,
                   'admin_transfered_amt' => $tranfser_amount_to_admin,
                   'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,

                   'assign_state' =>  $user->assign_state,
                   'selected_referred_user_id' => Auth::guard('admin')->user()->id ,
                   'created_by' => Auth::guard('admin')->user()->id,
                   'remark' => 'District Created by StateHead of'." ".$findstate->state_name." ".'Account of State'.$findstate->state_name." ".'and District of '." ".$finddistrict->district_name." ".'of '.''.$userdata->name." ".'is Now'." ".$userdata->type,
                  );


                  DB::table('wallet')->insert($data_wallet);
                //   insert data in to total_withdraw_trasection
                    $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
                    if($check_inserted_id !=null){

                        $total_Healthcardamount = $check_inserted_id->wallet_total_amount + $tranfser_amount_to_statehead;
                        // $total_amount =  $total_Healthcardamount + $check_inserted_id->health_card_value;
                        $total_amount = $check_inserted_id->total+$tranfser_amount_to_statehead;
                        $inser_total_withdraw_trasection = array(
                            'total' =>$total_amount,
                            'wallet_total_amount' => $total_Healthcardamount,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'update_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->update($inser_total_withdraw_trasection);
                    }else{
                        $inser_total_withdraw_trasection = array(
                            'admin_id' => Auth::guard('admin')->user()->id,
                            'wallet_total_amount' => $tranfser_amount_to_statehead,
                            'health_card_value'=>0,
                            'level_income_value' => 0,
                            'total' => $tranfser_amount_to_statehead,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                    }
             }

           //wallet section end here

            //Send Conifirmation Email
            $email= $data['email'];
            $messageData=[
                'email' =>$data['email'],
                'password' =>$data['password'],
                'name' =>$data['name'],
                'mobile' =>$data['mobile'],
            ];
            Mail::send('emails.district_head_accoun_opening',$messageData,function($message)use($email){
                $message->to($email)->subject('Account Created Mail Of Hello India Life Care For District Head');
            });

                    //   Send  Login Sms
                    // $username = 'HELLOINDIA';
                    // $apiKey = 'AAED2-350A8';
                    // $apiRequest = 'Text';
                    // $numbers = $data['mobile']; // Multiple numbers separated by comma
                    // $sender = 'HILCPL';
                    // $customer = $data['name'];
                    // $email = $data['email'];
                    // $password = $data['password'];
                    // $message = 'Dear'. $customer .'.'.
                    // $sender. 'Dear Customer, Now you are District Head and your membership is started with Hello India Life Care.And Your Email is.'.'. '.$email.'.'.'. and Password is.'.'. '.$password.'.'.'..Now You Can Login To Your Panel.'.
                    // 'HILCPL';
                    // $templateid = "1507165891841356955";
                    // $apiRoute = 'TRANS';
                    // $datas = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$sender."&TemplateID=".$templateid."&message=".$message;
                    // $url = 'http://tagsolutions.in/sms-panel/api/http/index.php?'.$datas;
                    // $url = preg_replace("/ /", "%20", $url);
                    // $response = file_get_contents($url);

            DB::commit();
            $message = "Thanks For Registering as District Head In Hello India Management System.";
            return redirect('admin/district-head-hcms')->with('success_message', $message);
            }
    }
    public function update(Request $request, $id)
    {
        Session::put('page','district-head-hcms');
            $savedata = DistrictHeadHCMS::find($id);

            $data = $request->all();
            if($request->hasFile('image'))
            {
             $file = $request->file('image');
             $ext = $file->getClientOriginalExtension();
             $filename = time().'.'.$ext;
             $file->move('admin_assets/uploads/districtheadhcms/',$filename);
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
        //    $email= $data['email'];
        //    $messageData=[
        //       'email' =>$data['email'],
        //       'password' =>$data['password'],
        //       'name' =>$data['name'],
        //       'mobile' =>$data['mobile'],
        //    ];
        //    Mail::send('emails.district_head_accoun_opening',$messageData,function($message)use($email){
        //        $message->to($email)->subject('Account Updated Mail Of Hello India Life Care For District Head');
        //    });
            $message = " District Head In Hello India Management System Is Updated Successfully!.";
            return redirect('admin/district-head-hcms')->with('success_message', $message);
    }

    public function ChangeStatus(Request $request)
    {

        Session::put('page','district-head-hcms');
        $status_id=$request->get('status_id');

        $statuschange=DB::table('districtheadhcms')
            ->where('id',$status_id)
            ->first();

        DB::table('districtheadhcms')
        ->where('id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        DB::table('admins')
        ->where('district_head_hcms_id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        return redirect('/admin/district-head-hcms')->withErrors([' status Updated successfully ']);
    }
    public function delete($id)
    {
        Session::put('page','district-head-hcms');

        $deleted_data=DB::table('districtheadhcms')->where('id',$id)->first();
        try{
            DB::table('districtheadhcms')->where('id',$id)->delete();
            DB::table('admins')->where('district_head_hcms_id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/district-head-hcms')->withErrors([' Data Deleted successfully ']);
    }
    public function AccountStateHead()
    {


        if(Auth::guard('admin')->user()->type = "district-head-hcms")
        {
            $accountstate = Admin::where('admins.id',Auth::guard('admin')->user()->id)
            ->join('states as stateaddress','stateaddress.id','=','admins.assign_state')
            ->select('admins.*','stateaddress.state_name')
            ->first();

            $wallet = WalletHCMS::join('admins','admins.assign_district','=','wallet.assign_dist')
            ->where('admins.district_head_hcms_id','=',Auth::guard('admin')->user()->district_head_hcms_id)
            ->select('admins.image','admins.name as admin_name','admins.type','admins.district_head_hcms_id',
            'admins.assign_state','admins.assign_district','admins.referred_by','wallet.id','wallet.dist_hcms_trans_amt',
            'wallet.remark','wallet.*')->Paginate(10);


            $walletHealthCard = WalletHealthCard::join('admins','admins.assign_district','=','wallet_healthcard.assign_dist')
            ->where('admins.district_head_hcms_id','=',Auth::guard('admin')->user()->district_head_hcms_id)
            ->select('admins.image','admins.name as admin_name','admins.type','admins.district_head_hcms_id','admins.assign_state',
            'admins.assign_district','admins.referred_by','wallet_healthcard.id','wallet_healthcard.dist_hcms_trans_amt',
            'wallet_healthcard.remark','wallet_healthcard.*')->Paginate(10);

            // state reg wallet
            $regstatewalletamt = WalletHCMS::join('admins','admins.assign_district','=','wallet.assign_dist')->where('admins.district_head_hcms_id','=',Auth::guard('admin')->user()->district_head_hcms_id)->sum('dist_hcms_trans_amt');
            $healthCardWalletstate = WalletHealthCard::join('admins','admins.assign_district','=','wallet_healthcard.assign_dist')->where('admins.district_head_hcms_id','=',Auth::guard('admin')->user()->district_head_hcms_id)->sum('dist_hcms_trans_amt');
            //end hrere
            $totalHealthCardAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('total');
            $totalWalletAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('wallet_total_amount');
            $totalWalletHospitalComiAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('hospital_commision');
            $totalClinicDoctorAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('doctor_commision');
            $totalWalletHealthCardAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('health_card_value');
            $totalHealthCardAmountgetalldata = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();
            $totalClinicPathologyAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('pathology_commision');
        }
        $gettbldatawallet_hospital = DB::table('wallet_hospital')->join('admins','admins.id','wallet_hospital.hospital_id')
        ->join('states','states.id','admins.state')
        ->join('districts','districts.id','admins.district')
        ->where('admins.district','=',Auth::guard('admin')->user()->assign_district)
        ->get();
        $gettbldatawallet_doctor = DB::table('wallet_doctor')->join('admins','admins.id','wallet_doctor.doctor_id')
        ->join('states','states.id','admins.state')
        ->join('districts','districts.id','admins.district')
        ->where('admins.district','=',Auth::guard('admin')->user()->assign_district)
        ->get();
        $gettbldatawallet_pathology = DB::table('wallet_pathologys')->join('admins','admins.id','wallet_pathologys.pathology_id')
        ->join('states','states.id','admins.state')
        ->join('districts','districts.id','admins.district')
        ->where('admins.district','=',Auth::guard('admin')->user()->assign_district)
        ->get();

        return view('admin.hcms.account_districthead_details')->with(compact('totalClinicPathologyAmount','gettbldatawallet_pathology','totalClinicDoctorAmount','gettbldatawallet_doctor','totalWalletHospitalComiAmount','gettbldatawallet_hospital','totalWalletHealthCardAmount','totalWalletAmount','totalHealthCardAmountgetalldata','totalHealthCardAmount','accountstate','regstatewalletamt','healthCardWalletstate','wallet','walletHealthCard'));
    }
    public function AccountdistrictHeadadmin($id)
    {
        if(Auth::guard('admin')->user()->type = "admin")
        {
            $accountstate = DistrictHeadHCMS::join('admins','admins.district_head_hcms_id','districtheadhcms.id')
            ->join('states as stateaddress','stateaddress.id','=','admins.assign_state')
            ->join('districts','districts.id','=','admins.assign_district')
            ->select('districtheadhcms.*','stateaddress.state_name','admins.name as admins_name','admins.type','admins.image','districts.district_name')
            ->find($id);

            $wallet = WalletHCMS::join('admins','admins.assign_district','=','wallet.assign_dist')
            ->where('admins.district_head_hcms_id','=',$id)
            ->select('admins.image','admins.name as admin_name','admins.type','admins.district_head_hcms_id',
            'admins.assign_state','admins.assign_district','admins.referred_by','wallet.id','wallet.dist_hcms_trans_amt',
            'wallet.remark','wallet.*')->Paginate(10);


            $walletHealthCard = WalletHealthCard::join('admins','admins.assign_district','=','wallet_healthcard.assign_dist')
            ->where('admins.district_head_hcms_id','=',$id)
            ->select('admins.image','admins.name as admin_name','admins.type','admins.district_head_hcms_id','admins.assign_state',
            'admins.assign_district','admins.referred_by','wallet_healthcard.id','wallet_healthcard.dist_hcms_trans_amt',
            'wallet_healthcard.remark','wallet_healthcard.*')->Paginate(10);

            // state reg wallet
            $regstatewalletamt = WalletHCMS::join('admins','admins.assign_district','=','wallet.assign_dist')->where('admins.district_head_hcms_id','=',$id)->sum('dist_hcms_trans_amt');
            $healthCardWalletstate = WalletHealthCard::join('admins','admins.assign_district','=','wallet_healthcard.assign_dist')->where('admins.district_head_hcms_id','=',$id)->sum('dist_hcms_trans_amt');
            //end hrere
        }
        return view('admin.hcms.account_districthead_details_admin')->with(compact('accountstate','regstatewalletamt','healthCardWalletstate','wallet','walletHealthCard'));
    }

    public function viewbilldistrict($id)
    {
        $InvoiceData= DistrictHeadHCMS::join('districts as districtsaddress','districtsaddress.id','=','districtheadhcms.assign_district')
        ->join('states','states.id','=','districtheadhcms.state')
        ->join('districts','districts.id','=','districtheadhcms.district')
        ->join('cities','cities.id','=','districtheadhcms.city')
        ->select('districtheadhcms.*','states.state_name','districts.district_name','cities.city_name','districtsaddress.district_name as districtassignnane')->find($id);
        return view('admin.bill.view_bill_district')->with(compact('InvoiceData'));
    }

    public function DistrictInovice()
    {
        $InvoiceData= DistrictHeadHCMS::join('districts as districtsaddress','districtsaddress.id','=','districtheadhcms.assign_district')
        ->join('states','states.id','=','districtheadhcms.state')
        ->join('districts','districts.id','=','districtheadhcms.district')
        ->join('cities','cities.id','=','districtheadhcms.city')
        ->select('districtheadhcms.*','states.state_name','districts.district_name','cities.city_name','districtsaddress.district_name as districtassignnane')->where('member_id',Auth::guard('admin')->user()->member_id)->first();
        return view('admin.bill.view_bill_district')->with(compact('InvoiceData'));
    }
}
