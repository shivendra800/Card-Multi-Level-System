<?php

namespace App\Http\Controllers\Admin;

use App\Models\MedicineType;
use Illuminate\Http\Request;
use App\Models\MedicineCategory;
use Illuminate\Support\Facades\DB;
use App\Models\MedicineSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MedicineCategoryController extends Controller
{
    public function MedicineCategory()
    {
        Session::put('page','medicine-category');
        $medicineCategoryies = MedicineCategory::get()->toArray();
        return view('admin.medicineCategory.medicine_category_list')->with(compact('medicineCategoryies'));
    }

    public function AddEditMedicineCategory(Request $request, $id=null)
    {
        Session::put('page','medicine-category');
        if($id==""){
            $title = "Add";
            $category = new MedicineCategory;
            $message = "Medicine Category Added Successfully!";
        }else{
            $title = "Edit";
            $category = MedicineCategory::find($id);
            $message = "Medicine Category Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'medicine_category_name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:medicine_categories',
            ];
            $customMessages = [
                'medicine_category_name.required' => 'Medicine Category Name is Requried',
                'medicine_category_name.regex' => 'Valid Medicine Category Name is Requried',
                'medicine_category_name.unique' => 'Medicine Category Name is Allready Exist In Medicine Type Table.Please Enter Anythere Medicine Category Name',
            ];
            $this->validate($request, $rules, $customMessages);

            $category->medicine_category_name = $data['medicine_category_name'];
            $category->created_by = Auth::guard('admin')->user()->id;
            $category->status = 1;
            $category->save();

            return redirect('admin/medicine-category')->with('success_message', $message);
        }
        return view('admin.medicineCategory.add_edit_medicine_category')->with(compact('title','category'));
    }

    public function ChangeMCategoryStatus(Request $request)
    {
        Session::put('page','medicine-category');
        $status_id=$request->get('status_id');

        $statuschange=DB::table('medicine_categories')
            ->where('id',$status_id)
            ->first();

        DB::table('medicine_categories')
        ->where('id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        return redirect('/admin/medicine-category')->withErrors([' status Updated successfully ']);
    }

    public function DeleteMCategory($id)
    {
        Session::put('page','medicine_categories');

        $deleted_data=DB::table('medicine_categories')->where('id',$id)->first();
        try{
            DB::table('medicine_categories')->where('id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/medicine-category')->withErrors([' Data Deleted successfully ']);
    }

    public function MedicineSubCategory()
    {
        $medicineSubCategoryies = MedicineSubCategory::with('category')->get()->toArray();
        //   dd('medicineSubCategoryies');
        return view('admin.medicineCategory.medicine_subcategory_list')->with(compact('medicineSubCategoryies'));
    }

    public function AddEditMedicineSubCategory(Request $request, $id=null)
    {
        if($id==""){
            $title = "Add";
            $subcategory = new MedicineSubCategory;
            $message = "Medicine Subcategory Added Successfully!";
        }else{
            $title = "Edit";
            $subcategory = MedicineSubCategory::find($id);
            $message = "Medicine Subcategory Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $rules = [
                'medicine_category_id' => 'required',
                'subcategory_name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:medicine_sub_categories',
                'slug' => 'required',
            ];
            $customMessages = [
                'medicine_category_id.required' => 'Medicine Category Name is Requried',
                'slug.required' => 'Slug is Requried',
                'subcategory_name.required' => 'Medicine Subategory Name is Requried',
                'subcategory_name.regex' => 'Valid Medicine SubCategory Name is Requried',
                'subcategory_name.unique' => 'Medicine Subategory Name is Allready Exist In Medicine Subategory Table.Please Enter Anyothere Medicine SubCategory Name',
            ];
            $this->validate($request, $rules, $customMessages);

            $subcategory->medicine_category_id = $data['medicine_category_id'];
            $subcategory->subcategory_name = $data['subcategory_name'];
            $subcategory->slug = $data['slug'];
            $subcategory->created_by = Auth::guard('admin')->user()->id;
            // echo "<pre>";
            // print_r($data);
            // die;
            $subcategory->status = 1;
            $subcategory->save();

            return redirect('admin/medicine-subcategory')->with('success_message', $message);
        }
        $medicineCategoryies = MedicineCategory::get()->toArray();
        return view('admin.medicineCategory.add_edit_medicine_subcategory')->with(compact('title','subcategory','medicineCategoryies'));
    }
    public function ChangeMSubcategoryStatus(Request $request)
    {
        Session::put('page','medicine-subcategory');
        $status_id=$request->get('status_id');

        $statuschange=DB::table('medicine_sub_categories')
            ->where('id',$status_id)
            ->first();

        DB::table('medicine_sub_categories')
        ->where('id',$status_id)
        ->update(array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>$request->get('status')
        ));
        return redirect('/admin/medicine-subcategory')->withErrors([' status Updated successfully ']);
    }

    public function DeleteMSubcategory($id)
    {
        Session::put('page','medicine_sub_categories');

        $deleted_data=DB::table('medicine_sub_categories')->where('id',$id)->first();
        try{
            DB::table('medicine_sub_categories')->where('id',$id)->delete();
        }
        catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect('/admin/medicine-subcategory')->withErrors([' Data Deleted successfully ']);
    }
}
