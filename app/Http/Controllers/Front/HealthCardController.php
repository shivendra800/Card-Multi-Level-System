<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\AdminsRole;
use App\Models\HealthCard;
use Illuminate\Http\Request;
use App\Models\IssueHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HealthCardController extends Controller
{
    public function HealthCardType()
    {
        $healthcardType = HealthCard::where('status',1)->get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.HealthCard.health_card_type')->with(compact('healthcardType','get_setting_data'));
    }

    public function HealthCardTypeWiseFrom(Request $request,$slug)
    {
        DB::beginTransaction();
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
                    'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                    'aadhar_no'=>'required|digits:12',
                     'pincode'=>'required|digits:6',
                      'mobile'=>'required|digits:10'

                ];
                $customMessages = [
                    'health_card_type.required' => 'Health Card is Requried',
                    'name.required' => 'Name is Requried',
                    'password.required' => 'Password is Requried',
                    "email.required" =>"Email is Required",
                    "sponsor_id.required" =>"Sponsor Id is Required",
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
                   $healthcardtype = HealthCard::where('health_card_type','=',$data['health_card_type'])->first();
                $findmainid = Admin::where('member_id',$data['sponsor_id'])->first();
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
                $issuehealthCard->referred_by = $findmainid['id'];
                $issuehealthCard->health_card_type = $healthcardtype['id'];
                $issuehealthCard->health_card_amount = $data['health_card_amount'];
                $issuehealthCard->created_by = $findmainid['id'];
                $issuehealthCard->gst_percentage = $data['gst_percentage'];
                $issuehealthCard->gst_percentage_amount = $data['gst_percentage_amount'];
                $issuehealthCard->total_healthcard_reqistation_amount = $data['total_healthcard_reqistation_amount'];
                $issuehealthCard->status = 1;

                $issuehealthCard->save();
                $issuehealthCard_id = DB::getPdo()->lastInsertId();

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
                $admin->referred_by = $findmainid['id'];
                $admin->password = bcrypt($data['password']);
                $admin->created_by = $findmainid['id'];
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

                return redirect('HealthCard-Type-Wise-From/'.$slug)->with('success_message', $message);
            }
        $healthcardtype  = HealthCard::where('status',1)->where('slug','=',$slug)->first();
        $state = DB::table('states')->where('status', '1')->get();
        $get_setting_data= DB::table('settings')->first();
       return view('front.HealthCard.HealthCard_Type_Wise_From')->with(compact('healthcardtype','state','get_setting_data'));
    }
}
