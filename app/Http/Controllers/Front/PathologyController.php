<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Pathologys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class PathologyController extends Controller
{
    public function Pathology()
    {
        $get_pathology_data = DB::table('create_pathologys')
        ->join('states','states.id','create_pathologys.state')
        ->join('districts','districts.id','create_pathologys.district')
        ->join('cities','cities.id','create_pathologys.city')
        ->select('create_pathologys.*','states.state_name','districts.district_name','cities.city_name')
        ->where('create_pathologys.status','=',1)->Paginate('10');
        $get_setting_data= DB::table('settings')->first();
        return view('front.pathology.pathology_list')->with(compact('get_pathology_data','get_setting_data'));;
    }
    public function PathologyDetails($slug)
    {
        $getpathlogydata = DB::table('create_pathologys')
        ->join('states','states.id','create_pathologys.state')
        ->join('districts','districts.id','create_pathologys.district')
        ->join('cities','cities.id','create_pathologys.city')
        ->select('create_pathologys.*','states.state_name','districts.district_name','cities.city_name')
        ->where('create_pathologys.status','=',1)
        ->where('create_pathologys.slug','=',$slug)
        ->get();
          $getpathologydatasingledata = DB::table('create_pathologys')->where('create_pathologys.slug','=',$slug)->first();
             $getpathologytestwsiespec = DB::table('pathologytesttype')->where('pathology_id', '=', $getpathologydatasingledata->id)->get();
             $get_setting_data= DB::table('settings')->first();
        return view('front.pathology.pathology_Details')->with(compact('get_setting_data','getpathlogydata','getpathologytestwsiespec','getpathologydatasingledata'));
    }
    public function OnlineReqistationPathology(Request $request)
    {
 
            $title = "Reqister Yourself As ";
            $createpathology = new Pathologys();
            $admin = new Admin();
            $message = "Pathology  created  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" => "required|email|unique:admins|unique:create_pathologys",
                    'clininc_name' => 'required|unique:create_pathologys',
                    'name' => 'required',
                    'password' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                    
                    'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];
                $customMessages = [

                    'name.required' => 'Name is Requried',
                    "clininc_name.unique" => " create_pathologys This  Name is  Already Exists",
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
                        $imagePath = 'admin_assets/uploads/pathology/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createpathology->image = $imageName;
                    }
                } else {
                    $createpathology->image = "";
                }
                $spom = 'ID-HCMS-' . rand(1111, 9999);

                $createpathology->name = $data['name'];
                $createpathology->clininc_name = $data['clininc_name'];
                $createpathology->slug =str_replace(' ', '-', $data['clininc_name']);
                $createpathology->email = $data['email'];
                $createpathology->password = bcrypt($data['password']);
                $createpathology->address = $data['address'];
                $createpathology->state = $data['assign_state'];
                $createpathology->district = $data['assign_district'];
                $createpathology->city = $data['assign_city'];
                $createpathology->pincode = $data['pincode'];
                $createpathology->mobile = $data['mobile'];
                $createpathology->contact_person_mobile = $data['contact_person_mobile'];
                $createpathology->contact_person_name = $data['contact_person_name'];
                $createpathology->member_id = $spom;
                $createpathology->created_by = Auth::guard('admin')->user()->id;
                $createpathology->status = 0;
                $createpathology->save();
                $createpathology_id = DB::getPdo()->lastInsertId();
                $createpathology->pathology_id = $createpathology_id;
                $createpathology->save();
    
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Pathology';
                $admin->pathology_id = $createpathology_id;
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
                Mail::send('emails.pathology',$messageData,function($message)use($email){
                    $message->to($email)->subject('Account Created Mail Of Hello India Life Care For Pathology');
                });
                return redirect('Register-Pathology')->with('success_message', $message);
            }
        $state = DB::table('states')->where('status', '1')->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.pathology.online_pathology_reqistation')->with(compact('title', 'createpathology', 'state','get_setting_data'));
    }
    
}
