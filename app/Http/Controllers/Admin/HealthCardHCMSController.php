<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Admin;
use App\Models\Accounts;
use App\Models\AdminsRole;
use App\Models\HealthCard;
use App\Models\WalletHCMS;
use Illuminate\Support\Str;
use App\Models\LevelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\IssueHealthCard;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\WalletHealthCard;
use App\Mail\InviceOrderMailable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Healthcarddummywallet;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HealthCardHCMSController extends Controller
{
    public function HealthCardType()
    {
        Session::put('page', 'health-card-type');
        $healthcardtype = HealthCard::get()->toArray();
        return view('admin.healthCard.health_card_type')->with(compact('healthcardtype'));
    }
    public function AddEditHealthCardType(Request $request, $id = null)
    {
        Session::put('page', 'health-card-type');
        if ($id == "") {
            $title = "Add Health Card Type";
            $healthcardtype = new HealthCard;
            $message = "Health Card Type  Add Successfully!";
        } else {
            $title = "Edit Health Card Typ";
            $healthcardtype = HealthCard::find($id);
            $message = "Health Card Type Update Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;

            $rules = [
                'health_card_type' => 'required',
                'health_card_amount' => 'required|numeric',
            ];

            $customMessages = [
                'health_card_type.required' => 'Name is Requried',
                'health_card_amount.required' => 'Name is Requried',

            ];
            $this->validate($request, $rules, $customMessages);

            $healthcardtype->health_card_type = $data['health_card_type'];
            $healthcardtype->health_card_amount = $data['health_card_amount'];
            $healthcardtype->gst_percentage = $data['gst_percentage'];
            $healthcardtype->gst_percentage_amount = $data['gst_percentage_amount'];
            $healthcardtype->total_healthcard_reqistation_amount = $data['total_state_reqistation_amount'];
            $healthcardtype->status = 1;
            $healthcardtype->save();

            return redirect('admin/health-card-type')->with('success_message', $message);
        }


        return view('admin.healthCard.add_edit_card_type')->with(compact('title', 'healthcardtype'));
    }
    public function ChangeHealthCardTypeStatus(Request $request)
    {
        Session::put('page', 'health-card-type');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('health_card_type')
            ->where('id', $status_id)
            ->first();

        DB::table('health_card_type')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        return redirect('/admin/health-card-type')->withErrors([' status Updated successfully ']);
    }
    public function deleteHealthCardType($id)
    {
        Session::put('page', 'health-card-type');
        $deleted_data = DB::table('health_card_type')->where('id', $id)->first();
        try {
            DB::table('health_card_type')->where('id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/health-card-type')->withErrors([' Health Card Type  Deleted successfully ']);
    }
    // End Health Card Type

    // Start Health Card Create
    public function HealthCard()
    {
        Session::put('page', 'create-health-card');

        if (Auth::guard('admin')->user()->type == 'admin') {
            $CreateCard = IssueHealthCard::where('healthcard_status','=',1)->get()->toArray();
        } else {
            $CreateCard = IssueHealthCard::where('created_by', Auth::guard('admin')->user()->id)->where('healthcard_status','=',1)->get()->toArray();
        }
        $AdminsRoleModuleCount = AdminsRole::where(['admin_id' => Auth::guard('admin')->user()->id, 'module' => 'create-health-card'])->count();
        if (Auth::guard('admin')->user()->type == "admin") {
            $AdminsRoleModule['view_access'] = 1;
            $AdminsRoleModule['edit_access'] = 1;
            $AdminsRoleModule['full_access'] = 1;
        } else if ($AdminsRoleModuleCount == 0) {
            $message = "This Health Card Feature is Restricted For You. If You Want Access this Health Card  Feature . Than Contact To Admin/SubAdmin";
            Session::flash('error_message', $message);
            return redirect('admin/assign-card-customer-list');
        } else {
            $AdminsRoleModule = AdminsRole::where(['admin_id' => Auth::guard('admin')->user()->id, 'module' => 'create-health-card'])->first()->toArray();
        }

        return view('admin.healthCard.health_card_list')->with(compact('CreateCard', 'AdminsRoleModule'));
    }



    public function CreateHealthCard(Request $request, $id = null)
    {
        Session::put('page', 'create-health-card');
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $issuehealthCard = new IssueHealthCard();
            $admin = new Admin();
            $message = "Health Card Customer Add Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" =>"required|email|unique:admins|unique:create_health_card",
                    'health_card_type' => 'required',
                    'name' => 'required',
                    'password' => 'required',
                    'card_reg_start' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                    'card_reg_end' => 'required',
                    'sponsor_id' => "required|exists:admins,member_id",
                ];
                $customMessages = [
                    'health_card_type.required' => 'Health Card is Requried',
                    'name.required' => 'Name is Requried',
                    'password.required' => 'Password is Requried',
                    "email.required" =>"Email is Required",
                         "email.unique" =>" Email Already Exists",
                    'assign_state.required' => 'assign_state is Requried',
                    'assign_district.required' => 'assign_district is Requried',
                    'assign_city.required' => 'assign_city is Requried',
                    'card_reg_start.required' => 'card_reg_start is Requried',
                    'card_reg_end.required' => 'card_reg_end is Requried',
                    "assign_state.exists" =>" This State Is Not Assign Yet. Plz Select Another State Which Is Exist Or Contact To Admin",
                    "assign_district.exists" =>" This District Is Not Assign Yet. Plz Select Another District Which Is Exist Or Contact To Admin",
                    "assign_city.exists" =>" This City Is Not Assign Yet. Plz Select Another City Which Is Exist Or Contact To Admin",
                    "sponsor_id.exists" =>" This Member ID Is not Exist IN Our DataBase. Plz enter Valid Member ID ",

                ];

                $this->validate($request, $rules, $customMessages);
               $get_sponsor_id = Admin::where('id',Auth::guard('admin')->user()->id)->first();


                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/healthcardcustomer/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $issuehealthCard->image = $imageName;
                    }
                } else {
                    $issuehealthCard->image = "";
                }
                $spom = 'ID-HCMS-' . rand(1111, 9999);
                $issuehealthCard->health_card_issue_id_no = 'HILC-GO-0' . rand(1111, 9999);
                $issuehealthCard->name = $data['name'];
                $issuehealthCard->email = $data['email'];
                $issuehealthCard->password = $data['password'];
                $issuehealthCard->swd = $data['swd'];
                $issuehealthCard->dob = $data['dob'];
                $issuehealthCard->blood_group = $data['blood_group'];
                $issuehealthCard->address = $data['address'];
                $issuehealthCard->assign_state = $data['assign_state'];
                $issuehealthCard->assign_district = $data['assign_district'];
                $issuehealthCard->assign_city = $data['assign_city'];
                $issuehealthCard->pincode = $data['pincode'];
                $issuehealthCard->card_reg_start = $data['card_reg_start'];
                $issuehealthCard->card_reg_end = $data['card_reg_end'];
                $issuehealthCard->aadhar_no = $data['aadhar_no'];
                $issuehealthCard->pan_number = $data['pan_number'];
                $issuehealthCard->mobile = $data['mobile'];
                $issuehealthCard->sponsor_id = $data['sponsor_id'];
                $issuehealthCard->member_id = $spom;
                $issuehealthCard->referred_by = Auth::guard('admin')->user()->id;
                $issuehealthCard->health_card_type = $data['health_card_type'];
                $issuehealthCard->health_card_amount = $data['health_card_amount'];
                $issuehealthCard->created_by = Auth::guard('admin')->user()->id;
                $issuehealthCard->gst_percentage = $data['gst_percentage'];
                $issuehealthCard->gst_percentage_amount = $data['gst_percentage_amount'];
                $issuehealthCard->total_healthcard_reqistation_amount = $data['total_healthcard_reqistation_amount'];
                $issuehealthCard->status = 1;

                $issuehealthCard->save();
                $issuehealthCard_id = DB::getPdo()->lastInsertId();
             $findmainid = Admin::where('member_id',$data['sponsor_id'])->first();
                // Insert the state-head-hcms Details in Admins Table
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Health_card_Customer';
                $admin->state_head_hcms_id = 0;
                $admin->district_head_hcms_id     = 0;
                $admin->city_head_hcms_id     = 0;
                $admin->health_card_customer_id    = $issuehealthCard_id;
                $admin->reference_code = 'HILCHCMS-000000' . $issuehealthCard_id;
                $admin->district_admin_id     = 0;
                $admin->delivery_boy_id     = 0;
                $admin->assign_state = 0;
                $admin->assign_district = 0;
                $admin->assign_city = 0;

                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];

                $admin->name = $data['name'];
                $admin->mobile = $data['mobile'];
                $admin->email = $data['email'];
                $admin->member_id = $spom;
                $admin->sponsor_id = $data['sponsor_id'];
                $admin->referred_by = Auth::guard('admin')->user()->id;
                $admin->password = bcrypt($data['password']);
                $admin->created_by = Auth::guard('admin')->user()->id;
              $admin->parent_id = $findmainid['id'];
                $admin->status = 1;
                $admin->healthcard_status = 0;
                $admin->save();

                $admin_id= DB::getPdo()->lastInsertId();
                // Assign Role And Permission to Admin Type User for Health Card assign view Permission only
                            $adminsRole = new AdminsRole;
                            $adminsRole->admin_id = $admin_id;
                            $adminsRole->module = 'create-health-card';
                            $adminsRole->view_access = 1;
                            $adminsRole->edit_access = 0;
                            $adminsRole->full_access = 0;
                            $adminsRole->save();

                $issuehealthCard->reference_code = 'HILCHCMS-000000' . $issuehealthCard_id;
                $issuehealthCard->save();

                //Send Conifirmation Email
                $email= $data['email'];
                $messageData=[
                    'email' =>$data['email'],
                    'password' =>$data['password'],
                    'name' =>$data['name'],
                    'mobile' =>$data['mobile'],
                ];
                Mail::send('emails.healthcard_user_accoun_opening',$messageData,function($message)use($email){
                    $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Health Card User');
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
            // $sender. 'Dear Customer,Your Health Card Account is Created Successfully. And your membership is started with Hello India Life Care.And Your Email is.'.'. '.$email.'.'.'. and Password is.'.'. '.$password.'.'.'..Now You Can Login To Your Panel.'.
            // 'HILCPL';
            // $templateid = "1507165891841356955";
            // $apiRoute = 'TRANS';
            // $datas = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$sender."&TemplateID=".$templateid."&message=".$message;
            // $url = 'http://tagsolutions.in/sms-panel/api/http/index.php?'.$datas;
            // $url = preg_replace("/ /", "%20", $url);
            // $response = file_get_contents($url);

                DB::commit();

                return redirect('admin/create-health-card')->with('success_message', $message);
            }
        } else {
            $title = "Edit ";
            $issuehealthCard = IssueHealthCard::find($id);
            // $admin =  Admin::find($id);
            $message = "Health Card Customer Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/healthcardcustomer/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $issuehealthCard->image = $imageName;
                    }
                } else {
                    $issuehealthCard->image = "";
                }

                $issuehealthCard->name = $data['name'];
                $issuehealthCard->swd = $data['swd'];
                $issuehealthCard->dob = $data['dob'];
                $issuehealthCard->blood_group = $data['blood_group'];
                $issuehealthCard->address = $data['address'];
                $issuehealthCard->pincode = $data['pincode'];
                $issuehealthCard->aadhar_no = $data['aadhar_no'];
                $issuehealthCard->pan_number = $data['pan_number'];
                $issuehealthCard->mobile = $data['mobile'];
                $issuehealthCard->status = 1;
                $issuehealthCard->save();

                //Send Conifirmation Email
                // $email= $data['email'];
                // $messageData=[
                //    'email' =>$data['email'],
                //    'password' =>$data['password'],
                //    'name' =>$data['name'],
                //    'mobile' =>$data['mobile'],
                // ];
                // Mail::send('emails.healthcard_user_accoun_opening',$messageData,function($message)use($email){
                //     $message->to($email)->subject('Account Updated Mail Of Hello India Life Care For Health Card User');
                // });

                DB::commit();

                return redirect('admin/create-health-card')->with('success_message', $message);
            }
        }


        $state = DB::table('states')->where('status', '1')->get();
        $healthcardtype = DB::table('health_card_type')->where('status', '1')->get();
        return view('admin.healthCard.add_edit_health_card')->with(compact('title', 'issuehealthCard','state', 'healthcardtype'));
    }

    public function ChangeHealthCardListStatus(Request $request)
    {
        $status_id = $request->get('status_id');

        $statuschange = DB::table('create_health_card')
            ->where('id', $status_id)
            ->first();

        DB::table('create_health_card')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        return redirect('/admin/create-health-card')->withErrors([' status Updated successfully ']);
    }
    public function deleteHealthCardList($id)
    {

        $deleted_data = DB::table('create_health_card')->where('id', $id)->first();
        try {
            DB::table('create_health_card')->where('id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/create-health-card')->withErrors([' Health Card Customer  Deleted successfully ']);
    }

    // End Health Card Create Section
    public function downloadhealthcards()
    {
        $download = DB::table('create_health_card')->join('health_card_type','health_card_type.id','create_health_card.health_card_type')
        ->where('create_health_card.id',Auth::guard('admin')->user()->health_card_customer_id)->first();
                             return view('admin.healthCard.download_health_cards')->with(compact('download'));
    }

    public function downloadhealthcard($id)
    {
      
    //   return  $download = IssueHealthCard::with('healthcardtype')->find($id);
        $download = DB::table('create_health_card')->join('health_card_type','health_card_type.id','create_health_card.health_card_type')->where('create_health_card.id',$id)->first();
        // dd( $download);
        return view('admin.healthCard.download_health_card')->with(compact('download'));
    }
    
    public function generateHealthcard($id)
    {
       
        $download = IssueHealthCard::join('health_card_type','health_card_type.id','create_health_card.health_card_type')
        ->where('create_health_card.id',$id)->first();
        $data = ['download' => $download];
        $pdf = Pdf::loadView('admin.healthCard.generate-healthcard', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('healthCard' . $download->id . '-' . $todayDate . '.pdf');
    }

    public function HealthcardCustomerList()
    {
        Session::put('page', 'health-card-customer-list');
        if (Auth::guard('admin')->user()->type == 'admin') {
            $HealthCardCustomerList = IssueHealthCard::join('admins', 'admins.id', 'create_health_card.referred_by')
                ->join('health_card_type', 'health_card_type.id', 'create_health_card.health_card_type')
                ->select(
                    'admins.name as refered_by',
                    'admins.type',
                    'create_health_card.name',
                    'create_health_card.card_reg_start',
                    'create_health_card.card_reg_end',
                    'create_health_card.image',
                    'create_health_card.id',
                    'health_card_type.health_card_type',
                    'health_card_type.health_card_amount'
                )

                ->get()->toArray();
            $total_healthCardCustomer = IssueHealthCard::count();
        } else {
            $HealthCardCustomerList = IssueHealthCard::join('admins', 'admins.id', 'create_health_card.referred_by')
                ->join('health_card_type', 'health_card_type.id', 'create_health_card.health_card_type')
                ->select(
                    'admins.name as refered_by',
                    'admins.type',
                    'create_health_card.name',
                    'create_health_card.card_reg_start',
                    'create_health_card.card_reg_end',
                    'create_health_card.image',
                    'create_health_card.id',
                    'health_card_type.health_card_type',
                    'health_card_type.health_card_amount'
                )
                ->where('create_health_card.created_by', Auth::guard('admin')->user()->id)
                ->get()->toArray();
            $total_healthCardCustomer = IssueHealthCard::where('create_health_card.created_by', Auth::guard('admin')->user()->id)->count();
        }


        return view('admin.healthCard.health_card_Customer_list')->with(compact('HealthCardCustomerList', 'total_healthCardCustomer'));
    }
    public function AssignCardCustomerList()
    {
        Session::put('page', 'assign-card-customer-list');
        if (Auth::guard('admin')->user()->type == 'admin') {
            $AssignCardCustomerList = IssueHealthCard::join('admins', 'admins.id', 'create_health_card.referred_by')
                ->join('health_card_type', 'health_card_type.id', 'create_health_card.health_card_type')
                ->select(
                    'admins.name as refered_by',
                    'admins.type',
                    'create_health_card.name',
                    'create_health_card.card_reg_start',
                    'create_health_card.card_reg_end',
                    'create_health_card.image',
                    'create_health_card.id',
                    'health_card_type.health_card_type',
                    'health_card_type.health_card_amount',
                    'create_health_card.health_card_issue_id_no'
                )

                ->get()->toArray();
            $total_assigncard = IssueHealthCard::count();
            $total_assigncardamount = IssueHealthCard::sum('health_card_amount');
        } else {

            $AssignCardCustomerList = IssueHealthCard::join('admins', 'admins.id', 'create_health_card.referred_by')
                ->join('health_card_type', 'health_card_type.id', 'create_health_card.health_card_type')
                ->select(
                    'admins.name as refered_by',
                    'admins.type',
                    'create_health_card.name',
                    'create_health_card.card_reg_start',
                    'create_health_card.card_reg_end',
                    'create_health_card.image',
                    'create_health_card.id',
                    'health_card_type.health_card_type',
                    'health_card_type.health_card_amount',
                    'create_health_card.health_card_issue_id_no'
                )
                ->where('create_health_card.created_by', Auth::guard('admin')->user()->id)
                ->get()->toArray();
            $total_assigncard = IssueHealthCard::where('create_health_card.created_by', Auth::guard('admin')->user()->id)->count();
            $total_assigncardamount = IssueHealthCard::where('create_health_card.created_by', Auth::guard('admin')->user()->id)->sum('health_card_amount');
        }


        return view('admin.healthCard.assign_health_card_Customer_list')->with(compact('AssignCardCustomerList', 'total_assigncard', 'total_assigncardamount'));
    }

    public function AccountStateHead()
    {


        $accountstate = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $walletHealthCard = WalletHealthCard::join('admins', 'admins.id', '=', 'wallet_healthcard.selected_referred_user_id')
            ->where('admins.health_card_customer_id', '=', Auth::guard('admin')->user()->health_card_customer_id)
            ->select('admins.image', 'admins.name as admin_name', 'admins.type', 'admins.health_card_customer_id', 'admins.assign_state', 'admins.assign_district', 'admins.assign_city', 'wallet_healthcard.selected_referred_user_id', 'wallet_healthcard.id', 'wallet_healthcard.healthcard_hcms_trans_amt', 'wallet_healthcard.*')->Paginate(10);


        $healthCardWallet = WalletHealthCard::join('admins', 'admins.id', '=', 'wallet_healthcard.selected_referred_user_id')
            ->where('admins.health_card_customer_id', '=', Auth::guard('admin')->user()->health_card_customer_id)
            ->select('admins.image', 'admins.name as admin_name', 'admins.type', 'admins.health_card_customer_id', 'admins.assign_state', 'admins.assign_district', 'admins.assign_city', 'wallet_healthcard.selected_referred_user_id', 'wallet_healthcard.id', 'wallet_healthcard.healthcard_hcms_trans_amt', 'wallet_healthcard.remark')
            ->sum('healthcard_hcms_trans_amt');

            $tabledata = DB::table('income2')->where('intronewid',Auth::guard('admin')->user()->member_id)->get();
            $levelincome = DB::table('income2')->where('intronewid',Auth::guard('admin')->user()->member_id)->sum('rs');
            $totalHealthCardAmount = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->sum('total');
            $totalHealthCardAmountgetalldata = DB::table('total_withdraw_trasection')->where('admin_id',Auth::guard('admin')->user()->id)->first();

        return view('admin.healthCard.account_healthcard_details')->with(compact('totalHealthCardAmountgetalldata','totalHealthCardAmount','levelincome','tabledata','accountstate', 'healthCardWallet', 'walletHealthCard'));
    }
    public function AccountHealthCardAdmin($id)
    {

        $accountstate = IssueHealthCard::join('admins', 'admins.health_card_customer_id', 'create_health_card.id')->find($id);

        $walletHealthCard = WalletHealthCard::join('admins', 'admins.id', '=', 'wallet_healthcard.selected_referred_user_id')
            ->where('admins.health_card_customer_id', '=', $id)
            ->select('admins.image', 'admins.name as admin_name', 'admins.type', 'admins.health_card_customer_id', 'admins.assign_state', 'admins.assign_district', 'admins.assign_city', 'wallet_healthcard.selected_referred_user_id', 'wallet_healthcard.id', 'wallet_healthcard.healthcard_hcms_trans_amt', 'wallet_healthcard.*')->Paginate(10);


        $healthCardWallet = WalletHealthCard::join('admins', 'admins.id', '=', 'wallet_healthcard.selected_referred_user_id')
            ->where('admins.health_card_customer_id', '=', $id)
            ->select('admins.image', 'admins.name as admin_name', 'admins.type', 'admins.health_card_customer_id', 'admins.assign_state', 'admins.assign_district', 'admins.assign_city', 'wallet_healthcard.selected_referred_user_id', 'wallet_healthcard.id', 'wallet_healthcard.healthcard_hcms_trans_amt', 'wallet_healthcard.remark')
            ->sum('healthcard_hcms_trans_amt');
        return view('admin.healthCard.account_healthcard_details_admin')->with(compact('accountstate', 'healthCardWallet', 'walletHealthCard'));
    }

    public function UpdateHealthCard(Request $request, $id)
    {
        $UpdateCardDetails = IssueHealthCard::find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();

            // update card start here
            $admin_dummy_wallet = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $admininactive = Admin::where('id', $id)->first();
          $issueHealth= IssueHealthCard::where('id',$admininactive->health_card_customer_id)->first();


            if ($admin_dummy_wallet->dummy_wallet >= $data['health_card_amount']) {
                $UpdateCardDetails->card_reg_start = $data['card_reg_start'];
                $UpdateCardDetails->card_reg_end = $data['card_reg_end'];
                $UpdateCardDetails->health_card_type = $data['health_card_type'];
                $UpdateCardDetails->health_card_amount = $data['health_card_amount'];
                $UpdateCardDetails->updated_by = Auth::guard('admin')->user()->id;
                $UpdateCardDetails->status = 1;
                $UpdateCardDetails->save();
                //   wallet section start here
                $user = DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
                $userdata = DB::table('create_health_card')->where('id', $id)->first();
                $findstate = DB::table('states')->where('id', $userdata->assign_state)->first();
                $finddistrict = DB::table('districts')->where('id', $userdata->assign_district)->first();
                $findcity = DB::table('cities')->where('id', $userdata->assign_city)->first();
                $find_dist_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'district-head-hcms']])->first();
                $find_state_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'state-head-hcms']])->first();
                $find_city_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'city-head-hcms']])->first();
                $find_healthcard_user = DB::table('commission_reqistation_amount')->where([['admin_type', '=', 'Health_card_Customer']])->first();

                $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $data['health_card_amount'];
                $healthcardummyWalletHis = new  Healthcarddummywallet;

                $healthcardummyWalletHis->created_by= $userdata->id;
                $healthcardummyWalletHis->user_id= $userdata->id;
                $healthcardummyWalletHis->admin_name= Auth::guard('admin')->user()->name;
                $healthcardummyWalletHis->Health_card_user_name= $userdata->name;
                $healthcardummyWalletHis->deducted_amount= $data['health_card_amount'];
                $healthcardummyWalletHis->reaming_amount=  $new_dummy_wallet;
                $healthcardummyWalletHis->healthcard_status_updated_by=  Auth::guard('admin')->user()->id;
               // dd($healthcardummyWalletHis);
                $healthcardummyWalletHis->save();

                if ($user->type == 'admin') {
                    $data_wallet = array(
                        'select_refer_user_type' =>  'Admin',
                        'health_card_amount' =>  $data['health_card_amount'],
                        'admin_transfered_amt' =>  $data['health_card_amount'],
                        'admin_percentage' => '100',

                        'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'remark' => 'Health Card Updated by Admin ' . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                    );
                    DB::table('wallet_healthcard')->insert($data_wallet);
                }
                if ($user->type == 'state-head-hcms') {
                    $health_card_amount = $data['health_card_amount'];
                    $commisssion_referred_user = $find_state_user->state_commission;
                    $tranfser_amount_to_admin = $health_card_amount - ($health_card_amount * $commisssion_referred_user) / 100;
                    $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user) / 100;

                    $data_wallet = array(
                        'select_refer_user_type' =>  'state-head-hcms',
                        'health_card_amount' =>  $data['health_card_amount'],
                        'state_percentage' => $commisssion_referred_user,
                        'admin_transfered_amt' => $tranfser_amount_to_admin,
                        'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,

                        'assign_state' =>  $user->assign_state,
                        'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'remark' => 'HealthCard Updated by State Head of' . " " . $findstate->state_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,
                    );
                    DB::table('wallet_healthcard')->insert($data_wallet);
                }
                if ($user->type == 'district-head-hcms') {
                    $health_card_amount = $data['health_card_amount'];
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
                        'health_card_amount' =>  $data['health_card_amount'],
                        'state_percentage' => $commisssion_referred_user_state,
                        'district_percentage' => $commisssion_referred_user_dist,
                        'admin_transfered_amt' => $tranfser_amount_to_admin,
                        'state_hcms_trans_amt' =>  $tranfser_amount_to_statehead,
                        'dist_hcms_trans_amt' =>  $tranfser_amount_to_disthead,

                        'assign_state' =>  $user->assign_state,
                        'assign_dist' =>  $user->assign_district,
                        'selected_referred_user_id' => Auth::guard('admin')->user()->id,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'remark' => 'HealthCard Updated by District Head of' . " " . $finddistrict->district_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                    );
                    DB::table('wallet_healthcard')->insert($data_wallet);
                }

                if ($user->type == 'city-head-hcms') {
                    $health_card_amount = $data['health_card_amount'];
                    $commisssion_referred_user_city = $find_city_user->city_commission;
                    $commisssion_referred_user_dist = $find_city_user->district_commission;
                    $commisssion_referred_user_state = $find_city_user->state_commission;
                    // city commission and tranfser_amount
                    $tranfser_amount_to_cityhead = ($health_card_amount * $commisssion_referred_user_city) / 100;
                    // district commission and tranfser_amount
                    $tranfser_amount_to_disthead = ($health_card_amount * $commisssion_referred_user_dist) / 100;
                    //state commission and tranfser_amount
                    $tranfser_amount_to_statehead = ($health_card_amount * $commisssion_referred_user_state) / 100;
                    // admin transfer amount
                    $tranfser_amount_to_admin = $health_card_amount - ($tranfser_amount_to_cityhead + $tranfser_amount_to_disthead + $tranfser_amount_to_statehead);


                    $data_wallet = array(
                        'select_refer_user_type' => 'city-head-hcms',
                        'health_card_amount' =>  $data['health_card_amount'],
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
                        'remark' => 'HealthCard Updated by City Head of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                    );
                    DB::table('wallet_healthcard')->insert($data_wallet);
                }


                if ($user->type == 'Health_card_Customer') {
                    $health_card_amount = $data['health_card_amount'];
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
                        'health_card_amount' =>  $data['health_card_amount'],
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
                        'remark' => 'HealthCard Updated by  HealthCard User of' . " " . $findcity->city_name . " " . 'Account of State' . $findstate->state_name . " " . 'and District of ' . " " . $finddistrict->district_name . "" . 'and City Of' . "" . $findcity->city_name . " " . 'of ' . '' . $userdata->name . " " . 'is Now' . " " . $userdata->type,

                    );
                    DB::table('wallet_healthcard')->insert($data_wallet);
                }
                // wallet end section here
                //Dummy wallet Section
                $new_dummy_wallet = $admin_dummy_wallet->dummy_wallet - $data['health_card_amount'];
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['dummy_wallet' => $new_dummy_wallet]);
                //Dummy wallet Section End
                //Send Conifirmation Email
            } else {
                $message = "Your Dummy wallet Section is Empty! . Contact To Admin/Account";
                return redirect('admin/health-card-customer-list')->with('error_message', $message);
            }
            // end here



            $message = "Health Card  Updated Sucessfully!.";
            return redirect('admin/health-card-customer-list')->with('success_message', $message);
        }
        $state = DB::table('states')->where('status', '1')->get();
        $healthcardtype = DB::table('health_card_type')->where('status', '1')->get();
        return view('admin.healthCard.updated_card_type_healthcardCoustomer')->with(compact('state', 'healthcardtype', 'UpdateCardDetails'));
    }
    public function HealthwalletTransectionHistory()
    {
        if(Auth::guard('admin')->user()->type == 'admin')
        {
            $tabledata= Healthcarddummywallet::get()->toArray();
        }else
        {
            $tabledata= Healthcarddummywallet::where('healthcard_status_updated_by',Auth::guard('admin')->user()->id)->get()->toArray();
        }

       return view('admin.healthCard.health_wallet_transection_history')->with(compact('tabledata'));
    }

    public function viewbillhealthcard($id)
    {
        $InvoiceData= IssueHealthCard::join('states','states.id','=','create_health_card.assign_state')
        ->join('districts','districts.id','=','create_health_card.assign_district')
        ->join('cities','cities.id','=','create_health_card.assign_city')
        ->join('health_card_type','health_card_type.id','=','create_health_card.health_card_type')
        ->select('create_health_card.*','states.state_name','districts.district_name','cities.city_name','health_card_type.health_card_type as health_card_type_name')->find($id);
        return view('admin.bill.view_bill_healthcard_user')->with(compact('InvoiceData'));
    }

    public function HealthCardUserInovice()
    {

        $InvoiceData= IssueHealthCard::join('states','states.id','=','create_health_card.assign_state')
        ->join('districts','districts.id','=','create_health_card.assign_district')
        ->join('cities','cities.id','=','create_health_card.assign_city')
        ->join('health_card_type','health_card_type.id','=','create_health_card.health_card_type')
        ->select('create_health_card.*','states.state_name','districts.district_name','cities.city_name','health_card_type.health_card_type as health_card_type_name')->where('member_id',Auth::guard('admin')->user()->member_id)->first();
        return view('admin.bill.view_bill_healthcard_user')->with(compact('InvoiceData'));
    }
}
