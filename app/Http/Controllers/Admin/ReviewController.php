<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Reviews;
use Illuminate\Http\Request;
use App\Models\PatientDetails;
use App\Models\HospitalManagements;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function AddEditReview (Request $request,$id)
    {
        $getPatientDetails= PatientDetails::where('id',$id)->first();
        $getadminDetails= Admin::where('id',$getPatientDetails['hospital_id'])->first();
        $reviews = Reviews::where('paitent_id',$getPatientDetails['id'])->count();
        $PaitentDetails = PatientDetails::find($id);
        $title = "Reviews";
        $message = "Reviews Update Successfully!";
        if ($request->isMethod('post')) {
            $data = $request->all();
                if($reviews > 0){
                        $reviews = Reviews::where('paitent_id',$id)->first();
                $reviews->comment = $data['comment'];
                $reviews->rate = $data['rate'];
                $reviews->customer_name = Auth::guard('admin')->user()->name;
                $reviews->type = $getadminDetails['type'];
                $reviews->hospital_id = $getadminDetails['hospital_id'];
                $reviews->paitent_id = $getPatientDetails['id'];
                $reviews->customer_id = Auth::guard('admin')->user()->id;
                $reviews->save();
                }else {
                $reviews = new Reviews;
                $reviews->comment = $data['comment'];
                $reviews->rate = $data['rate'];
                $reviews->customer_name = Auth::guard('admin')->user()->name;
                $reviews->type = $getadminDetails['type'];
                $reviews->hospital_id = $getadminDetails['hospital_id'];
                $reviews->paitent_id = $getPatientDetails['id'];
                $reviews->customer_id = Auth::guard('admin')->user()->id;
                $reviews->save();

                }
            return redirect('admin/hospital-Invoice-Customer-wise')->with('success_message', $message);
        }
              $reviewss=Reviews::where('paitent_id','=',$id)->first();
        return view('admin.review.add_edit_review')->with(compact('title','reviews','PaitentDetails','reviewss'));
    }


    public function AddEditDoctorReview (Request $request,$id)
    {
        $getPatientDetails= PatientDetails::where('id',$id)->first();
        $getadminDetails= Admin::where('id',$getPatientDetails['doctor_id'])->first();
        $reviews = Reviews::where('paitent_id',$getPatientDetails['id'])->count();
        $PaitentDetails = PatientDetails::find($id);
        $title = "Reviews";
        $message = "Reviews Update Successfully!";
        if ($request->isMethod('post')) {
            $data = $request->all();
                if($reviews > 0){
                        $reviews = Reviews::where('paitent_id',$id)->first();
                $reviews->comment = $data['comment'];
                $reviews->rate = $data['rate'];
                $reviews->customer_name = Auth::guard('admin')->user()->name;
                $reviews->type = $getadminDetails['type'];
                $reviews->doctor_id = $getadminDetails['doctor_id'];
                $reviews->paitent_id = $getPatientDetails['id'];
                $reviews->customer_id = Auth::guard('admin')->user()->id;
                $reviews->save();
                }else {
                $reviews = new Reviews;
                $reviews->comment = $data['comment'];
                $reviews->rate = $data['rate'];
                $reviews->customer_name = Auth::guard('admin')->user()->name;
                $reviews->type = $getadminDetails['type'];
                $reviews->doctor_id = $getadminDetails['doctor_id'];
                $reviews->paitent_id = $getPatientDetails['id'];
                $reviews->customer_id = Auth::guard('admin')->user()->id;
                $reviews->save();

                }
            return redirect('admin/ClinicDoctor-Invoice-Customer-wise')->with('success_message', $message);
        }
              $reviewss=Reviews::where('paitent_id','=',$id)->first();
        return view('admin.review.add_edit_dreview')->with(compact('title','reviews','PaitentDetails','reviewss'));
    }

    public function AddEditPathologyReview (Request $request,$id)
        {
            $getPatientDetails= PatientDetails::where('id',$id)->first();
            $getadminDetails= Admin::where('id',$getPatientDetails['pathology_id'])->first();
            $reviews = Reviews::where('paitent_id',$getPatientDetails['id'])->count();
            $PaitentDetails = PatientDetails::find($id);
            $title = "Reviews";
            $message = "Reviews Update Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                    if($reviews > 0){
                            $reviews = Reviews::where('paitent_id',$id)->first();
                    $reviews->comment = $data['comment'];
                    $reviews->rate = $data['rate'];
                    $reviews->customer_name = Auth::guard('admin')->user()->name;
                    $reviews->type = $getadminDetails['type'];
                    $reviews->pathology_id = $getadminDetails['pathology_id'];
                    $reviews->paitent_id = $getPatientDetails['id'];
                    $reviews->customer_id = Auth::guard('admin')->user()->id;
                    $reviews->save();
                    }else {
                    $reviews = new Reviews;
                    $reviews->comment = $data['comment'];
                    $reviews->rate = $data['rate'];
                    $reviews->customer_name = Auth::guard('admin')->user()->name;
                    $reviews->type = $getadminDetails['type'];
                    $reviews->pathology_id = $getadminDetails['pathology_id'];
                    $reviews->paitent_id = $getPatientDetails['id'];
                    $reviews->customer_id = Auth::guard('admin')->user()->id;
                    $reviews->save();
    
                    }
                return redirect('admin/Pathology-wise-customer-Invoice')->with('success_message', $message);
            }
            $reviewss=Reviews::where('paitent_id','=',$id)->first();
            return view('admin.review.add_edit_preview')->with(compact('title','reviews','PaitentDetails','reviewss'));
        }
}

