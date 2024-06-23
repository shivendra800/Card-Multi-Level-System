<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Reviews;
use App\Models\Pathologys;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PatientDetails;
use Illuminate\Support\Carbon;
use App\Models\IssueHealthCard;
use App\Models\PathologyTestType;
use App\Models\AddPathPatientTest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Models\HospitalCommisionReocrd;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PathologyController extends Controller
{
    public function PathologyDashboard()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        if (Auth::guard('admin')->user()->type == 'admin') {
            $totalPatientDetails = PatientDetails::where('pathology_id','!=',0)->count();

        $todayPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->count();
        $thisMonthPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
        $thisYearPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->count();

        $totalPatientDetailsadiscountamount = PatientDetails::where('pathology_id','!=',0)->sum('paitent_discount_amount');
        $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
        $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
        $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

        $totalPatientdischargeamount = PatientDetails::where('pathology_id','!=',0)->sum('after_discount_finall_bill');
        $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
        $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
        $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


        $totalcompanycommission = PatientDetails::where('pathology_id','!=',0)->sum('company_commission_amount');
        $totalDaycompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
        $totalMonthscompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
        $totalYearcompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
    }
    else{
        $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $totalPatientDetails = PatientDetails::where('pathology_id', $user->id)->count();

        $todayPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereDate('created_at', $todayDate)->count();
        $thisMonthPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereMonth('created_at', $thisMonth)->count();
        $thisYearPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereYear('created_at', $thisYear)->count();

        $totalPatientDetailsadiscountamount = PatientDetails::where('pathology_id', $user->id)->sum('paitent_discount_amount');
        $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
        $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
        $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

        $totalPatientdischargeamount = PatientDetails::where('pathology_id', $user->id)->sum('after_discount_finall_bill');
        $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
        $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
        $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


        $totalcompanycommission = PatientDetails::where('pathology_id', $user->id)->sum('company_commission_amount');
        $totalDaycompanycommission = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
        $totalMonthscompanycommission = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
        $totalYearcompanycommission = DB::table('add_paitent_details')->where('pathology_id', $user->id)->whereYear('created_at', $thisYear)->sum('company_commission_amount');

    }
        return view('admin.pathology.pathology_dashboard')->with(compact(
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
            'totalYearcompanycommission'
        ));
    }
    public function PathologyList()
    {
        $pathologyList = Pathologys::get()->toArray();
        return view('admin.pathology.pathology_list')->with(compact('pathologyList'));
    }
    public function ViewPathologyDetails($id)
    {
        $createPathology = Pathologys::find($id);
        $title = "View";
        $state = DB::table('states')->where('status', '1')->get();
        return view('admin.pathology.view_pathology_list')->with(compact('createPathology','state','title'));
    }
    public function ADDEditPathology(Request $request,$id=null)
    {
        $request->all();
        Session::put('page', 'Pathology-List');
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $createPathology = new Pathologys();
            $admin = new Admin();
            $message = "Pathology  created  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" => "required|email|unique:admins|unique:create_pathologys",
                    'clininc_name' => 'required|unique:create_pathologys',
                    'name' => 'required',
                    'password' => 'required',
                    'green_card_discount' => 'required',
                    'silver_card_discount' => 'required',
                    'gold_card_discount' => 'required',
                    'company_discount' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                ];
                $customMessages = [

                    'name.required' => 'Name is Requried',
                    "clininc_name.unique" => " This Pathology Name is  Already Exists",
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
                        $imagePath = 'admin_assets/uploads/Pathology/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createPathology->image = $imageName;
                    }
                } else {
                    $createPathology->image = "";
                }
                $spom = 'ID-HCMS-' . rand(1111, 9999);

                $createPathology->name = $data['name'];
                $createPathology->clininc_name = $data['clininc_name'];
                $createPathology->slug =str_replace(' ', '-', $data['clininc_name']);
                $createPathology->email = $data['email'];
                $createPathology->password = bcrypt($data['password']);
                $createPathology->address = $data['address'];
                $createPathology->state = $data['assign_state'];
                $createPathology->district = $data['assign_district'];
                $createPathology->city = $data['assign_city'];
                $createPathology->pincode = $data['pincode'];
                $createPathology->mobile = $data['mobile'];
                $createPathology->contact_person_mobile = $data['contact_person_mobile'];
                $createPathology->contact_person_name = $data['contact_person_name'];
                $createPathology->green_card_discount = $data['green_card_discount'];
                $createPathology->silver_card_discount = $data['silver_card_discount'];
                $createPathology->gold_card_discount = $data['gold_card_discount'];
                $createPathology->company_discount = $data['company_discount'];
                $createPathology->member_id = $spom;
                $createPathology->created_by = Auth::guard('admin')->user()->id;
                $createPathology->status = 1;
                $createPathology->save();
                $createPathology_id = DB::getPdo()->lastInsertId();
                $createPathology->pathology_id = $createPathology_id;
                $createPathology->save();

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Pathology';
                $admin->pathology_id = $createPathology_id;
                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];
                $admin->name = $data['name'];
                $admin->mobile = $data['mobile'];
                $admin->email = $data['email'];
                $admin->member_id = $spom;
                $admin->password = bcrypt($data['password']);
                $admin->created_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();
                //Send Conifirmation Email
                $email= $data['email'];
                $messageData=[
                   'email' =>$data['email'],
                   'password' =>$data['password'],
                   'name' =>$data['name'],
                   'mobile' =>$data['mobile'],
                ];
                Mail::send('emails.pathology',$messageData,function($message)use($email){
                    $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Pathology');
                });
                DB::commit();
                return redirect('admin/Pathology-List')->with('success_message', $message);
            }
        } else {

            $title = "Edit ";
            $createPathology = Pathologys::find($id);
            $admin =  Admin::where('pathology_id', '=', $id)->first();
            $message = "Pathology Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'name' => 'required',
                    'green_card_discount' => 'required',
                    'silver_card_discount' => 'required',
                    'gold_card_discount' => 'required',
                    'company_discount' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                ];
                $customMessages = [
                    'name.required' => 'Name is Requried',
                    'assign_state.required' => 'assign_state is Requried',
                    'assign_district.required' => 'assign_district is Requried',
                    'assign_city.required' => 'assign_city is Requried',
                    "assign_state.exists" =>" This State Is Not Assign Yet. Plz Select Another State Which Is Exist Or Contact To Admin",
                    "assign_district.exists" =>" This District Is Not Assign Yet. Plz Select Another District Which Is Exist Or Contact To Admin",
                    "assign_city.exists" =>" This City Is Not Assign Yet. Plz Select Another City Which Is Exist Or Contact To Admin",
                ];
                $this->validate($request, $rules, $customMessages);
                $createPathology->name = $data['name'];
                $createPathology->address = $data['address'];
                $createPathology->state = $data['assign_state'];
                $createPathology->district = $data['assign_district'];
                $createPathology->city = $data['assign_city'];
                $createPathology->pincode = $data['pincode'];
                $createPathology->mobile = $data['mobile'];
                $createPathology->contact_person_mobile = $data['contact_person_mobile'];
                $createPathology->contact_person_name = $data['contact_person_name'];
                $createPathology->green_card_discount = $data['green_card_discount'];
                $createPathology->silver_card_discount = $data['silver_card_discount'];
                $createPathology->gold_card_discount = $data['gold_card_discount'];
                $createPathology->company_discount = $data['company_discount'];
                $createPathology->updated_by = Auth::guard('admin')->user()->id;
                $createPathology->status = 1;
                $createPathology->save();
                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];
                $admin->name = $data['name'];
                $admin->mobile = $data['mobile'];
                $admin->updated_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();
                DB::commit();
                return redirect('admin/Pathology-List')->with('success_message', $message);
            }
        }


        $state = DB::table('states')->where('status', '1')->get();
        return view('admin.pathology.add_edit_pathology')->with(compact('title', 'createPathology', 'state'));
    }
    public function DeletePathology($id)
    {
        Session::put('page', 'Pathology-List');

        $deleted_data = DB::table('create_pathologys')->where('id', $id)->first();
        try {
            DB::table('create_pathologys')->where('id', $id)->delete();
            DB::table('admins')->where('pathology_id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Pathology-List')->withErrors([' Data Deleted successfully ']);
    }
    public function ChangePathologyListStatus(Request $request)
    {
        Session::put('page', 'Pathology-List');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('create_pathologys')
            ->where('id', $status_id)
            ->first();

        DB::table('create_pathologys')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        DB::table('admins')
            ->where('pathology_id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        if($request->get('status')==1){
            $message = " Pathology Status Is Active  Updated Sucessfully!.";
            return redirect('admin/Pathology-List')->with('success_message', $message);
        }else{
            $message = " Pathology Status Is InActive  Updated Sucessfully!.";
            return redirect('admin/Pathology-List')->with('error_message', $message);
        }
    
    }
    // pathology test type 
    public function Pathtesttype()
    {
       Session::put('page','Pathtest');
       $pathtests = PathologyTestType::where('pathology_id',Auth::guard('admin')->user()->pathology_id)->get()->toArray();
       return view('admin.pathology.pathology_type.pathtests_list')->with(compact('pathtests'));
    }
    public function AddEditPathtesttype(Request $request,$id=null)
    {

       Session::put('page','PathtestType');
       if ($id == "") {
           $title = "Add ";
           $Pathtest = new PathologyTestType();
           $message = "Pathtesttype  Add Successfully!";
       } else {
           $title = "Edit ";
           $Pathtest = PathologyTestType::find($id);
           $message = "Pathtest Update Successfully!";
       }
       if($request->isMethod('post')){
           $data = $request->all();
           $rules = [
               'name' => 'required|regex:/^[\pL\s\-]+$/u|max:30',
               'test_charge' => 'required',
           ];
           $customMessages = [
               'name.required' => ' pathtests Name is Requried',
               'name.regex' => 'Valid pathtests Name is Requried',
           ];
           $this->validate($request, $rules, $customMessages);
           $Pathtest->pathology_id = Auth::guard('admin')->user()->pathology_id;
           $Pathtest->name = $data['name'];
           $Pathtest->test_charge = $data['test_charge'];
           $Pathtest->status= 1;
           $Pathtest->save();
           return redirect('admin/Pathtesttype')->with('success_message', $message);
       }

       return view('admin.pathology.pathology_type.add_edit_pathtests')->with(compact('title','Pathtest'));
    }
    public function ChangePathtesttypeStatus(Request $request)
    {
        Session::put('page','Pathtest');
        $status_id=$request->get('status_id');

        $statuschange=DB::table('pathologytesttype')
            ->where('id',$status_id)
            ->first();

        DB::table('pathologytesttype')
        ->where('id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        if($request->get('status')==1){
            $message = " Pathology Type Status Is Active  Updated Sucessfully!.";
            return redirect('admin/Pathtesttype')->with('success_message', $message);
        }else{
            $message = " Pathology Type Status Is InActive  Updated Sucessfully!.";
            return redirect('admin/Pathtesttype')->with('success_message', $message);
        }

    }

    public function DeletePathtesttype($id)
    {
        Session::put('page','Pathtest');

        $deleted_data=DB::table('pathologytesttype')->where('id',$id)->first();
        try{
            DB::table('pathologytesttype')->where('id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Pathtesttype')->withErrors([' Data Deleted successfully ']);
    }
    public function PathHealthCardcustomer()
    {
        $tabledata = DB::table('create_health_card')->get()->take(0);
        return view('admin.pathology.search_pathhealthcard_cust')->with(compact('tabledata'));
    }
    public function PathHealthCardCustomerDetailSearch(Request $request)
    {
        $keyword = $request->get('keyword');
        $tabledata = DB::table('create_health_card')
            ->where(function ($query) use ($keyword) {
                $query->where('create_health_card.health_card_issue_id_no', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('create_health_card.email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('create_health_card.aadhar_no', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('create_health_card.mobile', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('create_health_card.member_id', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('admin.pathology.search_pathhealthcard_cust')->with(compact('tabledata'));
    }

    public function PathHCCustomerDetailsview($id)
    {
        $tabledata = IssueHealthCard::join('cities', 'cities.id', '=', 'create_health_card.assign_city')
            ->join('states', 'states.id', '=', 'create_health_card.assign_state')
            ->join('districts', 'districts.id', '=', 'create_health_card.assign_district')
            ->join('health_card_type', 'health_card_type.id', '=', 'create_health_card.health_card_type')
            ->select(
                'create_health_card.*',
                'cities.city_name',
                'states.state_name',
                'districts.district_name',
                'health_card_type.health_card_type as health_card_type_name'
            )
            ->find($id);
        // dd($tabledata);
        return view('admin.pathology.search_pathhealthcard_customer_view')->with(compact('tabledata'));
    }

    public function AddpathPaitentDetails(Request $request, $id = null)
    {

        Session::put('page', 'Path-Patient-List');
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $createhospital = new PatientDetails();
            $message = "Path-Patient Added  Successfully!";
            $hospitalList = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $hospdiscount = Pathologys::where('id', '=', $hospitalList->pathology_id)->first();
            if ($request->get('paitent_health_card_type') == 'Green Health Discount card') {
                $patient_dis =   $hospdiscount->green_card_discount;
            }
            if ($request->get('paitent_health_card_type') == 'Silver Health Discount Card') {
                $patient_dis =   $hospdiscount->silver_card_discount;
            }
            if ($request->get('paitent_health_card_type') == 'Gold  Health Discount card') {
                $patient_dis =   $hospdiscount->gold_card_discount;
            }
            if ($request->isMethod('post')) {
                $data = $request->all();
                $hospital_reg = 'Patholoy-Reg' . rand(1111, 9999);
                $createhospital->paitent_registration_number = $hospital_reg;
                $createhospital->paitent_admit_date = date('Y-m-d H:i:s');
                $createhospital->paitent_name = $data['paitent_name'];
                $createhospital->paitent_mobile = $data['paitent_mobile'];
                $createhospital->paitent_email = $data['paitent_email'];
                $createhospital->paitent_dob = $data['paitent_dob'];
                $createhospital->health_card_issue_id_no = $data['health_card_issue_id_no'];
                $createhospital->member_id = $data['member_id'];
                $createhospital->paitent_aadhar_no = $data['paitent_aadhar_no'];
                $createhospital->paitent_pan_number = $data['paitent_pan_number'];
                $createhospital->paitent_father_name = $data['paitent_father_name'];
                $createhospital->paitent_blood_group = $data['paitent_blood_group'];
                $createhospital->paitent_health_card_type = $data['paitent_health_card_type'];
                $createhospital->address = $data['address'];
                $createhospital->paitent_pincode = $data['paitent_pincode'];
                $createhospital->paitent_state = $data['paitent_state'];
                $createhospital->paitent_district = $data['paitent_district'];
                $createhospital->paitent_city = $data['paitent_city'];
                $createhospital->paitent_card_reg_start = $data['paitent_card_reg_start'];
                $createhospital->paitent_card_reg_end = $data['paitent_card_reg_end'];
                $createhospital->paitent_discount = $patient_dis;
                $createhospital->healthcard_company_commission = $hospdiscount['company_discount'];
                $createhospital->created_by = Auth::guard('admin')->user()->id;
                $createhospital->pathology_id = Auth::guard('admin')->user()->id;
                $createhospital->save();
                DB::commit();
                return redirect('admin/Pathology-Paitent-list')->with('success_message', $message);
            }
        } else {
            $title = "Edit ";
            $EditPaitent = PatientDetails::find($id);
            $message = "Path-Paitent Details Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                // if ($request->hasFile('hospital_discharge_slip')) {
                //     $image_tmp = $request->file('hospital_discharge_slip');
                //     if ($image_tmp->isValid()) {
                //         //Get Image Extension
                //         $extension = $image_tmp->getClientOriginalExtension();
                //         //Generate New Image
                //         $imageName = rand(111, 99999) . '.' . $extension;
                //         $imagePath = 'admin_assets/uploads/hospital_slip/' . $imageName;
                //         //Upload The Image
                //         Image::make($image_tmp)->save($imagePath);
                //         $EditPaitent->hospital_discharge_slip = $imageName;
                //     }
                // } else {
                //     $EditPaitent->image = "";
                // }

                $EditPaitent->paitent_admit_date = $EditPaitent['paitent_admit_date'];
                $EditPaitent->paitent_discharge_date = date('Y-m-d');
                $EditPaitent->paitent_total_bill = $data['paitent_total_bill'];
                $EditPaitent->paitent_discount_amount = $data['paitent_discount_amount'];
                $EditPaitent->company_commission_amount = $data['company_commission_amount'];
                $EditPaitent->hospital_amt_atr_cmp_comm = $data['hospital_amt_atr_cmp_comm'];
                $EditPaitent->after_discount_finall_bill = $data['after_discount_finall_bill'];
                $EditPaitent->updated_by = Auth::guard('admin')->user()->id;
                $EditPaitent->save();
                $hospitalList = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $hospitaldel = Pathologys::where('id', '=', $hospitalList->pathology_id)->first();
                $total_commision_HelloIndia = $hospitaldel->total_commission_hicl + $data['company_commission_amount'];
                $hospitaldel->total_commission_hicl = $total_commision_HelloIndia;
                $hospitaldel->save();
                // state district city commission distributin only 50 % rest 50% got admin

                $getcommission = DB::table('commission_reqistation_amount')->where('admin_type', 'Pathology')->first();
                $getstate =  $hospitalList->state;
                $getdistrict =  $hospitalList->district;
                $getdistrict =  $hospitalList->city;
                $dividefiftyperofcompany_commission_amount_to_admin = ($data['company_commission_amount']) / 2;
                $state_commison = $data['company_commission_amount'] *  $getcommission->state_commission / 100;
                $ditrict_commison = $data['company_commission_amount'] *  $getcommission->district_commission / 100;
                $city_commison = $data['company_commission_amount'] *  $getcommission->city_commission / 100;

                $data_insert_to_wallet_healthcard = array(
                    'user_type' => 'Pathology',
                    'pathology_id' => Auth::guard('admin')->user()->id,
                    'clininc_name' => $hospitaldel->clininc_name,
                    'admin_per' => '50',
                    'admin_per_amount' => $dividefiftyperofcompany_commission_amount_to_admin,
                    'state_per' => $getcommission->state_commission,
                    'state_per_amount' => $state_commison,
                    'district_per' => $getcommission->district_commission,
                    'district_per_amount' => $ditrict_commison,
                    'city_per' => $getcommission->city_commission,
                    'city_per_amount' => $city_commison,
                    'remark' => 'Path Patient Discharge Commission Distribution',

                );
                DB::table('wallet_pathologys')->insert($data_insert_to_wallet_healthcard);
                //    total_wallet data integration
                //   insert data in to total_withdraw_trasection
                $find_parent_id =  DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
                $find_parent_state = Admin::where('assign_state', $find_parent_id->state)->where('assign_district', 0)->where('assign_city', 0)->first();
                $find_parent_district = Admin::where('assign_district', $find_parent_id->district)->where('assign_state', $find_parent_state->assign_state)->where('assign_city', 0)->first();
                $find_parent_city = Admin::where('assign_city', $find_parent_id->city)->where('assign_state', $find_parent_state->assign_state)->where('assign_district', $find_parent_district->assign_district)->first();

                $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_city->id)->first();
                if ($check_inserted_id != null) {
                    $total_healthcard_amount = $check_inserted_id->pathology_commision + $city_commison;
                    $total_amount = $check_inserted_id->total + $city_commison;
                    $inser_total_withdraw_trasection = array(
                        'total' => $total_amount,
                        'pathology_commision' => $total_healthcard_amount,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'update_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_city->id)->update($inser_total_withdraw_trasection);
                } else {
                    $inser_total_withdraw_trasection = array(
                        'admin_id' => $find_parent_city->id,
                        'pathology_commision' => $city_commison,
                        'wallet_total_amount' => 0,
                        'level_income_value' => 0,
                        'total' => $city_commison,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                }
                // for district inservtion
                $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_district->id)->first();
                if ($check_inserted_id != null) {
                    $total_healthcard_amount = $check_inserted_id->pathology_commision + $ditrict_commison;
                    $total_amount = $check_inserted_id->total + $ditrict_commison;
                    $inser_total_withdraw_trasection = array(
                        'total' => $total_amount,
                        'pathology_commision' => $total_healthcard_amount,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'update_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_district->id)->update($inser_total_withdraw_trasection);
                } else {
                    $inser_total_withdraw_trasection = array(
                        'admin_id' => $find_parent_district->id,
                        'pathology_commision' => $ditrict_commison,
                        'level_income_value' => 0,
                        'total' => $ditrict_commison,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                }
                // for district insertion

                // For State Start
                $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_state->id)->first();
                if ($check_inserted_id != null) {
                    $total_healthcard_amount = $check_inserted_id->pathology_commision + $state_commison;
                    //    $total_amount =  $total_healthcard_amount + $check_inserted_id->wallet_total_amount;
                    $total_amount = $check_inserted_id->total + $state_commison;
                    $inser_total_withdraw_trasection = array(
                        'total' => $total_amount,
                        'pathology_commision' => $total_healthcard_amount,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'update_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_state->id)->update($inser_total_withdraw_trasection);
                } else {
                    $inser_total_withdraw_trasection = array(
                        'admin_id' => $find_parent_state->id,
                        'pathology_commision' => $state_commison,
                        'total' => $state_commison,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::guard('admin')->user()->id,
                    );
                    DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                }
                // End Start
                // end hre totalwallet
 
                DB::commit();
                return redirect('admin/Pathology-Paitent-list')->with('success_message', $message);
            }
        }
        $state = DB::table('states')->where('status', '1')->get();
        $totalPaitentTypeTest = AddPathPatientTest::where('Paitent_id','=',$id)->sum('test_rate');
        return view('admin.pathology.edit_path_paitent_details')->with(compact('title', 'EditPaitent','totalPaitentTypeTest'));
    }
    public function pathpaitentlist()
    {
        $paitentlist = PatientDetails::where('pathology_id', Auth::guard('admin')->user()->id)->where('add_paitent_details.paitent_discharge_date', '=', null)->get();
        return view('admin.pathology.Path_paitent_list')->with(compact('paitentlist'));
    }
    public function AddPathpatienttest(Request $request, $id)
    {
            $createTestType = new AddPathPatientTest();
            $paitentlist = PatientDetails::find($id);
            $message = "Path-Patient Added  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
               
                $pathtestype = PathologyTestType::where('pathology_id',Auth::guard('admin')->user()->pathology_id)->where('id',$data['pathology_test_id'])->first();  
                $createTestType->pathology_id =Auth::guard('admin')->user()->pathology_id;
                $createTestType->pathology_test_id	 =$data['pathology_test_id'] ;
                $createTestType->Paitent_id =$id;
                $createTestType->test_name =$pathtestype['name'];
                $createTestType->test_rate =$data['test_rate']; 
                $createTestType->save();

                return redirect('admin/add-path-paitent-test/'.$id)->with('success_message', $message);
            }
       
        $pathtestype = PathologyTestType::where('pathology_id',Auth::guard('admin')->user()->pathology_id)->get();
        $PaitentTypeTest = AddPathPatientTest::where('Paitent_id','=',$id)->get();
        return view('admin.pathology.add_edit_pathology_patient_test')->with(compact('pathtestype','paitentlist','PaitentTypeTest'));
    }
    public  function testtype_wise_amount($id)
    {
        try {
          
            $tes_amount = DB::table('pathologytesttype')->where('id',$id)->first();
            $json['api_status'] = "OK";
            $json['data'] = $tes_amount;
            $json['msg'] = "";
        } catch (\Exception $e) {
            DB::rollback();
            
            $json['api_status'] = "ERROR";
            $json['msg'] = "Error-" . $e->getLine() . " :- " . $e->getMessage();
            
        }
        header('Content-type: application/json');
        echo json_encode($json);
    }
    public function DeletePaitenttesttype($id)
    {
        $deleted_data=DB::table('add_paitent_wise_test')->where('id',$id)->first();
        try{
            DB::table('add_paitent_wise_test')->where('id',$id)->delete();
            return redirect()->back();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function paitentTestcompletelist()
    {
        $paitentlist = PatientDetails::where('pathology_id', Auth::guard('admin')->user()->id)->where('add_paitent_details.paitent_discharge_date', '!=', null)->get();
        return view('admin.pathology.paitent_discharge_list')->with(compact('paitentlist'));
    }
    public function paitentTestCompletedetails($id)
    {
            $dischargepatientdetails = PatientDetails::find($id);
            $paitenttestList =AddPathPatientTest::where('Paitent_id','=',$id)->get();
        return view('admin.pathology.paitent_dishargelist_details')->with(compact('dischargepatientdetails','paitenttestList'));
    }
    public function PathologyCustomerWiseInovice()
    {
        
           $paitentlist = PatientDetails::where('member_id', '=', Auth::guard('admin')->user()->member_id)->where('add_paitent_details.paitent_discharge_date', '!=', null)->where('pathology_id','!=',0)->get();
        return view('admin.pathology.paitent_discharge_list')->with(compact('paitentlist'));
    }
    public function viewPathologyPaitentbill($id)
    {
        $InvoiceData = PatientDetails::join('cities', 'cities.id', '=', 'add_paitent_details.paitent_city')
            ->join('states', 'states.id', '=', 'add_paitent_details.paitent_state')
            ->join('districts', 'districts.id', '=', 'add_paitent_details.paitent_district')
            ->join('add_paitent_wise_test', 'add_paitent_wise_test.Paitent_id', '=', 'add_paitent_details.id')
            ->select('add_paitent_details.*','states.state_name','districts.district_name','add_paitent_wise_test.*')->find($id);

            $paitenttestList =AddPathPatientTest::where('Paitent_id','=',$id)->get();
            
        return view('admin.pathology.view_paitent_bill')->with(compact('InvoiceData','paitenttestList'));
    }
    
    public function PathologyCommissionReciver(Request $request, $id)
    {
        $createhospital = Pathologys::find($id);
        $hsopitalCommisionReicver =  new HospitalCommisionReocrd;
        $message = " Amount Has Been Recive  Successfully!";

        if ($request->isMethod('post')) {
            $data = $request->all();
            if($createhospital['total_commission_hicl'] >=$data['amount_recive'])
            {
                if ($request->hasFile('receive_slip')) {
                    $image_tmp = $request->file('receive_slip');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/receive_slip/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $hsopitalCommisionReicver->receive_slip = $imageName;
                    }
                } else {
                    $hsopitalCommisionReicver->image = "";
                }

                $remaingAmount = $createhospital['total_commission_hicl'] - $data['amount_recive'];
                $hsopitalCommisionReicver->pathology_id = $createhospital['id'];
                $hsopitalCommisionReicver->amount_recive = $data['amount_recive'];
                $hsopitalCommisionReicver->reciver_name = $data['reciver_name'];
                $hsopitalCommisionReicver->total_amount = $createhospital['total_commission_hicl'];
                $hsopitalCommisionReicver->remaing_amount = $remaingAmount;
                $hsopitalCommisionReicver->save();

                $createhospital->total_commission_hicl = $remaingAmount;
                $createhospital->save();

                return redirect('admin/Pathology-List')->with('success_message', $message);
            }else{
                $message = "Total Commission Amount ".$createhospital['total_commission_hicl']." >= ".$data['amount_recive']." is not Less than or Equall to ! .This Amount Can Not Be Receive Please try AnyOther Amount.";
                return redirect('admin/Pathology-List')->with('error_message', $message);
            }
        }
        $hospitalCommisisonHistory = HospitalCommisionReocrd::where('pathology_id', $id)->get();
        return view('admin.pathology.pathology_add_commission_record')->with(compact('createhospital', 'hospitalCommisisonHistory'));
    }
    public function PathPaymentReciptComp()
    {
        $paymentRecpitOfComm = DB::table('hospital_commision_record_admin')->where('pathology_id',Auth::guard('admin')->user()->pathology_id)->get();
           $hosdelt = Admin::where('id',Auth::guard('admin')->user()->id)->first();
                $hospitlaTotalComm = Pathologys::where('pathology_id',$hosdelt->pathology_id)->first();
            return view('admin.pathology.pathology_payment_recipt_histroy')->with(compact('paymentRecpitOfComm','hospitlaTotalComm'));
    }
    public function PathologyWisePaitentList($id)
    {
        $createdoctor = Pathologys::find($id);
        $admin =  Admin::where('pathology_id', '=', $id)->first();
        $paitentlist = PatientDetails::where('pathology_id', $admin['id'])->get();

        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalPatientDetails = PatientDetails::where('pathology_id', $admin['id'])->count();
        $todayPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereDate('created_at', $todayDate)->count();
        $thisMonthPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereMonth('created_at', $thisMonth)->count();
        $thisYearPatientDetails = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereYear('created_at', $thisYear)->count();

        $totalcompanycommission = PatientDetails::where('pathology_id', $admin['id'])->sum('company_commission_amount');
        $totalDaycompanycommission = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereDate('created_at', $todayDate)->sum('company_commission_amount');
        $totalMonthscompanycommission = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
        $totalYearcompanycommission = DB::table('add_paitent_details')->where('pathology_id', $admin['id'])->whereYear('created_at', $thisYear)->sum('company_commission_amount');

        return view('admin.pathology.pathology_wise_paitent_list')->with(compact(
            'paitentlist',
            'totalPatientDetails',
            'todayPatientDetails',
            'thisMonthPatientDetails',
            'thisYearPatientDetails',
            'totalcompanycommission',
            'totalDaycompanycommission',
            'totalMonthscompanycommission',
            'totalYearcompanycommission'
        ));
    }
    

}
