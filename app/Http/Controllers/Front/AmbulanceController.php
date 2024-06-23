<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AmbulanceController extends Controller
{
    public function ambulance()
    {
        $get_setting_data= DB::table('settings')->first();
        $ambulanceList = Ambulance::where('status',1)->Paginate('10');
        return view('front.ambulance.ambulance_list')->with(compact('get_setting_data','ambulanceList'));
    }
    public function RegisterAmbulance(Request $request)
    {
        $request->all();
        DB::beginTransaction();
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
                $createAmbulance->member_id = $spom;
                $createAmbulance->created_by = Auth::guard('admin')->user()->id;
                $createAmbulance->status = 0;
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
                $admin->status = 0;
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

                return redirect('Register-Ambulance')->with('success_message', $message);
            }
        $state = DB::table('states')->where('status', '1')->get();
        $get_setting_data= DB::table('settings')->first();
        return view('front.ambulance.add_ambulance')->with(compact('title', 'createAmbulance', 'state','get_setting_data'));
    }
    public function BookAmbulance(){


        $get_setting_data= DB::table('settings')->first();
        return view('front.ambulance.book_ambulance')->with(compact('get_setting_data'));

    }
}
