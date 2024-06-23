<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Driver;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DriverController extends Controller
{
 
    public function DriverList()
    {
        $driverList = Driver::where('ambulance_id',Auth::guard('admin')->user()->id)->get()->toArray();
        return view('admin.ambulances.driver_list')->with(compact('driverList'));
    }
    public function AddEditDriver(Request $request, $id = null)
    {
        $request->all();
        DB::beginTransaction();
        if ($id == "") {
            $title = "Add";
            $createDriver = new Driver();
            $admin = new Admin();
            $message = "Driver  created  Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "email" => "required|email|unique:admins|unique:create_drivers",
                    'name' => 'required',
                    'password' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                    'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];
                $customMessages = [

                    'name.required' => 'Name is Requried',
                    'password.required' => 'Password is Requried',
                    "email.required" => "Email is Required",
                    "email.unique" => " Email Already Exists",
                    "ambulance_id.unique" => "if you want tyo add other driver first you have to delete your existing drivers from you panel",
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
                        $imagePath = 'admin_assets/uploads/driver/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                        $createDriver->image = $imageName;
                    }
                } else {
                    $createDriver->image = "";
                }
                if ($files = $request->file('aadhar_image')) {
                    $destinationPath = 'admin_assets/uploads/driver_aadhar_image/'; // upload path
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $post['aadhar_image'] = "$profileImage";
                    $createDriver->aadhar_image = $profileImage;
                }

                if ($files = $request->file('driving_lan_image')) {
                    $destinationPath = 'admin_assets/uploads/driving_lan_image/'; // upload path
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $post['driving_lan_image'] = "$profileImage";
                    $createDriver->driving_lan_image = $profileImage;
                }
                $spom = 'ID-HCMS-' . rand(1111, 9999);

                $createDriver->name = $data['name'];
                $createDriver->ambulance_id = Auth::guard('admin')->user()->id;
                $createDriver->email = $data['email'];
                $createDriver->address = $data['address'];
                $createDriver->state = $data['assign_state'];
                $createDriver->district = $data['assign_district'];
                $createDriver->city = $data['assign_city'];
                $createDriver->pincode = $data['pincode'];
                $createDriver->mobile = $data['mobile'];
                $createDriver->aadhar = $data['aadhar'];
                $createDriver->pan_card = $data['pan_card'];
                $createDriver->status = 1;
                $createDriver->save();
                $createDriver_id = DB::getPdo()->lastInsertId();


                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('admin_assets/uploads/adminlogin/', $filename);
                    $admin->image = $filename;
                }
                $admin->type = 'Driver';
                $admin->driver_id = $createDriver_id;
                $admin->driver_type = Auth::guard('admin')->user()->id;
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

                return redirect('admin/Driver-list')->with('success_message', $message);
            }
        } else {

            $title = "Edit ";
            $createDriver = Driver::find($id);
            $admin =  Admin::where('driver_id', '=', $id)->first();
            $message = "Driver Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'name' => 'required',
                    'assign_city' => "required|exists:admins",
                    'assign_district' => "required|exists:admins",
                    "assign_state" => "required|exists:admins",
                ];
                $customMessages = [

                    'name.required' => 'name is Requried',
                    'assign_state.required' => 'assign_state is Requried',
                    'assign_district.required' => 'assign_district is Requried',
                    'assign_city.required' => 'assign_city is Requried',
                    "assign_state.exists" =>" This State Is Not Assign Yet. Plz Select Another State Which Is Exist Or Contact To Admin",
                    "assign_district.exists" =>" This District Is Not Assign Yet. Plz Select Another District Which Is Exist Or Contact To Admin",
                    "assign_city.exists" =>" This City Is Not Assign Yet. Plz Select Another City Which Is Exist Or Contact To Admin",
                ];
                $this->validate($request, $rules, $customMessages);
                $createDriver->name = $data['name'];
                $createDriver->address = $data['address'];
                $createDriver->state = $data['assign_state'];
                $createDriver->district = $data['assign_district'];
                $createDriver->city = $data['assign_city'];
                $createDriver->pincode = $data['pincode'];
                $createDriver->mobile = $data['mobile'];
                $createDriver->aadhar = $data['aadhar'];
                $createDriver->status = 1;
                $createDriver->save();
                $admin->state = $data['assign_state'];
                $admin->district = $data['assign_district'];
                $admin->city = $data['assign_city'];
                $admin->name = $data['name'];
                $admin->mobile = $data['mobile'];
                $admin->updated_by = Auth::guard('admin')->user()->id;
                $admin->status = 1;
                $admin->save();
                DB::commit();
                return redirect('admin/Driver-list')->with('success_message', $message);
            }
        }


        $state = DB::table('states')->where('status', '1')->get();
        return view('admin.ambulances.add_edit_driver')->with(compact('title', 'createDriver', 'state'));
    }
    
    public function DeleteDriver($id)
    {
        Session::put('page', 'Driver-list');

        $deleted_data = DB::table('create_drivers')->where('id', $id)->first();
        try {
            DB::table('create_drivers')->where('id', $id)->delete();
            DB::table('admins')->where('driver_id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Driver-list')->withErrors([' Data Deleted successfully ']);
    }
    public function ChangeDriverListStatus(Request $request)
    {
        Session::put('page', 'Driver-list');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('create_drivers')
            ->where('id', $status_id)
            ->first();

        DB::table('create_drivers')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        DB::table('admins')
            ->where('driver_id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        $message = " Driver Status Is  Updated Sucessfully!.";
        return redirect('admin/Driver-list')->with('success_message', $message);
    }
}
