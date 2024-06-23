<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Doctors;
use Illuminate\Http\Request;
use App\Models\AddMultiImages;
use App\Models\BooKAppointent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Models\SpecializationHospitals;

class DocterController extends Controller
{
    public function doctors()
    {
        $getdoctordata = DB::table('create_doctors')
        ->join('states','states.id','create_doctors.state')
        ->join('districts','districts.id','create_doctors.district')
        ->join('cities','cities.id','create_doctors.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.doctor_id','create_doctors.id')
        ->join('add_more_details','add_more_details.doctor_id','create_doctors.doctor_id')
        ->select('create_doctors.*','states.state_name','districts.district_name','cities.city_name','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_doctors.status','=',1)->groupBy('specialization_wise_hospitals.doctor_id')->Paginate('10');
        $getspecialization = SpecializationHospitals::get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.doctors.doctors_list')->with(compact('getdoctordata','getspecialization','get_setting_data'));;
    }
    public function DoctorDetails($slug)
    {
        $getdoctordata = DB::table('create_doctors')
        ->join('states','states.id','create_doctors.state')
        ->join('districts','districts.id','create_doctors.district')
        ->join('cities','cities.id','create_doctors.city')
        ->join('add_multi_images','add_multi_images.doctor_id','create_doctors.doctor_id')
        ->join('add_more_details','add_more_details.doctor_id','create_doctors.doctor_id')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.doctor_id','create_doctors.doctor_id')
        ->select('create_doctors.*','states.state_name','districts.district_name','cities.city_name','add_more_details.*','add_multi_images.image as multi_images','specialization_wise_hospitals.specialization_name')
        ->where('create_doctors.status','=',1)
        ->where('create_doctors.slug','=',$slug)
        ->get();
          $getdoctordatasingledata = DB::table('create_doctors')->where('create_doctors.slug','=',$slug)->first();
           $getmultiimages = DB::table('add_multi_images')->where('doctor_id', '=', $getdoctordatasingledata->id)->get();
             $getdoctorwsiespec = DB::table('specialization_wise_hospitals')->where('doctor_id', '=', $getdoctordatasingledata->id)->get();
             $get_setting_data= DB::table('settings')->first();
        return view('front.doctors.doctor_Details')->with(compact('get_setting_data','getdoctordata','getdoctorwsiespec','getmultiimages','getdoctordatasingledata'));
    }

    public function BookAppointent($slug)
    {
        $gethospitaldata = DB::table('create_doctors')->find($slug);
        $gethospitaldatasingledata = DB::table('create_doctors')->where('create_doctors.slug','=',$slug)->first();
        $gethpositalwsiespec = DB::table('specialization_wise_hospitals')->where('doctor_id', '=', $gethospitaldatasingledata->id)->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.doctors.book_appointent_paitent')->with(compact('get_setting_data','gethospitaldata','gethpositalwsiespec','gethospitaldatasingledata'));
    }

    public function BookAppointentsave(Request $request,$slug)
    {
        $gethospitaldatasingledata = DB::table('create_doctors')->where('create_doctors.slug','=',$slug)->first();
        $BooKAppointent = new BooKAppointent();
        $message = "Your Request Has Been Sent To the Doctor";
        $data = $request->all();

        $rules = [
            "email" => "required|exists:create_health_card",
            'name' => 'required',
            'book_appointent_date' => 'required',
        //   'health_card_no' => "required|exists:create_health_card,health_card_issue_id_no",
            'specialization' => 'required',
             'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
              'aadhar_no'=>'required|digits:12',
                'pincode'=>'required|digits:6',
                 'mobile'=>'required|digits:10'


        ];
        $customMessages = [

            // 'health_card_no.exists' => 'This health_card_no Is Not Exists in our database.Plz End Vaild Details',
            "email.exists" => " This Email Is Not Exists in our database.Plz End Vaild Details",
        ];

        $this->validate($request, $rules, $customMessages);
             $gethospitaldatcustomer = DB::table('create_health_card')->where('email',$data['email'])->first();
        $getspecialization = SpecializationHospitals::where('id',$data['specialization'])->first();
        $BooKAppointent->name = $data['name'];
        $BooKAppointent->mobile = $data['mobile'];
        $BooKAppointent->book_appointent_date = $data['book_appointent_date'];
        $BooKAppointent->email = $data['email'];
        $BooKAppointent->health_card_no = $gethospitaldatcustomer->health_card_issue_id_no;
        $BooKAppointent->doctor_id = $gethospitaldatasingledata->id;
        $BooKAppointent->hospital_name = $gethospitaldatasingledata->name;
        $BooKAppointent->specialization_id = $data['specialization'];
        $BooKAppointent->specialization = $getspecialization->specialization_name;
        $BooKAppointent->save();

        return redirect('Book-Doctor-Appointent/'.$slug)->with('success_message', $message);
    }
    public function OnlineReqistationDoctor(Request $request)
    {
 
            $title = "Reqister Yourself As ";
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
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
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
                $createdoctor->member_id = $spom;
                $createdoctor->created_by = Auth::guard('admin')->user()->id;
                $createdoctor->status = 0;
                $createdoctor->save();
                $createdoctor_id = DB::getPdo()->lastInsertId();
                $createdoctor->doctor_id = $createdoctor_id;
                $createdoctor->save();
    
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
                $admin->status = 0;
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
                return redirect('Register-Doctor')->with('success_message', $message);
            }
        $state = DB::table('states')->where('status', '1')->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.doctors.online_doctor_reqistation')->with(compact('title', 'createdoctor', 'state','get_setting_data'));
    }
}
