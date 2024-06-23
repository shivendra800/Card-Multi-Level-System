<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AddMultiImages;
use App\Models\BooKAppointent;
use Illuminate\Support\Facades\DB;
use App\Models\HospitalManagements;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Models\SpecializationHospitals;

class HospitalController extends Controller
{
    public function hospital()
    {
       $gethospitaldata = DB::table('create_hospital')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)->groupBy('specialization_wise_hospitals.hospital_id')->Paginate('10');
        $getspecialization = SpecializationHospitals::get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.hospital.hospital_list')->with(compact('gethospitaldata','getspecialization','get_setting_data'));
    }
    public function hospitalsearch(Request $request)
    {
        $keyword = $request->get('keyword');
       $gethospitaldata = DB::table('create_hospital')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)->groupBy('specialization_wise_hospitals.hospital_id')
        ->where(function($query) use($keyword)  {
            $query->where('create_hospital.name','LIKE','%'.$keyword.'%')
            ->orWhere('specialization_wise_hospitals.specialization_name','LIKE','%'.$keyword.'%')
            ->orWhere('states.state_name','LIKE','%'.$keyword.'%')
            ->orWhere('districts.district_name','LIKE','%'.$keyword.'%')
            ->orWhere('cities.city_name','LIKE','%'.$keyword.'%')

              ;
        })
        ->Paginate('10');
        $getspecialization = SpecializationHospitals::get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.hospital.hospital_list')->with(compact('gethospitaldata','getspecialization','get_setting_data'));
    }

    public function HospitalDetails($name)
    {
               $gethospitaldata = DB::table('create_hospital')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('add_multi_images','add_multi_images.hospital_id','create_hospital.hospital_id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_more_details.*','add_multi_images.image as multi_images','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)
        ->where('create_hospital.name','=',$name)
        ->get();

       

        $gethospitaldatasingledata = DB::table('create_hospital')->where('create_hospital.name','=',$name)->first();
    //    return $gethospitaldatasingledata->id;
       $getmultiimages = DB::table('add_multi_images')->where('hospital_id', '=', $gethospitaldatasingledata->id)->get();

             $gethpositalwsiespec = DB::table('specialization_wise_hospitals')->where('hospital_id', '=', $gethospitaldatasingledata->id)->get();
             $get_setting_data= DB::table('settings')->first();
             $getfaciclity = DB::table('add_more_details')->where('hospital_id', '=', $gethospitaldatasingledata->id)->first();
        return view('front.hospital.Hospital-Details')->with(compact('getfaciclity','gethospitaldatasingledata','gethospitaldata','gethpositalwsiespec','getmultiimages','get_setting_data'));
    }

    public function BookAppointent($name)
    {
        $gethospitaldata = DB::table('create_hospital')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('add_multi_images','add_multi_images.hospital_id','create_hospital.hospital_id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_more_details.*','add_multi_images.image as multi_images','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)
        ->where('create_hospital.name','=',$name)
        ->get();
        $gethospitaldatasingledata = DB::table('create_hospital')->where('create_hospital.name','=',$name)->first();
        $gethpositalwsiespec = DB::table('specialization_wise_hospitals')->where('hospital_id', '=', $gethospitaldatasingledata->id)->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.hospital.book_appointent_paitent')->with(compact('get_setting_data','gethospitaldata','gethpositalwsiespec','gethospitaldatasingledata'));
    }

    public function BookAppointentsave(Request $request,$name)
    {
        $gethospitaldatasingledata = DB::table('create_hospital')->where('create_hospital.name','=',$name)->first();
        $BooKAppointent = new BooKAppointent();
        $message = "Your Request Has Been Sent To the Hosptial";
        $data = $request->all();

        $rules = [
            "email" => "required|exists:create_health_card",
            'name' => 'required',
            'mobile' => 'required',
            'book_appointent_date' => 'required',
        //   'health_card_no' => "required|exists:create_health_card,health_card_issue_id_no",
            'specialization' => 'required',
            


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
        $BooKAppointent->hospital_id = $gethospitaldatasingledata->id;
        $BooKAppointent->hospital_name = $gethospitaldatasingledata->name;
        $BooKAppointent->specialization_id = $data['specialization'];
        $BooKAppointent->specialization = $getspecialization->specialization_name;
        $BooKAppointent->save();

        return redirect('Book-Appointent/'.$name)->with('success_message', $message);
    }

    public function RegisterHospital(Request $request)
    {
        $title = 'Register Your';
        $createhospital = new HospitalManagements();
        $admin = new Admin();
        $message = "Hospital  created  Successfully!";
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                "email" => "required|email|unique:admins|unique:create_hospital",
                'name' => 'required|unique:admins,name|unique:create_hospital,name',
                'password' => 'required',
                'assign_city' => "required|exists:admins",
                'assign_district' => "required|exists:admins",
                "assign_state" => "required|exists:admins",
                'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                 'pincode'=>'required|digits:6',
                 'mobile'=>'required|digits:10'
            ];
            $customMessages = [

                'name.required' => 'Name is Requried',
                "name.unique" => " This Hospital Name Is Already Exists",
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
                    $imagePath = 'admin_assets/uploads/hospital/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                    $createhospital->image = $imageName;
                }
            } else {
                $createhospital->image = "";
            }
            $spom = 'ID-HCMS-' . rand(1111, 9999);

            $createhospital->name = $data['name'];
            $createhospital->slug = str_replace(' ','-',$data['name']);
            $createhospital->email = $data['email'];
            $createhospital->password = bcrypt($data['password']);

            $createhospital->address = $data['address'];
            $createhospital->state = $data['assign_state'];
            $createhospital->district = $data['assign_district'];
            $createhospital->city = $data['assign_city'];

            $createhospital->pincode = $data['pincode'];


            $createhospital->mobile = $data['mobile'];
            $createhospital->contact_person_mobile = $data['contact_person_mobile'];
            $createhospital->contact_person_name = $data['contact_person_name'];
            $createhospital->member_id = $spom;
            // $createhospital->created_by = Auth::guard('admin')->user()->id;
            $createhospital->status = 0;
            $createhospital->save();
            $createhospital_id = DB::getPdo()->lastInsertId();
            $createhospital->hospital_id = $createhospital_id;
            $createhospital->save();
            $image = new AddMultiImages;
            $image->image = $imageName;
            $image->hospital_id = $createhospital_id;
            $image->save();


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('admin_assets/uploads/adminlogin/', $filename);
                $admin->image = $filename;
            }
            $admin->type = 'Hospital';
            $admin->hospital_id = $createhospital_id;
            $admin->state = $data['assign_state'];
            $admin->district = $data['assign_district'];
            $admin->city = $data['assign_city'];
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->member_id = $spom;
            $admin->password = bcrypt($data['password']);
            // $admin->created_by = Auth::guard('admin')->user()->id;
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
                $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Hospital');
            });

            //   Send Login Sms


            DB::commit();

            return redirect('Register-Hospital')->with('success_message', $message);
        }
        $state = DB::table('states')->where('status', '1')->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.hospital.register_hospital')->with(compact('title', 'createhospital', 'state','get_setting_data'));
    }
}
