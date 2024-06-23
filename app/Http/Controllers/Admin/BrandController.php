<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandController extends Controller
{
     public function brand()
     {
        Session::put('page','brands');
        $brands = Brand::get()->toArray();
        return view('admin.brands.brand_list')->with(compact('brands'));
     }
     public function AddEditBrand(Request $request,$id=null)
     {

        Session::put('page','brands');
        if ($id == "") {
            $title = "Add ";
            $brand = new Brand;
            $message = "Brand Name  Add Successfully!";
        } else {
            $title = "Edit ";
            $brand = Brand::find($id);
            $message = "Brand Name Update Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:brands',
            ];
            $customMessages = [
                'brand_name.required' => ' Brand Name is Requried',
                'brand_name.regex' => 'Valid Brand Name is Requried',
                'brand_name.unique' => 'Brand Name is Allready Exist In Brand Table.Please Enter Anythere Brand Name ',
            ];
            $this->validate($request, $rules, $customMessages);

            $brand->brand_name = $data['brand_name'];
            $brand->created_by = Auth::guard('admin')->user()->id;
            $brand->status= 1;
            $brand->save();
            return redirect('admin/brands')->with('success_message', $message);
        }

        return view('admin.brands.add_edit_brand')->with(compact('title','brand'));
     }
     public function ChangeBrandsStatus(Request $request)
     {
         Session::put('page','brands');
         $status_id=$request->get('status_id');

         $statuschange=DB::table('brands')
             ->where('id',$status_id)
             ->first();

         DB::table('brands')
         ->where('id',$status_id)
         ->update(array(
             'updated_at'=>date('Y-m-d H:i:s'),
             'status'=>$request->get('status')
         ));
         return redirect('/admin/brands')->withErrors([' status Updated successfully ']);
     }

     public function DeleteBrand($id)
     {
         Session::put('page','brands');

         $deleted_data=DB::table('brands')->where('id',$id)->first();
         try{
             DB::table('brands')->where('id',$id)->delete();
         }
         catch (ModelNotFoundException $exception) {
             return back()->withError($exception->getMessage())->withInput();
         }

         return redirect('/admin/brands')->withErrors([' Data Deleted successfully ']);
     }
}
