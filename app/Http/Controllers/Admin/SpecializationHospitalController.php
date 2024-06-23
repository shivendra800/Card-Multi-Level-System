<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SpecializationHospitals;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpecializationHospitalController extends Controller
{
    public function HospitalSpecialization()
    {
        $speicalizationList = SpecializationHospitals::get()->toArray();
        return view('admin.hospital.specialization_list')->with(compact('speicalizationList'));
    }

    public function AddEditSpecialization(Request $request, $id=null)
    {
        if ($id == "") {
            $title = "Add ";
            $speicalization = new SpecializationHospitals;
            $message = "speicalization Name  Add Successfully!";
        } else {
            $title = "Edit ";
            $speicalization = SpecializationHospitals::find($id);
            $message = "speicalization Name Update Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'specialization_name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:specialization_hospitals',
            ];
            $customMessages = [
                'specialization_name.required' => ' speicalization Name is Requried',
                'specialization_name.regex' => 'Valid speicalization Name is Requried',
                'specialization_name.unique' => 'speicalization Name is Allready Exist In speicalization Table.Please Enter Anythere speicalization Name ',
            ];
            $this->validate($request, $rules, $customMessages);

            $speicalization->specialization_name = $data['specialization_name'];
            $speicalization->save();
            return redirect('admin/Hospital-Specialization')->with('success_message', $message);
        }
        return view('admin.hospital.add_edit_specialization')->with(compact('title','speicalization'));
    }
    public function DeleteSpecialization($id)
    {


        $deleted_data=DB::table('specialization_hospitals')->where('id',$id)->first();
        try{
            DB::table('specialization_hospitals')->where('id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/Hospital-Specialization')->withErrors([' Data Deleted successfully ']);
    }
}
