<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medicine;
use App\Models\MedicineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MedicineCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\Facades\Image;

class MedicineController extends Controller
{
    public function MedicineType()
    {
        Session::put('page', 'medicine-type');
        $medicinetypes = MedicineType::get()->toArray();
        return view('admin.medicines.medicine_type_list')->with(compact('medicinetypes'));
    }

    public function AddEditMedicinieType(Request $request, $id = null)
    {
        Session::put('page', 'medicine-type');
        if ($id == "") {
            $title = "ADD";
            $medicinetype = new MedicineType;
            $message =  "Medicine Type Added Sucessfully!";
        } else {
            $title = "Edit";
            $medicinetype =  MedicineType::find($id);
            $message = "Medicine Type Edit sucessfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'medicine_type_name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:medicine_types',
            ];
            $customMessages = [
                'medicine_type_name.required' => 'Medicine Type Name is Requried',
                'medicine_type_name.regex' => 'Valid Medicine Type Name is Requried',
                'medicine_type_name.unique' => 'Medicine Type Name is Allready Exist In Medicine Type Table.Please Enter Anythere Medicine Type Name',
            ];
            $this->validate($request, $rules, $customMessages);

            $medicinetype->medicine_type_name = $data['medicine_type_name'];
            $medicinetype->created_by = Auth::guard('admin')->user()->id;
            $medicinetype->status = 1;
            $medicinetype->save();

            return redirect('admin/medicine-type')->with('success_message', $message);
        }
        return view('admin.medicines.add_edit_medicinestype')->with(compact('title', 'medicinetype'));
    }
    public function ChangeMedicineTypesStatus(Request $request)
    {
        Session::put('page', 'medicine-type');
        $status_id = $request->get('status_id');

        $statuschange = DB::table('medicine_types')
            ->where('id', $status_id)
            ->first();

        DB::table('medicine_types')
            ->where('id', $status_id)
            ->update(array(
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => $request->get('status')
            ));
        return redirect('/admin/medicine-type')->withErrors([' status Updated successfully ']);
    }

    public function DeleteMedicineTypes($id)
    {
        Session::put('page', 'medicine-type');

        $deleted_data = DB::table('medicine_types')->where('id', $id)->first();
        try {
            DB::table('medicine_types')->where('id', $id)->delete();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/medicine-type')->withErrors([' Data Deleted successfully ']);
    }

    public function MedicineList()
    {
        Session::put('page', 'medicine');
        $medicineslist = Medicine::join('medicine_categories','medicine_categories.id','=','medicines.m_category_id')
         ->join('medicine_sub_categories','medicine_sub_categories.id','=','medicines.m_subcategory_id')
         ->join('brands','brands.id','=','medicines.brand_id')
        ->select('medicines.*','medicine_categories.medicine_category_name','medicine_sub_categories.subcategory_name','brands.brand_name')->get()->toArray();
        return view('admin.medicines.medicine_list')->with(compact('medicineslist'));
    }

    public function AddEditMedicinie(Request $request, $id = null)
    {
        Session::put('page', 'medicine');
        if ($id == "") {
            $title = "ADD";
            $medicine = new Medicine;
            $message =  "Medicine Added Sucessfully!";
        } else {
            $title = "Edit";
            $medicine =  Medicine::find($id);
            $message = "Medicine Edit sucessfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
        //    return $request->all();
            $rules = [
                'medicine_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'm_category_id' => 'required',
                'm_subcategory_id' => 'required',
                'brand_id' => 'required',
                'medicine_type_id' => 'required',
                'slug' => 'required',
                'small_description' => 'required',
                'description' => 'required',
                'cost_price' => 'required',
                'original_price' => 'required',
                'selling_price' => 'required',
                'image' => 'required',
                'qty' => 'required',
                'original_qty' => 'required',
                'tax' => 'required',
                'deals' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'unit' => 'required',
            ];
            $customMessages = [
                'medicine_name.required' => 'Medicine  Name is Requried',
                'medicine_name.regex' => 'Valid Medicine  Name is Requried',
                
            ];
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin_assets/uploads/medicine/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                    $medicine->image = $imageName;
                }
            } else {
                $medicine->image = "";
            }
            return $medicine->image ;
            $medicine->medicine_name = $data['medicine_name'];
            $medicine->m_category_id = $data['m_category_id'];
            $medicine->m_subcategory_id = $data['m_subcategory_id'];
            $medicine->brand_id = $data['brand_id'];
            $medicine->medicine_type_id = $data['medicine_type_id'];
            $medicine->slug = $data['slug'];
            $medicine->small_description = $data['small_description'];
            $medicine->description = $data['description'];
            $medicine->cost_price = $data['cost_price'];
            $medicine->original_price = $data['original_price'];
            $medicine->selling_price = $data['selling_price'];
            
            $medicine->qty = $data['qty'];
            $medicine->original_qty = $data['original_qty'];
            $medicine->tax = $data['tax'];
            $medicine->deals = $data['deals'];
            $medicine->meta_title = $data['meta_title'];
            $medicine->meta_description = $data['meta_description'];
            $medicine->meta_keywords = $data['meta_keywords'];
            $medicine->unit = $data['unit'];
            $medicine->created_by = Auth::guard('admin')->user()->id;
            $medicine->status = 1;
            $medicine->save();

            return redirect('admin/medicine')->with('success_message', $message);
        }
        $brands = Brand::where('status','1')->get();
        $category = MedicineCategory::where('status','1')->get();
        $medicinetype = MedicineType::where('status','1')->get();
        return view('admin.medicines.add_edit_medicine')->with(compact('title', 'medicine','brands','category','medicinetype'));
 
    }
}
