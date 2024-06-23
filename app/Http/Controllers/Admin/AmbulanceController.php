<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use App\Models\AddMultiImages;
use App\Models\PatientDetails;
use Illuminate\Support\Carbon;
use App\Models\AmbulancekmCharge;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AmbulanceController extends Controller
{
    // public function DoctorDashboard()
    // {
    //         $todayDate = Carbon::now()->format('Y-m-d');
    //         $thisMonth = Carbon::now()->format('m');
    //         $thisYear = Carbon::now()->format('Y');
    //         if (Auth::guard('admin')->user()->type == 'admin') {
    //             $totalPatientDetails = PatientDetails::where('ambulance_id','!=',0)->count();

    //         $todayPatientDetails = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereDate('created_at', $todayDate)->count();
    //         $thisMonthPatientDetails = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
    //         $thisYearPatientDetails = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereYear('created_at', $thisYear)->count();

    //         $totalPatientDetailsadiscountamount = PatientDetails::where('ambulance_id','!=',0)->sum('paitent_discount_amount');
    //         $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
    //         $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
    //         $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

    //         $totalPatientdischargeamount = PatientDetails::where('ambulance_id','!=',0)->sum('after_discount_finall_bill');
    //         $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
    //         $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
    //         $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


    //         $totalcompanycommission = PatientDetails::where('ambulance_id','!=',0)->sum('company_commission_amount');
    //         $totalDaycompanycommission = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
    //         $totalMonthscompanycommission = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
    //         $totalYearcompanycommission = DB::table('add_paitent_details')->where('ambulance_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
    //     }
    //     else{
    //         $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
    //         $totalPatientDetails = PatientDetails::where('ambulance_id', $user->id)->count();

    //         $todayPatientDetails = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereDate('created_at', $todayDate)->count();
    //         $thisMonthPatientDetails = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereMonth('created_at', $thisMonth)->count();
    //         $thisYearPatientDetails = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereYear('created_at', $thisYear)->count();

    //         $totalPatientDetailsadiscountamount = PatientDetails::where('ambulance_id', $user->id)->sum('paitent_discount_amount');
    //         $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
    //         $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
    //         $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

    //         $totalPatientdischargeamount = PatientDetails::where('ambulance_id', $user->id)->sum('after_discount_finall_bill');
    //         $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
    //         $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
    //         $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


    //         $totalcompanycommission = PatientDetails::where('ambulance_id', $user->id)->sum('company_commission_amount');
    //         $totalDaycompanycommission = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
    //         $totalMonthscompanycommission = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
    //         $totalYearcompanycommission = DB::table('add_paitent_details')->where('ambulance_id', $user->id)->whereYear('created_at', $thisYear)->sum('company_commission_amount');

    //     }

    //         return view('admin.doctor.doctor_dashboard')->with(compact(
    //             'totalPatientDetails',
    //             'todayPatientDetails',
    //             'thisMonthPatientDetails',
    //             'thisYearPatientDetails',
    //             'totalDayPatientDetailsadiscountamount',
    //             'totalPatientDetailsadiscountamount',
    //             'totalMonthsPatientDetailsadiscountamount',
    //             'totalYearPatientDetailsadiscountamount',
    //             'totalDayPatientdischargeamount',
    //             'totalPatientdischargeamount',
    //             'totalMonthsPatientdischargeamount',
    //             'totalYearPatientdischargeamount',
    //             'totalDaycompanycommission',
    //             'totalcompanycommission',
    //             'totalMonthscompanycommission',
    //             'totalYearcompanycommission'
    //         ));
    // }
    public function AmbulanceList()
    {
        $ambulanceList = Ambulance::get()->toArray();
        return view('admin.ambulances.ambulance_list')->with(compact('ambulanceList'));
    }
    public function AddEditAmbulance(Request $request, $id = null)
    {
        $request->all();
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $createAmbulance = new Ambulance();
            $admin = new Admin();
            $message = "Ambulance  created  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" => "required|email|unique:admins|unique:create_ambulance",
                    "vechile_no" => "required|unique:create_ambulance",
                    'owner_name' => 'required',
                    'password' => 'required',
                    'green_card_discount' => 'required',
                    'silver_card_discount' => 'required',
                    'gold_card_discount' => 'required',
                    'company_discount' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                     'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];
                $customMessages = [

                    'owner_name.required' => 'Name is Requried',
                    'vechile_no' =>'This Vechile no is allready Exists.',
                    'password.required' => 'Password is Requried',
                    "email.required" => "Email is Required",
                    "email.unique" => " Email Already Exists",
                    'assign_state.required' => 'assign_state is Requried',
                    'assign_district.required' => 'assign_district is Requried',
                    'assign_city.required' => 'assign_city is Requried',
                    "assign_state.exists" =>" This State Is Not Assign Yet. Plz Select Another State Which Is Exist Or Contact To Admin",
                    "assign_district.exists" =>" This District Is Not Assign Yet. Plz Select Another District Which Is Exist Or Contact To Admin",
                    "assign_city.exists" =>" This City Is Not Assign Yet. Plz Select Another City Which Is Exist Or Contact To Admin",


                ];

                $this->validate($request, $rules, $customMessages);


                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/ambulance/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createAmbulance->image = $imageName;
                    }
                } else {
                    $createAmbulance->image = "";
                }
                if ($files = $request->file('vechile_documnet')) {
                    $destinationPath = 'admin_assets/uploads/ambulance_vechile_documnet/'; // upload path
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $post['vechile_documnet'] = "$profileImage";
                    $createAmbulance->vechile_documnet = $profileImage;
                }

                if ($files = $request->file('vechile_insur_doc')) {
                    $destinationPath = 'admin_assets/uploads/ambulance_vechile_insur_doc/'; // upload path
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $post['vechile_insur_doc'] = "$profileImage";
                    $createAmbulance->vechile_insur_doc = $profileImage;
                }
            
                $spom = 'ID-HCMS-' . rand(1111, 9999);

                $createAmbulance->owner_name = $data['owner_name'];
                $createAmbulance->email = $data['email'];
                $createAmbulance->address = $data['address'];
                $createAmbulance->state = $data['assign_state'];
                $createAmbulance->district = $data['assign_district'];
                $createAmbulance->city = $data['assign_city'];
                $createAmbulance->pincode = $data['pincode'];
                $createAmbulance->mobile = $data['mobile'];
                $createAmbulance->vechile_no = $data['vechile_no'];
                $createAmbulance->green_card_discount = $data['green_card_discount'];
                $createAmbulance->silver_card_discount = $data['silver_card_discount'];
                $createAmbulance->gold_card_discount = $data['gold_card_discount'];
                $createAmbulance->company_discount = $data['company_discount'];
                $createAmbulance->member_id = $spom;
                $createAmbulance->created_by = Auth::guard('admin')->user()->id;
                $createAmbulance->status = 1;
                $createAmbulance->save();
                $createAmbulance_id = DB::getPdo()->lastInsertId();
                $createAmbulance->ambulance_id = $createAmbulance_id;
                $createAmbulance->save();


                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Ambulance';
                $admin->ambulance_id = $createAmbulance_id;
                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];
                $admin->name = $data['owner_name'];
                $admin->mobile = $data['mobile'];
                $admin->email = $data['email'];
                $admin->member_id = $spom;
                $admin->password = bcrypt($data['password']);
                $admin->created_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();


                //Send Conifirmation Email
                // $email= $data['email'];
                // $messageData=[
                //     'email' =>$data['email'],
                //     'password' =>$data['password'],
                //     'name' =>$data['name'],
                //     'mobile' =>$data['mobile'],
                // ];
                // Mail::send('emails.ambulance',$messageData,function($message)use($email){
                //     $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Ambulance');
                // });

                //   Send Login Sms


                DB::commit();

                return redirect('admin/Ambulance-List')->with('success_message', $message);
            }
        } else {

            $title = "Edit ";
            $createAmbulance = Ambulance::find($id);
            $admin =  Admin::where('ambulance_id', '=', $id)->first();
            $message = "Ambulance Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'owner_name' => 'required',
                    'green_card_discount' => 'required',
                    'silver_card_discount' => 'required',
                    'gold_card_discount' => 'required',
                    'company_discount' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                ];
                $customMessages = [

                    'owner_name.required' => 'owner_name is Requried',
                    'assign_state.required' => 'assign_state is Requried',
                    'assign_district.required' => 'assign_district is Requried',
                    'assign_city.required' => 'assign_city is Requried',
                    "assign_state.exists" =>" This State Is Not Assign Yet. Plz Select Another State Which Is Exist Or Contact To Admin",
                    "assign_district.exists" =>" This District Is Not Assign Yet. Plz Select Another District Which Is Exist Or Contact To Admin",
                    "assign_city.exists" =>" This City Is Not Assign Yet. Plz Select Another City Which Is Exist Or Contact To Admin",
                ];
                $this->validate($request, $rules, $customMessages);
                $createAmbulance->owner_name = $data['owner_name'];
                $createAmbulance->address = $data['address'];
                $createAmbulance->state = $data['assign_state'];
                $createAmbulance->district = $data['assign_district'];
                $createAmbulance->city = $data['assign_city'];
                $createAmbulance->pincode = $data['pincode'];
                $createAmbulance->mobile = $data['mobile'];
                $createAmbulance->green_card_discount = $data['green_card_discount'];
                $createAmbulance->silver_card_discount = $data['silver_card_discount'];
                $createAmbulance->gold_card_discount = $data['gold_card_discount'];
                $createAmbulance->company_discount = $data['company_discount'];
                $createAmbulance->updated_by = Auth::guard('admin')->user()->id;
                $createAmbulance->status = 1;
                $createAmbulance->save();
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];
                $admin->name = $data['owner_name'];
                $admin->mobile = $data['mobile'];
                $admin->updated_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();
                DB::commit();
                return redirect('admin/Ambulance-List')->with('success_message', $message);
            }
        }


        $state = DB::table('states')->where('status', '1')->get();
        return view('admin.ambulances.add_edit_ambulances')->with(compact('title', 'createAmbulance', 'state'));
    }
    
    public function DeleteAmbulance($id)
    {
        Session::put('page', 'Ambulance-List');

        $deleted_data = DB::table('create_ambulance')->where('id', $id)->first();
        try {
            DB::table('create_ambulance')->where('id', $id)->delete();
            DB::table('admins')->where('ambulance_id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Ambulance-List')->withErrors([' Data Deleted successfully ']);
    }
    public function ChangeAmbulanceListStatus(Request $request)
    {
        Session::put('page', 'Ambulance-List');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('create_ambulance')
            ->where('id', $status_id)
            ->first();

        DB::table('create_ambulance')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        DB::table('admins')
            ->where('ambulance_id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        $message = " Ambulance Status Is  Updated Sucessfully!.";
        return redirect('admin/Ambulance-List')->with('success_message', $message);
    }
    public function AmbulanceKmCharges_list()
    {
        $ambulance_charges_list =AmbulancekmCharge::get();
        return view('admin.ambulances.ambulance_charges_list')->with(compact('ambulance_charges_list'));
    }
    public function  AmbulanceKmCharges_listedit($id)
    {
        $AmbulanceChargeskm = AmbulancekmCharge::find($id);
        return view('admin.ambulances.ambulance_km_charges')->with(compact('AmbulanceChargeskm'));
    }
    public function AmbulanceKmChargesave(Request $request,$id)
    {
        // return  $data = $request->all();
        
          $AmbulanceChargeskm = AmbulancekmCharge::find($id);
        $message = "Ambulance Update Successfully!";
      
         $data = $request->all();
            // $rules = [
            //     'kilo_meter' => 'required',
            //     'km_charges	' => 'required',
            // ];
            // $this->validate($request, $rules);
            $AmbulanceChargeskm->kilo_meter = $data['kilo_meter'];
            $AmbulanceChargeskm->km_charges = $data['km_charges'];
            $AmbulanceChargeskm->save();
           return redirect('admin/Ambulance-Km-Charges')->with('success_message', $message);
      
    }
}
