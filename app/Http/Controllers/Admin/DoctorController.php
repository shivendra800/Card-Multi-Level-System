<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Doctors;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AddMoreDetails;
use App\Models\AddMultiImages;
use App\Models\BooKAppointent;
use App\Models\PatientDetails;
use Illuminate\Support\Carbon;
use App\Models\IssueHealthCard;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\PrescriptionMedicines;
use Intervention\Image\Facades\Image;
use App\Models\HospitalCommisionReocrd;
use App\Models\SpecializationHospitals;
use Illuminate\Support\Facades\Session;
use App\Models\SpecializationWiseHospitalDetails;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    public function DoctorDashboard()
    {
            $todayDate = Carbon::now()->format('Y-m-d');
            $thisMonth = Carbon::now()->format('m');
            $thisYear = Carbon::now()->format('Y');
            if (Auth::guard('admin')->user()->type == 'admin') {
                $totalPatientDetails = PatientDetails::where('doctor_id','!=',0)->count();

            $todayPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->count();
            $thisMonthPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
            $thisYearPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->count();

            $totalPatientDetailsadiscountamount = PatientDetails::where('doctor_id','!=',0)->sum('paitent_discount_amount');
            $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
            $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
            $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

            $totalPatientdischargeamount = PatientDetails::where('doctor_id','!=',0)->sum('after_discount_finall_bill');
            $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
            $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
            $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


            $totalcompanycommission = PatientDetails::where('doctor_id','!=',0)->sum('company_commission_amount');
            $totalDaycompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
            $totalMonthscompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
            $totalYearcompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
        }
        else{
            $user = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            $totalPatientDetails = PatientDetails::where('doctor_id', $user->id)->count();

            $todayPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereDate('created_at', $todayDate)->count();
            $thisMonthPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereMonth('created_at', $thisMonth)->count();
            $thisYearPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereYear('created_at', $thisYear)->count();

            $totalPatientDetailsadiscountamount = PatientDetails::where('doctor_id', $user->id)->sum('paitent_discount_amount');
            $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
            $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
            $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

            $totalPatientdischargeamount = PatientDetails::where('doctor_id', $user->id)->sum('after_discount_finall_bill');
            $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
            $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
            $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


            $totalcompanycommission = PatientDetails::where('doctor_id', $user->id)->sum('company_commission_amount');
            $totalDaycompanycommission = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
            $totalMonthscompanycommission = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
            $totalYearcompanycommission = DB::table('add_paitent_details')->where('doctor_id', $user->id)->whereYear('created_at', $thisYear)->sum('company_commission_amount');

        }

            return view('admin.doctor.doctor_dashboard')->with(compact(
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
    public function DoctorList()
    {
        $doctorList = Doctors::get()->toArray();
        return view('admin.doctor.doctor_list')->with(compact('doctorList'));
    }
    public function AddEditDoctor(Request $request, $id = null)
    {
        $request->all();
        Session::put('page', 'Doctor-List');
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $createdoctor = new Doctors();
            $admin = new Admin();
            $message = "Doctor  created  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" => "required|email|unique:admins|unique:create_doctors",
                    'clininc_name' => 'required|unique:create_doctors',
                    'name' => 'required',
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

                    'name.required' => 'Name is Requried',
                    "clininc_name.unique" => " This clininc Name is  Already Exists",
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
                        $imagePath = 'admin_assets/uploads/doctor/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createdoctor->image = $imageName;
                    }
                } else {
                    $createdoctor->image = "";
                }
                $spom = 'ID-HCMS-' . rand(1111, 9999);

                $createdoctor->name = $data['name'];
                $createdoctor->clininc_name = $data['clininc_name'];
                $createdoctor->slug =str_replace(' ', '-', $data['clininc_name']);
                $createdoctor->email = $data['email'];
                $createdoctor->password = bcrypt($data['password']);
                $createdoctor->address = $data['address'];
                $createdoctor->state = $data['assign_state'];
                $createdoctor->district = $data['assign_district'];
                $createdoctor->city = $data['assign_city'];
                $createdoctor->pincode = $data['pincode'];
                $createdoctor->mobile = $data['mobile'];
                $createdoctor->contact_person_mobile = $data['contact_person_mobile'];
                $createdoctor->contact_person_name = $data['contact_person_name'];
                $createdoctor->green_card_discount = $data['green_card_discount'];
                $createdoctor->silver_card_discount = $data['silver_card_discount'];
                $createdoctor->gold_card_discount = $data['gold_card_discount'];
                $createdoctor->company_discount = $data['company_discount'];
                $createdoctor->member_id = $spom;
                $createdoctor->created_by = Auth::guard('admin')->user()->id;
                $createdoctor->status = 1;
                $createdoctor->save();
                $createdoctor_id = DB::getPdo()->lastInsertId();
                $createdoctor->doctor_id = $createdoctor_id;
                $createdoctor->save();
                // $image = new AddMultiImages;
                // $image->image = $imageName;
                // $image->doctor_id = $createdoctor_id;
                // $image->save();


                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Clinic-Doctor';
                $admin->doctor_id = $createdoctor_id;
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
                Mail::send('emails.healthcard_user_accoun_opening',$messageData,function($message)use($email){
                    $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Clinc Doctor');
                });

                //   Send Login Sms


                DB::commit();

                return redirect('admin/Doctor-List')->with('success_message', $message);
            }
        } else {

            $title = "Edit ";
            $createdoctor = Doctors::find($id);
            $admin =  Admin::where('doctor_id', '=', $id)->first();
            $message = "Health Card Customer Update Successfully!";
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

                if ($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin_assets/uploads/doctor/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createdoctor->image = $imageName;
                    }
                } else {
                    $createdoctor->image = "";
                }

                $createdoctor->name = $data['name'];
                $createdoctor->address = $data['address'];
                $createdoctor->state = $data['assign_state'];
                $createdoctor->district = $data['assign_district'];
                $createdoctor->city = $data['assign_city'];
                $createdoctor->pincode = $data['pincode'];
                $createdoctor->mobile = $data['mobile'];
                $createdoctor->contact_person_mobile = $data['contact_person_mobile'];
                $createdoctor->contact_person_name = $data['contact_person_name'];
                $createdoctor->green_card_discount = $data['green_card_discount'];
                $createdoctor->silver_card_discount = $data['silver_card_discount'];
                $createdoctor->gold_card_discount = $data['gold_card_discount'];
                $createdoctor->company_discount = $data['company_discount'];
                $createdoctor->updated_by = Auth::guard('admin')->user()->id;
                $createdoctor->status = 1;
                $createdoctor->save();


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
                $admin->name = $data['name'];
                $admin->mobile = $data['mobile'];
                $admin->updated_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();
                DB::commit();
                return redirect('admin/Doctor-List')->with('success_message', $message);
            }
        }


        $state = DB::table('states')->where('status', '1')->get();
        return view('admin.doctor.add_edit_doctor')->with(compact('title', 'createdoctor', 'state'));
    }
    
    public function DeleteDoctor($id)
    {
        Session::put('page', 'Doctor-List');

        $deleted_data = DB::table('create_doctors')->where('id', $id)->first();
        try {
            DB::table('create_doctors')->where('id', $id)->delete();
            DB::table('admins')->where('doctor_id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Doctor-List')->withErrors([' Data Deleted successfully ']);
    }
    public function ChangeDoctorListStatus(Request $request)
    {
        Session::put('page', 'Doctor-List');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('create_doctors')
            ->where('id', $status_id)
            ->first();

        DB::table('create_doctors')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        DB::table('admins')
            ->where('doctor_id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        $message = " Doctor Status Is  Updated Sucessfully!.";
        return redirect('admin/Doctor-List')->with('success_message', $message);
    }
    public function DoctorMultiImages(Request $request,$id)
    {
        $addMultiImages = Doctors::find($id);
        $message = "Your Images Has Been Uploaded Successfully";
        if ($request->isMethod('post')) {
            $data = $request->all();
                                        $rules = [

                    'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];

                $this->validate($request, $rules);
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                //  echo"<pre>"; print_r($images); die;
                foreach ($images as $key => $image) {

                    $image_tmp = Image::make($image);

                    $image_name = $image->getClientOriginalName();
                    //Get Image Extension
                    $extension = $image->getClientOriginalExtension();
                    //Generate New Image After resize
                    $imageName = $image_name . rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'admin_assets/uploads/doctor/large/' . $imageName;
                    $mediumImagePath = 'admin_assets/uploads/doctor/medium/' . $imageName;
                    $smallImagePath = 'admin_assets/uploads/doctor/small/' . $imageName;
                    //Upload The Large,Medium Small Images after resize
                    Image::make($image_tmp)->resize(600, 600)->save($largeImagePath);
                    Image::make($image_tmp)->resize(447, 447)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                    $image = new AddMultiImages;
                    $image->image = $imageName;
                    $image->doctor_id = $id;
                    $image->save();
                }
            }
            return redirect()->back()->with('success_message', 'Clinic Images has been Updated successfully!');
        }

           $gethospitalWiseDetails = Doctors::with('images')->where('doctor_id', $id)->first();
          $gethospitalWiseDetails1 = DB::table('add_more_details')->where('doctor_id', $id)->first();
          $specialization = DB::table('specialization_hospitals')->get();
        return view('admin.doctor.doctor_more_details')->with(compact('gethospitalWiseDetails','gethospitalWiseDetails1','specialization'));
    }

    public function DeleteImage($id)
    {
        $deleted_data = DB::table('add_multi_images')->where('id', $id)->first();
        try {
            DB::table('add_multi_images')->where('id', $id)->delete();
            return redirect()->back();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function AddDoctorSpecializa(Request $request ,$id)
        {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $SpecializationDetails = SpecializationHospitals::where('specialization_name',$data['specialization_name'])->first();

                $SpecializationWiseHospitalDetails = new SpecializationWiseHospitalDetails;
                $SpecializationWiseHospitalDetails->doctor_id =$id;
                $SpecializationWiseHospitalDetails->specialization_id =$SpecializationDetails->id;
                $SpecializationWiseHospitalDetails->specialization_name =$data['specialization_name'];
                $SpecializationWiseHospitalDetails->save();

                return redirect('admin/Doctor-More-Details/'.$id);
            }
        }

        public function DeleteSpecialization($id)
        {
            $deleted_data = DB::table('specialization_wise_hospitals')->where('id', $id)->first();
            try {
                DB::table('specialization_wise_hospitals')->where('id', $id)->delete();
                return redirect()->back();
            } catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage())->withInput();
            }
        }

        public function DoctorMoreDetails(Request $request ,$id)
        {
    
                  $hospitaladd = AddMoreDetails::where('doctor_id',$id)->count();
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'video'  => 'mimes:mp4,mov,ogg | max:20000'
                ];
                $customMessages = [
                    'video'    => 'video  is Requried',
                ];
                $this->validate($request, $rules, $customMessages);
                  if($hospitaladd > 0){
                    $AddMoreDetails = AddMoreDetails::where('doctor_id',$id)->first();
                    if ($request->hasFile('video')) {
                        $video_tmp = $request->file('video');
                        if ($video_tmp->isValid()) {
                            //Get video Extension
                            $extension = $video_tmp->getClientOriginalExtension();
                            $videoName = rand(111, 99999) . '.' . $extension;
                            $videoPath = 'admin_assets/uploads/doctor_video/';
                            $video_tmp->move($videoPath, $videoName);
                            //Inster video name
                            $AddMoreDetails->video = $videoName;
                        }
                    } elseif (!empty($data['video'])) {
                        $videoName = $data['video'];
                    } else {
                        $videoName = "";
                    }
                    $AddMoreDetails->mon_thur = $data['mon_thur'];
                    $AddMoreDetails->time_firday = $data['time_firday'];
                    $AddMoreDetails->time_sunday = $data['time_sunday'];
                    $AddMoreDetails->description = $data['description'];
                    $AddMoreDetails->sort_description = $data['sort_description'];
                    $AddMoreDetails->higlight_point_1 = $data['higlight_point_1'];
                    $AddMoreDetails->higlight_point_2 = $data['higlight_point_2'];
                    $AddMoreDetails->doctor_id = $id;
                    $AddMoreDetails->save();
                  }else {
                    $AddMoreDetails = new AddMoreDetails;
                    if ($request->hasFile('video')) {
                        $video_tmp = $request->file('video');
                        if ($video_tmp->isValid()) {
                            //Get video Extension
                            $extension = $video_tmp->getClientOriginalExtension();
                            $videoName = rand(111, 99999) . '.' . $extension;
                            $videoPath = 'admin_assets/uploads/doctor_video/';
                            $video_tmp->move($videoPath, $videoName);
                            //Inster video name
                            $AddMoreDetails->video = $videoName;
                        }
                    } elseif (!empty($data['video'])) {
                        $videoName = $data['video'];
                    } else {
                        $videoName = "";
                    }
                    $AddMoreDetails->mon_thur = $data['mon_thur'];
                    $AddMoreDetails->time_firday = $data['time_firday'];
                    $AddMoreDetails->time_sunday = $data['time_sunday'];
                    $AddMoreDetails->description = $data['description'];
                    $AddMoreDetails->sort_description = $data['sort_description'];
                    $AddMoreDetails->higlight_point_1 = $data['higlight_point_1'];
                    $AddMoreDetails->higlight_point_2 = $data['higlight_point_2'];
                    $AddMoreDetails->doctor_id = $id;
                    $AddMoreDetails->save();
                  }
                return redirect('admin/Doctor-More-Details/'.$id);
            }
        }
        public function DoctorWisePaitentList($id)
        {
            $createdoctor = Doctors::find($id);
            $admin =  Admin::where('doctor_id', '=', $id)->first();
            $paitentlist = PatientDetails::where('doctor_id', $admin['id'])->get();
    
            $todayDate = Carbon::now()->format('Y-m-d');
            $thisMonth = Carbon::now()->format('m');
            $thisYear = Carbon::now()->format('Y');
    
            $totalPatientDetails = PatientDetails::where('doctor_id', $admin['id'])->count();
            $todayPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereDate('created_at', $todayDate)->count();
            $thisMonthPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereMonth('created_at', $thisMonth)->count();
            $thisYearPatientDetails = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereYear('created_at', $thisYear)->count();
    
            $totalcompanycommission = PatientDetails::where('doctor_id', $admin['id'])->sum('company_commission_amount');
            $totalDaycompanycommission = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereDate('created_at', $todayDate)->sum('company_commission_amount');
            $totalMonthscompanycommission = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
            $totalYearcompanycommission = DB::table('add_paitent_details')->where('doctor_id', $admin['id'])->whereYear('created_at', $thisYear)->sum('company_commission_amount');
    
            return view('admin.doctor.doctor_wise_paitent_list')->with(compact(
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
        public function DoctorCommissionReciver(Request $request, $id)
        {
            $createhospital = Doctors::find($id);
            $hsopitalCommisionReicver =  new HospitalCommisionReocrd;
            $message = " Amount Has Been Recive  Successfully!";
    
            if ($request->isMethod('post')) {
                $data = $request->all();
                                            $rules = [

                    'receive_slip'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];

                $this->validate($request, $rules);
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
                    $hsopitalCommisionReicver->doctor_id = $createhospital['id'];
                    $hsopitalCommisionReicver->amount_recive = $data['amount_recive'];
                    $hsopitalCommisionReicver->reciver_name = $data['reciver_name'];
                    $hsopitalCommisionReicver->total_amount = $createhospital['total_commission_hicl'];
                    $hsopitalCommisionReicver->remaing_amount = $remaingAmount;
                    $hsopitalCommisionReicver->save();
    
                    $createhospital->total_commission_hicl = $remaingAmount;
                    $createhospital->save();
    
                    return redirect('admin/Doctor-List')->with('success_message', $message);
                }else{
                    $message = "Total Commission Amount ".$createhospital['total_commission_hicl']." >= ".$data['amount_recive']." is not Less than or Equall to ! .This Amount Can Not Be Receive Please try AnyOther Amount.";
                    return redirect('admin/Doctor-List')->with('error_message', $message);
                }
            }
            $hospitalCommisisonHistory = HospitalCommisionReocrd::where('doctor_id', $id)->get();
            return view('admin.doctor.doctor_commission_record')->with(compact('createhospital', 'hospitalCommisisonHistory'));
        }

        public function HCCustomerDetails()
        {
            $tabledata = DB::table('create_health_card')->get()->take(0);
            return view('admin.doctor.search_healthcard_customer')->with(compact('tabledata'));
        }
    
        public function HCCustomerDetailSearch(Request $request)
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
    
            return view('admin.doctor.search_healthcard_customer')->with(compact('tabledata'));
        }

        public function HCCustomerDetailsview($id)
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
            return view('admin.doctor.search_healthcard_customer_view')->with(compact('tabledata'));
        }
        public function AddDocPaitentDetails(Request $request, $id = null)
        {
    
            Session::put('page', 'Patient-List');
            DB::beginTransaction();
            if ($id == "") {
                $title = "Add";
                $createhospital = new PatientDetails();
                $message = "Patient Added  Successfully!";
                $hospitalList = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $hospdiscount = Doctors::where('id', '=', $hospitalList->doctor_id)->first();
    
    
    
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
    
    
                    $hospital_reg = 'Doctor-Reg' . rand(1111, 9999);
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
                    $createhospital->doctor_id = Auth::guard('admin')->user()->id;
                    $createhospital->save();
                    DB::commit();
                    return redirect('admin/doc-paitent-list')->with('success_message', $message);
                }
            } else {
                $title = "Edit ";
                $EditPaitent = PatientDetails::find($id);
                $message = "Paitent Details Update Successfully!";
                if ($request->isMethod('post')) {
                    $data = $request->all();
                    $rules = [
                        'hospital_discharge_slip'=>'required|mimes:jpeg,png,jpg,zip,pdf|max:2048'
                       
                    ];
                    $customMessages = [
    
                        'hospital_discharge_slip.required' => 'Name is Requried',
                    ];
    
                    $this->validate($request, $rules, $customMessages);
                    foreach ($data['pre_medicine'] as $key => $value) {
                        if (!empty($value)) {
                            $attribute = new PrescriptionMedicines;
                            $attribute->doctor_id = Auth::guard('admin')->user()->doctor_id;
                            $attribute->patient_id = $id;
                            $attribute->paitent_caused_disease = $data['paitent_caused_disease'];
                            $attribute->pre_medicine = $data['pre_medicine'][$key];
                            $attribute->medicine_mg = $data['medicine_mg'][$key];
                            $attribute->dose_date = $data['dose_date'][$key];

                            $attribute->save();
                        }
                    }
                    if ($request->hasFile('hospital_discharge_slip')) {
                        $image_tmp = $request->file('hospital_discharge_slip');
                        if ($image_tmp->isValid()) {
                            //Get Image Extension
                            $extension = $image_tmp->getClientOriginalExtension();
                            //Generate New Image
                            $imageName = rand(111, 99999) . '.' . $extension;
                            $imagePath = 'admin_assets/uploads/doctor_slip/' . $imageName;
                            //Upload The Image
                            Image::make($image_tmp)->save($imagePath);
                            $EditPaitent->hospital_discharge_slip = $imageName;
                        }
                    } else {
                        $EditPaitent->image = "";
                    }
    
                    $EditPaitent->paitent_admit_date = $data['paitent_admit_date'];
                    $EditPaitent->paitent_discharge_date = $data['paitent_discharge_date'];
                    $EditPaitent->paitent_total_bill = $data['paitent_total_bill'];
                    $EditPaitent->paitent_discount_amount = $data['paitent_discount_amount'];
                    $EditPaitent->company_commission_amount = $data['company_commission_amount'];
                    $EditPaitent->hospital_amt_atr_cmp_comm = $data['hospital_amt_atr_cmp_comm'];
                    $EditPaitent->after_discount_finall_bill = $data['after_discount_finall_bill'];
                    $EditPaitent->updated_by = Auth::guard('admin')->user()->id;
                    $EditPaitent->save();
    
    
    
                    $hospitalList = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                    $hospitaldel = Doctors::where('id', '=', $hospitalList->doctor_id)->first();
                    $total_commision_HelloIndia = $hospitaldel->total_commission_hicl + $data['company_commission_amount'];
    
                    $hospitaldel->total_commission_hicl = $total_commision_HelloIndia;
                    $hospitaldel->save();
    
                    // state district city commission distributin only 50 % rest 50% got admin
    
                    $getcommission = DB::table('commission_reqistation_amount')->where('admin_type', 'Clinic-Doctor')->first();
                    $getstate =  $hospitalList->state;
                    $getdistrict =  $hospitalList->district;
                    $getdistrict =  $hospitalList->city;
                    $dividefiftyperofcompany_commission_amount_to_admin = ($data['company_commission_amount']) / 2;
                    $state_commison = $data['company_commission_amount'] *  $getcommission->state_commission / 100;
                    $ditrict_commison = $data['company_commission_amount'] *  $getcommission->district_commission / 100;
                    $city_commison = $data['company_commission_amount'] *  $getcommission->city_commission / 100;
    
                    $data_insert_to_wallet_healthcard = array(
                        'user_type' => 'Clinic-Doctor',
                        'doctor_id' => Auth::guard('admin')->user()->id,
                        'doctor_name' => $hospitalList->name,
                        'admin_per' => '50',
                        'admin_per_amount' => $dividefiftyperofcompany_commission_amount_to_admin,
                        'state_per' => $getcommission->state_commission,
                        'state_per_amount' => $state_commison,
                        'district_per' => $getcommission->district_commission,
                        'district_per_amount' => $ditrict_commison,
                        'city_per' => $getcommission->city_commission,
                        'city_per_amount' => $city_commison,
                        'remark' => 'Patient Discharge Commission Distribution',
    
                    );
                    DB::table('wallet_doctor')->insert($data_insert_to_wallet_healthcard);
    
    
                    //    total_wallet data integration
                    //   insert data in to total_withdraw_trasection
                    $find_parent_id =  DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
                    $find_parent_state = Admin::where('assign_state', $find_parent_id->state)->where('assign_district', 0)->where('assign_city', 0)->first();
                    $find_parent_district = Admin::where('assign_district', $find_parent_id->district)->where('assign_state', $find_parent_state->assign_state)->where('assign_city', 0)->first();
                    $find_parent_city = Admin::where('assign_city', $find_parent_id->city)->where('assign_state', $find_parent_state->assign_state)->where('assign_district', $find_parent_district->assign_district)->first();
    
                    $check_inserted_id = DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_city->id)->first();
                    if ($check_inserted_id != null) {
                        $total_healthcard_amount = $check_inserted_id->doctor_commision + $city_commison;
                        $total_amount = $check_inserted_id->total + $city_commison;
                        $inser_total_withdraw_trasection = array(
                            'total' => $total_amount,
                            'doctor_commision' => $total_healthcard_amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'update_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_city->id)->update($inser_total_withdraw_trasection);
                    } else {
                        $inser_total_withdraw_trasection = array(
                            'admin_id' => $find_parent_city->id,
                            'doctor_commision' => $city_commison,
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
                        $total_healthcard_amount = $check_inserted_id->doctor_commision + $ditrict_commison;
                        $total_amount = $check_inserted_id->total + $ditrict_commison;
                        $inser_total_withdraw_trasection = array(
                            'total' => $total_amount,
                            'doctor_commision' => $total_healthcard_amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'update_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_district->id)->update($inser_total_withdraw_trasection);
                    } else {
                        $inser_total_withdraw_trasection = array(
                            'admin_id' => $find_parent_district->id,
                            'doctor_commision' => $ditrict_commison,
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
                        $total_healthcard_amount = $check_inserted_id->doctor_commision + $state_commison;
                        $total_amount = $check_inserted_id->total + $state_commison;
                        $inser_total_withdraw_trasection = array(
                            'total' => $total_amount,
                            'doctor_commision' => $total_healthcard_amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'update_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->where('admin_id', $find_parent_state->id)->update($inser_total_withdraw_trasection);
                    } else {
                        $inser_total_withdraw_trasection = array(
                            'admin_id' => $find_parent_state->id,
                            'doctor_commision' => $state_commison,
                            'total' => $state_commison,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => Auth::guard('admin')->user()->id,
                        );
                        DB::table('total_withdraw_trasection')->insert($inser_total_withdraw_trasection);
                    }
                    // End Start
                    // end hre totalwallet
                    DB::commit();
                    return redirect('admin/doc-paitent-list')->with('success_message', $message);
                }
            }
            $state = DB::table('states')->where('status', '1')->get();
            return view('admin.doctor.edit_paitent_details')->with(compact('title', 'EditPaitent'));
        }

        public function paitentlist()
        {
            $paitentlist = PatientDetails::where('doctor_id', Auth::guard('admin')->user()->id)->where('add_paitent_details.paitent_discharge_date', '=', null)->get();
            return view('admin.doctor.paitent_list')->with(compact('paitentlist'));
        }
        public function docpaitentdishargelist()
        {
            $paitentlist = PatientDetails::where('doctor_id', Auth::guard('admin')->user()->id)->where('add_paitent_details.paitent_discharge_date', '!=', null)->get();
            return view('admin.doctor.paitent_discharge_list')->with(compact('paitentlist'));
        }
        public function paitentdishargelistdetails($id)
        {
            $dischargepatientdetails = PatientDetails::find($id);
            $preMedicine= PrescriptionMedicines::where('patient_id',$id)->get()->toArray();
            return view('admin.doctor.paitent_dishargelist_details')->with(compact('dischargepatientdetails','preMedicine'));
        }
        public function viewPaitentbill($id)
        {
            $InvoiceData = PatientDetails::join('cities', 'cities.id', '=', 'add_paitent_details.paitent_city')
                ->join('states', 'states.id', '=', 'add_paitent_details.paitent_state')
                ->join('districts', 'districts.id', '=', 'add_paitent_details.paitent_district')
                ->select('add_paitent_details.*','states.state_name','districts.district_name')->find($id);
              
            return view('admin.doctor.view_paitent_bill')->with(compact('InvoiceData'));
        }
        public function ClinicDoctorCustomerWiseInovice()
        {
            $paitentlist = PatientDetails::where('member_id', '=', Auth::guard('admin')->user()->member_id)->where('add_paitent_details.paitent_discharge_date', '!=', null)->where('doctor_id','!=',0)->get();
            return view('admin.doctor.paitent_discharge_list')->with(compact('paitentlist'));
        }
        public function docPaymentReciptComp()
        {
            $paymentRecpitOfComm = DB::table('hospital_commision_record_admin')->where('doctor_id',Auth::guard('admin')->user()->doctor_id)->get();
               $hosdelt = Admin::where('id',Auth::guard('admin')->user()->id)->first();
                    $hospitlaTotalComm = Doctors::where('doctor_id',$hosdelt->doctor_id)->first();
                return view('admin.doctor.hospital_payment_recipt_histroy')->with(compact('paymentRecpitOfComm','hospitlaTotalComm'));
        }
        public function DoctorAdditionalDetails(Request $request)
        {
            $adminshosp = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            $addMultiImages = Doctors::where('doctor_id',$adminshosp['doctor_id']);
            $message = "Your Images Has Been Uploaded Successfully";
            if ($request->isMethod('post')) {
                $data = $request->all();
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    //  echo"<pre>"; print_r($images); die;
                    foreach ($images as $key => $image) {
    
                        $image_tmp = Image::make($image);
    
                        $image_name = $image->getClientOriginalName();
                        //Get Image Extension
                        $extension = $image->getClientOriginalExtension();
                        //Generate New Image After resize
                        $imageName = $image_name . rand(111, 99999) . '.' . $extension;
                        $largeImagePath = 'admin_assets/uploads/doctor/large/' . $imageName;
                        $mediumImagePath = 'admin_assets/uploads/doctor/medium/' . $imageName;
                        $smallImagePath = 'admin_assets/uploads/doctor/small/' . $imageName;
                        //Upload The Large,Medium Small Images after resize
                        Image::make($image_tmp)->resize(600, 600)->save($largeImagePath);
                        Image::make($image_tmp)->resize(447, 447)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);
    
                        $image = new AddMultiImages;
                        $image->image = $imageName;
                        $image->doctor_id = $adminshosp['doctor_id'];
                        $image->save();
                    }
                }
                return redirect()->back()->with('success_message', 'Product Image has been Updated successfully!');
            }
    
               $gethospitalWiseDetails = Doctors::with('images','hospitalMoreDetails')->where('doctor_id', $adminshosp['doctor_id'])->first();
              $gethospitalWiseDetails1 = DB::table('add_more_details')->where('doctor_id', $adminshosp['doctor_id'])->first();
              $specialization = DB::table('specialization_hospitals')->get();
            return view('admin.doctor.doctor_more_details_bydoctor')->with(compact('gethospitalWiseDetails','gethospitalWiseDetails1','specialization'));
        }

        public function DoctorDetailsAdditional (Request $request)
        {
            $adminshosp = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            $hospitaladd = AddMoreDetails::where('doctor_id',$adminshosp['doctor_id'])->count();
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'video'  => 'mimes:mp4,mov,ogg | max:20000'
                ];
                $customMessages = [
                    'video'    => 'video  is Requried',
                ];
                $this->validate($request, $rules, $customMessages);
                    if($hospitaladd > 0){
    
                    $AddMoreDetails = AddMoreDetails::where('doctor_id',$adminshosp['doctor_id'])->first();
    
                    if ($request->hasFile('video')) {
                        $video_tmp = $request->file('video');
                        if ($video_tmp->isValid()) {
                            //Get video Extension
    
                            $extension = $video_tmp->getClientOriginalExtension();
                            $videoName = rand(111, 99999) . '.' . $extension;
                            $videoPath = 'admin_assets/uploads/doctor_video/';
                            $video_tmp->move($videoPath, $videoName);
                            //Inster video name
    
                            $AddMoreDetails->video = $videoName;
                        }
                    } elseif (!empty($data['video'])) {
                        $videoName = $data['video'];
                    } else {
                        $videoName = "";
                    }
    
                    $AddMoreDetails->mon_thur = $data['mon_thur'];
                    $AddMoreDetails->time_firday = $data['time_firday'];
                    $AddMoreDetails->time_sunday = $data['time_sunday'];
                    $AddMoreDetails->description = $data['description'];
                    $AddMoreDetails->sort_description = $data['sort_description'];
                    $AddMoreDetails->higlight_point_1 = $data['higlight_point_1'];
                    $AddMoreDetails->higlight_point_2 = $data['higlight_point_2'];
                    $AddMoreDetails->doctor_id = $adminshosp['doctor_id'];
                    $AddMoreDetails->save();
                    }else {
    
    
                    $AddMoreDetails = new AddMoreDetails;
                    if ($request->hasFile('video')) {
                        $video_tmp = $request->file('video');
                        if ($video_tmp->isValid()) {
                            //Get video Extension
    
                            $extension = $video_tmp->getClientOriginalExtension();
                            $videoName = rand(111, 99999) . '.' . $extension;
                            $videoPath = 'admin_assets/uploads/doctor_video/';
                            $video_tmp->move($videoPath, $videoName);
                            //Inster video name
    
                            $AddMoreDetails->video = $videoName;
                        }
                    } elseif (!empty($data['video'])) {
                        $videoName = $data['video'];
                    } else {
                        $videoName = "";
                    }
                    $AddMoreDetails->mon_thur = $data['mon_thur'];
                    $AddMoreDetails->time_firday = $data['time_firday'];
                    $AddMoreDetails->time_sunday = $data['time_sunday'];
                    $AddMoreDetails->description = $data['description'];
                    $AddMoreDetails->sort_description = $data['sort_description'];
                    $AddMoreDetails->higlight_point_1 = $data['higlight_point_1'];
                    $AddMoreDetails->higlight_point_2 = $data['higlight_point_2'];
                    $AddMoreDetails->doctor_id = $adminshosp['doctor_id'];
                    $AddMoreDetails->save();
    
                    }
                return redirect('admin/Doctor-Additional-Details/');
            }
         }

         public function DoctorDetailsSpecialization(Request $request)
         {
            $adminshosp = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            $adddoctor = Doctors::where('doctor_id',$adminshosp['doctor_id'])->first();
             if ($request->isMethod('post')) {
                 $data = $request->all();
                 $SpecializationDetails = SpecializationHospitals::where('specialization_name',$data['specialization_name'])->first();
 
                 $SpecializationWiseHospitalDetails = new SpecializationWiseHospitalDetails;
                 $SpecializationWiseHospitalDetails->doctor_id =$adddoctor['doctor_id'];
                 $SpecializationWiseHospitalDetails->specialization_id =$SpecializationDetails->id;
                 $SpecializationWiseHospitalDetails->specialization_name =$data['specialization_name'];
                 $SpecializationWiseHospitalDetails->save();
 
                 return redirect('admin/Doctor-Additional-Details/');
             }
         }
         public function DocOnlineBookApplist()
        {
            if (Auth::guard('admin')->user()->type == "Clinic-Doctor") {
                $AppoimentList = BooKAppointent::where('doctor_id', Auth::guard('admin')->user()->doctor_id)->where('appointment_cancel', '=', 'pending')->get();
            }else{
                $getuserid = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
                $gethealthcardno = DB::table('create_health_card')->where('id',$getuserid->health_card_customer_id)->first();
                $AppoimentList = BooKAppointent::where('health_card_no',$gethealthcardno->health_card_issue_id_no)
                ->where('appointment_cancel','=','pending')->get();
            }
            return view('admin.doctor.online_book_appointent_list')->with(compact('AppoimentList'));
        }
        public function DocEditonlineappointent(Request $request,$id)
        {
            $AppoimentList = BooKAppointent::find($id);

            $message = "Your Appointent has Been Updated";
            if ($request->isMethod('post')) {
                $data = $request->all();

                if($data['appointment_cancel']=='Accept'){
                    $AppoimentList->book_appointent_date =$data['book_appointent_date'];
                     $AppoimentList->appintent_time =$data['appintent_time'];
                     $AppoimentList->docter_name =$data['docter_name'];
                      $AppoimentList->appointment_cancel =$data['appointment_cancel'];
                     $AppoimentList->save();

                         //Send Conifirmation Email
                    //  $email= $AppoimentList['email'];
                    //  $messageData=[
                    //     'email' =>$AppoimentList['email'],
                    //     'appintent_time' =>$data['appintent_time'],
                    //     'docter_name' =>$data['docter_name'],
                    //     'name' =>$AppoimentList['name'],
                    //     'mobile' =>$AppoimentList['mobile'],
                    //     'book_appointent_date' =>$data['book_appointent_date'],
                    //  ];
                    //  Mail::send('emails.book_appointent_by_hospital',$messageData,function($message)use($email){
                    //      $message->to($email)->subject('Your Appointent Has Been Book Successfully');
                    //  });

                     return redirect('admin/Doc-Online-Appointent-List/')->with('success_message',$message);

           }else{
                $AppoimentList->book_appointent_date =$data['book_appointent_date'];
                     $AppoimentList->cancel_region =$data['cancel_region'];
                      $AppoimentList->appointment_cancel =$data['appointment_cancel'];
                     $AppoimentList->save();

                         //Send Conifirmation Email
                    //  $email= $AppoimentList['email'];
                    //  $messageData=[
                    //     'email' =>$AppoimentList['email'],
                    //     'name' =>$AppoimentList['name'],
                    //     'cancel_region' =>$data['cancel_region'],
                    //  ];
                    //  Mail::send('emails.book_appointent_by_hospital_reject',$messageData,function($message)use($email){
                    //      $message->to($email)->subject('Your Appointent Has Been  Reject');
                    //  });
                       return redirect('admin/Doc-Online-Appointent-List/')->with('success_message',$message);

           }
            }

            return view('admin.doctor.Edit_online_appointent')->with(compact('AppoimentList'));
        }
        public function OnlineBookaccpetedlist()
        {
            if(Auth::guard('admin')->user()->type == "Clinic-Doctor")
            {
                $AppoimentaccepetedList = BooKAppointent::where('doctor_id',Auth::guard('admin')->user()->doctor_id)->where('appointment_cancel','=','Accept')->get();
            }
            else
            {
                $getuserid = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
                $gethealthcardno = DB::table('create_health_card')->where('id',$getuserid->health_card_customer_id)->first();
                $AppoimentaccepetedList = BooKAppointent::where('health_card_no',$gethealthcardno->health_card_issue_id_no)
                ->where('appointment_cancel','=','Accept')->get();
            }

            return view('admin.doctor.online_appointent_accpeted_list')->with(compact('AppoimentaccepetedList'));
        }
        public function OnlineBookrejectedlist()
        {
            if(Auth::guard('admin')->user()->type == "Clinic-Doctor")
            {
                $AppoimentrejectedList = BooKAppointent::where('doctor_id',Auth::guard('admin')->user()->doctor_id)->where('appointment_cancel','=','Reject')->get();
            }
            else
            {
                $getuserid = DB::table('admins')->where('id',Auth::guard('admin')->user()->id)->first();
                $gethealthcardno = DB::table('create_health_card')->where('id',$getuserid->health_card_customer_id)->first();
                $AppoimentrejectedList = BooKAppointent::where('health_card_no',$gethealthcardno->health_card_issue_id_no)
                ->where('appointment_cancel','=','Reject')->get();
            }
            return view('admin.doctor.online_appointent_rejected_list')->with(compact('AppoimentrejectedList'));
        }
        public function ViewDoctorList($id)
        {
            $createhospital = Doctors::find($id);
            $state = DB::table('states')->where('status', '1')->get();
            return view('admin.doctor.view_clindoctor_details')->with(compact('createhospital', 'state'));
        }
        public function viewmedicineslip($id)
        {

            $InvoiceData = PatientDetails::find($id);
            $InvoiceData['doctor_id'];
         $DoctorAdmin= Admin::where('id',$InvoiceData['doctor_id'])->first();
             $companyDetails= DB::table('settings')->first();
                $doctorDetails= Doctors::where('doctor_id',$DoctorAdmin['doctor_id'])->first()->toArray();
             $medicineType= PrescriptionMedicines::where('patient_id',$id)->get()->toArray();

            //  for admin 
            // $getdocid = 

            return view('admin.doctor.view_medicne_slip')->with(compact('InvoiceData','companyDetails','doctorDetails','medicineType'));
        }
}
