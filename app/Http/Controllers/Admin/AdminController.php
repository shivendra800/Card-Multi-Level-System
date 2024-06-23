<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\AdminsRole;
use App\Models\WalletHCMS;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DummyInvoices;
use App\Models\StateHeadHCMS;
use App\Models\PatientDetails;
use Illuminate\Support\Carbon;
use App\Models\AdminDummyWallet;
use App\Models\WalletHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function actionlogin(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];

        // this is custome meg
        $custommesg = [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',

        ];
        $this->validate($request, $rules, $custommesg);
        $data = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            if (Auth::guard('admin')->user()->type == "Health_card_Customer" && Auth::guard('admin')->user()->healthcard_status == "0") {
                return redirect()->back()->with('error_message', 'Your Account Health Card Status Is Not Active.Please Contant To Admin');
            } else if (Auth::guard('admin')->user()->type != "healthcard_status" && Auth::guard('admin')->user()->status == "0") {
                return redirect()->back()->with('error_message', 'Your Admin Account Is not Active');
            } else {
                return redirect('admin/dashboard');
            }
        } else {
            return redirect()->back()->with('error_message', 'Invalid Email or Password');
        }

    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/logout');
    }
    public function dashboard()
    {
        if(Auth::guard('admin')->user()->type == 'admin')
        {
            return redirect('admin/account-admin');
        }
        if(Auth::guard('admin')->user()->type == 'state-head-hcms')
        {
            return redirect('admin/hcms-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'district-head-hcms')
        {
            return redirect('admin/hcms-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'city-head-hcms')
        {
            return redirect('admin/hcms-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'Health_card_Customer')
        {
            return redirect('admin/hcms-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'Hospital')
        {
            return redirect('admin/hospital-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'Clinic-Doctor')
        {
            return redirect('admin/Doctor-dashboard');
        }
        if(Auth::guard('admin')->user()->type == 'Pathology')
        {
            return redirect('admin/Pathology-Dashboard');
        }
        return view('admin.dashboard');
    }

    public function CheckAdminPassword(Request $request)
    {
        Session::put('page','update-password');
        $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function UpdateAdminPassword(Request $request)
    {
        Session::put('page','update-password');
        if ($request->isMethod('post')) {
            $data = $request->all();
            //check If Current Password enterted by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check if New Password is matching with conifrm Password
                if ($data['confirm_pasword'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Your  Password Is Updated Successfully');
                } else {
                    return redirect()->back()->with('error_message', 'Your New Password is Not Match With Confirm Password');
                }
            } else
                return redirect()->back()->with('error_message', 'Your Current Password Is Incorrect');
        }
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.admins.update_admin_password')->with(compact('adminDetails'));
    }

    public function UpdateAdminDetails(Request $request)
    {
        Session::put('page','update-details');
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
            ];
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin_assets/uploads/adminlogin/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }
            //Admin  Details Update
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['name'], 'mobile' => $data['mobile'],
                'image' => $imageName
            ]);

            return redirect()->back()->with('success_message', 'Admin Details Updated Successfully');
        }

        return view('admin.admins.update_admin_details');
    }

    public function AccountAdmin()
    {


            $wallet = WalletHCMS::orderby('id', 'DESC')->Paginate(10);
            $walletHealthCard = WalletHealthCard::orderby('id', 'DESC')->Paginate(10);
            // state reg wallet
            $totalRegisterAmount = WalletHCMS::sum('registration_amt');
            $regstatewalletamt = WalletHCMS::sum('admin_transfered_amt');
            $toatalHealthCardAmount=WalletHealthCard::sum('health_card_amount');
            $healthCardWalletstate = WalletHealthCard::sum('admin_transfered_amt');
            //end hrere
            //total number of user
            $totalStateHead = Admin::where('type','=','state-head-hcms')->count();
            $totalDistrictHead = Admin::where('type','=','district-head-hcms')->count();
            $totalCityHead = Admin::where('type','=','city-head-hcms')->count();
            $totalhealthCard = Admin::where('type','=','Health_card_Customer')->count();
            // end totalnumber user
            //Profit Share Start
            $totalStateHeadProfit = WalletHCMS::sum('state_hcms_trans_amt');
            $totalStateHeadProfitHealth = WalletHealthCard::sum('state_hcms_trans_amt');
            $totalDistrictHeadProfit = WalletHCMS::sum('dist_hcms_trans_amt');
            $totalDistrictHeadProfitHealth = WalletHealthCard::sum('dist_hcms_trans_amt');
            $totalCityHeadProfit = WalletHealthCard::sum('city_hcms_trans_amt');
            $totalhealthCardProfit = WalletHealthCard::sum('healthcard_hcms_trans_amt');
            //Profit Share End
                $tabledata = DB::table('income2')->get();
                $totalLevelAmount = DB::table('income2')->sum('rs');
                $todayDate = Carbon::now()->format('Y-m-d');
                $thisMonth = Carbon::now()->format('m');
                $thisYear = Carbon::now()->format('Y');
                $todayHealthCard = DB::table('create_health_card')->whereDate('created_at',$todayDate)->count();
                $thisMonthHealthCard = DB::table('create_health_card')->whereMonth('created_at',$thisMonth)->count();
                $thisYearHealthCard = DB::table('create_health_card')->whereYear('created_at', $thisYear)->count();
                     $totalDayLevelIncome = DB::table('income2')->whereDate('created_at',$todayDate)->sum('rs');
                     $totalMonthsLevelIncome = DB::table('income2')->whereMonth('created_at',$thisMonth)->sum('rs');
                     $totalYearLevelIncome = DB::table('income2')->whereYear('created_at', $thisYear)->sum('rs');
                     $totalHealthCardAmount = DB::table('total_withdraw_trasection')->where('type','Debit')->get();
                    //  gst calculation
                    $totalstateheadgst = DB::table('stateheadhcmss')->sum('gst_percentage_amount');
                    $todaystateheadgst = DB::table('stateheadhcmss')->whereDate('created_at',$todayDate)->sum('gst_percentage_amount');
                    $thisMonthstateheadgst = DB::table('stateheadhcmss')->whereMonth('created_at',$thisMonth)->sum('gst_percentage_amount');
                    $thisYearstateheadgst = DB::table('stateheadhcmss')->whereYear('created_at', $thisYear)->sum('gst_percentage_amount');
                    $totaldistrictheadgst = DB::table('districtheadhcms')->sum('gst_percentage_amount');
                    $todaydistrictheadgst = DB::table('districtheadhcms')->whereDate('created_at',$todayDate)->sum('gst_percentage_amount');
                    $thisMonthdistrictheadgst = DB::table('districtheadhcms')->whereMonth('created_at',$thisMonth)->sum('gst_percentage_amount');
                    $thisYeardistrictheadgst = DB::table('districtheadhcms')->whereYear('created_at', $thisYear)->sum('gst_percentage_amount');
                    $totalcityheadgst = DB::table('cityheadhcms')->sum('gst_percentage_amount');
                    $todaycityheadgst = DB::table('cityheadhcms')->whereDate('created_at',$todayDate)->sum('gst_percentage_amount');
                    $thisMonthcityheadgst = DB::table('cityheadhcms')->whereMonth('created_at',$thisMonth)->sum('gst_percentage_amount');
                    $thisYearcityheadgst = DB::table('cityheadhcms')->whereYear('created_at', $thisYear)->sum('gst_percentage_amount');
                    $totalhealthcardheadgst = DB::table('create_health_card')->sum('gst_percentage_amount');
                    $todayhealthcardheadgst = DB::table('create_health_card')->whereDate('created_at',$todayDate)->sum('gst_percentage_amount');
                    $thisMonthhealthcardheadgst = DB::table('create_health_card')->whereMonth('created_at',$thisMonth)->sum('gst_percentage_amount');
                    $thisYearhealthcardheadgst = DB::table('create_health_card')->whereYear('created_at', $thisYear)->sum('gst_percentage_amount');
                    $gettbldatawallet_hospital = DB::table('wallet_hospital')
                  ->join('admins','admins.id','wallet_hospital.hospital_id')
                    ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
                    ->join('cities','cities.id','admins.city')
                    ->select('wallet_hospital.*','states.state_name','districts.district_name','cities.city_name')
                    ->get();
                    $totalwallet_hospital = DB::table('wallet_hospital')->sum('admin_per_amount');

                    $gettbldatawallet_doctor = DB::table('wallet_doctor')
                    ->join('admins','admins.id','wallet_doctor.doctor_id')
                      ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
                      ->join('cities','cities.id','admins.city')
                      ->select('wallet_doctor.*','states.state_name','districts.district_name','cities.city_name')
                      ->get();
                      $totalwallet_doctor = DB::table('wallet_doctor')->sum('admin_per_amount');
                      $gettbldatawallet_pathology = DB::table('wallet_pathologys')
                      ->join('admins','admins.id','wallet_pathologys.pathology_id')
                        ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
                        ->join('cities','cities.id','admins.city')
                        ->select('wallet_pathologys.*','states.state_name','districts.district_name','cities.city_name')
                        ->get();
                        $totalwallet_pathologys = DB::table('wallet_pathologys')->sum('admin_per_amount');
                        //Hospital
                        $totalPatientDetails = PatientDetails::where('hospital_id','!=',0)->count();
    $todayPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->count();
    $thisMonthPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
    $thisYearPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->count();

    $totalPatientDetailsadiscountamount = PatientDetails::where('hospital_id','!=',0)->sum('paitent_discount_amount');
    $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
    $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
    $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

    $totalPatientdischargeamount = PatientDetails::where('hospital_id','!=',0)->sum('after_discount_finall_bill');
    $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
    $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
    $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


    $totalcompanycommission = PatientDetails::where('hospital_id','!=',0)->sum('company_commission_amount');
    $totalDaycompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
    $totalMonthscompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
    $totalYearcompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
                        //Hospital End 


                        

                return view('admin.account_admin')->with(compact('gettbldatawallet_pathology','totalwallet_pathologys','totalHealthCardAmount','totalYearLevelIncome','totalMonthsLevelIncome',
                'totalDayLevelIncome','thisYearHealthCard','thisMonthHealthCard','todayHealthCard','totalLevelAmount','tabledata',
                'totalStateHeadProfitHealth','totalDistrictHeadProfitHealth','totalStateHeadProfit','totalDistrictHeadProfit',
                'totalCityHeadProfit','totalhealthCardProfit','totalStateHead','totalDistrictHead','totalCityHead','totalhealthCard',
                'regstatewalletamt','healthCardWalletstate','wallet','walletHealthCard','totalRegisterAmount','toatalHealthCardAmount',
                'totalstateheadgst','todaystateheadgst','thisMonthstateheadgst','thisYearstateheadgst','totaldistrictheadgst','todaydistrictheadgst',
                'thisMonthdistrictheadgst','thisYeardistrictheadgst','totalcityheadgst','todaycityheadgst','thisMonthcityheadgst','thisYearcityheadgst'
                ,'totalhealthcardheadgst','todayhealthcardheadgst','thisMonthhealthcardheadgst','thisYearhealthcardheadgst','gettbldatawallet_hospital'
                ,'totalwallet_hospital','gettbldatawallet_doctor','totalwallet_doctor',
                'totalPatientDetails',
                'todayPatientDetails',
                'thisMonthPatientDetails',
                'thisYearPatientDetails',
                'totalDayPatientDetailsadiscountamount',
                'totalPatientDetailsadiscountamount',
                'totalMonthsPatientDetailsadiscountamount',
                'totalYearPatientDetailsadiscountamount',
                'totalDayPatientdischargeamount',
                'totalPatientdischargeamount',
                'totalMonthsPatientdischargeamount',
                'totalYearPatientdischargeamount',
                'totalDaycompanycommission',
                'totalcompanycommission',
                'totalMonthscompanycommission',
                'totalYearcompanycommission',

                 ));
    }

    public function AssignRolePermission()
    {
        $AdminView = Admin::get();
        return view('admin.admins.assign_role_permission_list')->with(compact('AdminView'));
    }

    public function AssignRole(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add Assign Role";
            $admindata = new Admin;
            $message = "  Add Assign Role Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                    if($id==""){
                        $adminCount = Admin::where('email',$data['email'])->count();
                        if($adminCount>0){
                            Session::flash('error_message','Email Is Already Exists!');
                            return redirect('admin/Assign-Role-Permission');
                        }
                    }

                $rules = [
                    'name' => 'required',
                    'password' => 'required',
                    'email' => 'required',
                    'mobile' => 'required',
                    'type' => 'required',
                ];

                $customMessages = [
                    'name.required' => 'Name is Requried',
                    'password.required' => 'Password is Requried',
                    'email.required' => 'email is Requried',
                    'mobile.required' => 'mobile is Requried',
                    'type.required' => 'type is Requried',

                ];
                $this->validate($request, $rules, $customMessages);
                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/adminlogin/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $admindata->image = $imageName;
                    }
                } else {
                    $admindata->image = "";
                }


                $admindata->name = $data['name'];
                if($id==""){
                    $admindata->email = $data['email'];
                    $admindata->type = $data['type'];
                }
                $admindata->mobile = $data['mobile'];
                $admindata->password = bcrypt($data['password']);
                    $admindata->created_by = Auth::guard('admin')->user()->id;
                $admindata->referred_by = Auth::guard('admin')->user()->id;

                $admindata->state_head_hcms_id = 0;
                $admindata->district_head_hcms_id     = 0;
                $admindata->city_head_hcms_id     = 0;
                $admindata->health_card_customer_id    = 0;
                $admindata->reference_code = 0;
                $admindata->district_admin_id     = 0;
                $admindata->delivery_boy_id     = 0;
                $admindata->assign_state = 0;
                $admindata->assign_district = 0;
                $admindata->assign_city = 0;
                $admindata->status = 1;
                $admindata->save();

                return redirect('admin/Assign-Role-Permission')->with('success_message', $message);
            }
            return view('admin.admins.add_edit_assign_role')->with(compact('title', 'admindata'));
        } else {

            $admindata = Admin::find($id);
            $title = "Edit Email And Password Of ".$admindata['name']." (".$admindata['type'].")";
            $message = " ".$admindata['name']." (".$admindata['type'].") Email And Password Has Been Reset  Successfully! And Mail also Send To Your Email";
            if ($request->isMethod('post')) {
                $data = $request->all();
                    if($id==""){
                        $adminCount = Admin::where('email',$data['email'])->count();
                        if($adminCount>0){
                            Session::flash('error_message','Email Is Already Exists!');
                            return redirect('admin/Assign-Role-Permission');
                        }
                    }

                $rules = [
                    'name' => 'required',
                    "email" =>"required|email|unique:admins",
                    'password' => 'required',
                ];

                $customMessages = [
                    'name.required' => 'Name is Requried',
                    'password.required' => 'Password is Requried',
                    "email.required" =>"Email is Required",
                    "email.unique" =>" Email Already Exists",


                ];
                $this->validate($request, $rules, $customMessages);
                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/adminlogin/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $admindata->image = $imageName;
                    }
                } else {
                    $admindata->image = "";
                }


                $admindata->name = $data['name'];
                $admindata->email = $data['email'];
                $admindata->mobile = $data['mobile'];
                $admindata->password = bcrypt($data['password']);
                $admindata->updated_by = Auth::guard('admin')->user()->id;
                $admindata->status = 1;
                $admindata->save();

                 //Send Conifirmation Email
                 $email= $data['email'];
                 $messageData=[
                    'email' =>$data['email'],
                    'password' =>$data['password'],
                    'name' =>$data['name'],
                    'mobile' =>$data['mobile'],
                 ];
                 Mail::send('emails.reset_mail_password_updated',$messageData,function($message)use($email){
                     $message->to($email)->subject('Hello India Life Care Update Email & Password Mail ');
                 });

                return redirect('admin/Assign-Role-Permission')->with('success_message', $message);
            }
            return view('admin.admins.edit_assign_role_admin')->with(compact('title', 'admindata'));
        }

    }
    public function UpdateRole(Request $request,$id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            unset($data['_token']);
            // echo "<pre>";print_r($data); die;
                 AdminsRole::where('admin_id',$id)->delete();

            foreach($data as $key => $value){
                if(isset($value['view'])){
                    $view = $value['view'];
                }else{
                    $view = 0;
                }
                if(isset($value['edit'])){
                    $edit = $value['edit'];
                }else{
                    $edit = 0;
                }
                if(isset($value['full'])){
                    $full = $value['full'];
                }else{
                    $full = 0;
                }
                // echo "<pre>";print_r($data); die;
                AdminsRole::where('admin_id',$id)->insert(['admin_id'=>$id,'module'=>$key,'view_access'=>$view,'edit_access'=>$edit,'full_access'=>$full]);
            }
            $message = "/Assign Role Permission Updated successfully!";
            Session::flash('success_message',$message);
            return redirect('admin/Assign-Role-Permission');
        }
        $Adminid = Admin::where('id',$id)->first()->toArray();
        $adminRoles = AdminsRole::where('admin_id',$id)->get()->toArray();
        $title = "Update ".$Adminid['name']." (".$Adminid['type'].") Role And Permission";
        return view('admin.admins.update_roles')->with(compact('title','Adminid','adminRoles'));
    }

    public function ResetPassword(Request $request,$id)
    {
       $adminRest = Admin::find($id);
        $data= $request->all();

        $new_password = Str::random(16);

        $adminRest->password = bcrypt($new_password);
        $adminRest->save();

            //Send Conifirmation Email
            $email= $adminRest['email'];
            $messageData=[
               'email' =>$email,
               'password' =>$new_password,
               'name' =>$adminRest['name'],
               'mobile' =>$adminRest['mobile'],
            ];
            Mail::send('emails.reset_password_mail',$messageData,function($message)use($email){
                $message->to($email)->subject('Reset Password Mail From Hello India Life Care');
            });
             $message = "Password is Reset Sucessfully!. And Send To Your ".$adminRest['email']."";
             return redirect('admin/Assign-Role-Permission')->with('success_message', $message);

        return view('admin.admins.reset_password')->with(compact('adminRest'));
    }

    public function AddDummyWallet(Request $request,$id)
    {
        $admindata= Admin::find($id);
        $title = "ADD Dummy Wallet Amount To ".$admindata['name']." is ".$admindata['type']."";
        $message = " ".$admindata['name']." (".$admindata['type'].") Dummy Amount Has Been Reset  Successfully!";
        if ($request->isMethod('post')) {
            $data = $request->all();
            $grand_total = $admindata['dummy_wallet'] + $data['dummy_wallet'];

         $admindata->dummy_wallet= $grand_total;
         $admindata->save();
           //dummy histroy section

            $adminDummyWalletHist = new AdminDummyWallet;

            $adminDummyWalletHist->type= $admindata['type'];
            $adminDummyWalletHist->admin_id= Auth::guard('admin')->user()->id;
            $adminDummyWalletHist->money_add_by= Auth::guard('admin')->user()->name;
            $adminDummyWalletHist->user_id= $admindata['id'];
            $adminDummyWalletHist->add_amount= $data['dummy_wallet'];
            $adminDummyWalletHist->grand_total=  $grand_total;
            $adminDummyWalletHist->email= $admindata['email'];
            // dd($adminDummyWalletHist);
            $adminDummyWalletHist->save();
            return redirect('admin/Assign-Role-Permission')->with('success_message',$message);
        }

        $admindummyWalletHistroy= AdminDummyWallet::where('user_id',$id)->get()->toArray();
        return view('admin.admins.add_dummy_wallet')->with(compact('admindata','title','admindummyWalletHistroy'));
    }

    public function DummyInvoice()
    {
        $dummyInvoiceData = DB::table('dummy_invoices')->get();
        return view('admin.dummyInvoice.dummy_invoice_List')->with(compact('dummyInvoiceData'));
    }
    public function AddEditDummyinvoice(Request $request)
    {
        $AddDummyInovies= new DummyInvoices;
        $title = "ADD Dummy Inovice";
        $message = "Dummy Inovice is Created Successfully!";
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                "member_id" => "required|exists:admins",
            ];
            $customMessages = [
                "member_id.exists" => " This Member_id Is Not Exists in our database.Plz End Vaild Details",
            ];
            $this->validate($request, $rules, $customMessages);
            $getAdminDetails= Admin::where('member_id','=',$data['member_id'])->first();
            $AddDummyInovies->member_id= $data['member_id'];
            $AddDummyInovies->user_id= $getAdminDetails['id'];
            $AddDummyInovies->received_amount= $data['received_amount'];
            $AddDummyInovies->total_amount= $data['total_amount'];
            $AddDummyInovies->pending_amount= $data['pending_amount'];
            $AddDummyInovies->user_name= $getAdminDetails['name'];
            $AddDummyInovies->user_type= $getAdminDetails['type'];
            $AddDummyInovies->save();
            return redirect('admin/dummy-invoice')->with('success_message',$message);
        }
        return view('admin.dummyInvoice.addEdit_dummy_invoice')->with(compact('title'));
    }
    public function ViewDummyInvoice($id)
    {
        $InvoiceData = DB::table('dummy_invoices')->where('dummy_invoices.id',$id)->first();
        $Setting=DB::table('settings')->first();
        return view('admin.dummyInvoice.view_dummy_invoice')->with(compact('InvoiceData','Setting'));
    }

}
