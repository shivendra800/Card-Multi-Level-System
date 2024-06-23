<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AssignAmbulance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AssignAmbulanceController extends Controller
{
    public function AssignAmbulanceList()
    {
        $assignAmbulanceList = AssignAmbulance::get()->toArray();
        return view('admin.ambulances.assign.assign_ambulance_list')->with(compact('assignAmbulanceList'));
    }
    public function AddEditAssignAmbulance(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Assign";
            $assignAmbulance = new AssignAmbulance;
            $message = "Assign Ambulance  Add Successfully!";
            $state = DB::table('states')->where('status', '1')->get();
            $getDriver = Driver::where('status', '1')->where('assign_status', '0')->get();
            $getAmbulance = Ambulance::where('status', '1')->where('assign_status', '0')->get();
        } else {
            $title = "Edit ";
            $assignAmbulance = AssignAmbulance::find($id);
            $message = "Assign Ambulance Update Successfully!";
            $state = DB::table('states')->where('status', '1')->get();
            $getDriver = Driver::where('status', '1')->get();
            $getAmbulance = Ambulance::where('status', '1')->get();
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'driver_id' => 'required|unique:assign_ambulance,driver_id',
                'ambulance_id' => 'required|unique:assign_ambulance,ambulance_id',
                
            ];
            $customMessages = [
                'driver_id.required' => ' Select  is Requried For Assign Driver To Ambulance ',
                'driver_id.unique' => 'This Driver   is Allready Assign To Other Ambulance ',
                'ambulance_id.required' => ' Ambulance is Requried',
                'ambulance_id.unique' => 'This Ambulance is Allready Assign To Other Driver ',
            ];
            $this->validate($request, $rules, $customMessages);
            
            $getAmbulanceDetails = Ambulance::where('id', $data['ambulance_id'])->first();
                $getDriverDetails = Driver::where('id', $data['driver_id'])->first();
           

            $assignAmbulance->vechile_no = $getAmbulanceDetails['vechile_no'];
            $assignAmbulance->driver_id = $data['driver_id'];
            $assignAmbulance->ambulance_id = $data['ambulance_id'];
            $assignAmbulance->assign_driver_name = $getDriverDetails['name'];
            $assignAmbulance->assign_state = $data['assign_state'];
            $assignAmbulance->assign_district = $data['assign_district'];
            $assignAmbulance->assign_city = $data['assign_city'];
            $assignAmbulance->assign_status= 1;
            $assignAmbulance->save();

            $findambulanceid = Ambulance::find($data['ambulance_id']);
            $findambulanceid->assign_status = 1;
            $findambulanceid->save();
            $finddriverid = Driver::find($data['driver_id']);
            $finddriverid->assign_status = 1;
            $finddriverid->save();
         
            return redirect('admin/AssignAmbulance-list')->with('success_message', $message);
        }


     
        return view('admin.ambulances.assign.add_edit_assign_ambulance')->with(compact('title', 'assignAmbulance', 'state','getDriver','getAmbulance'));
    }
    
    public function DeleteAssignAmbulance($id)
    {
        Session::put('page', 'AssignAmbulance-list');

        $deleted_data = DB::table('assign_ambulance')->where('id', $id)->first();
        try {
            DB::table('assign_ambulance')->where('id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/AssignAmbulance-list')->withErrors([' Data Deleted successfully ']);
    }
    public function ChangeAssignAmbulanceListStatus(Request $request)
    {
        Session::put('page', 'AssignAmbulance-list');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('assign_ambulance')
            ->where('id', $status_id)
            ->first();

        DB::table('assign_ambulance')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'assign_status' => $request->get('assign_status')
            ));

        $message = " Assign Ambulaance Status Is  Updated Sucessfully!.";
        return redirect('admin/AssignAmbulance-list')->with('success_message', $message);
    }
}
