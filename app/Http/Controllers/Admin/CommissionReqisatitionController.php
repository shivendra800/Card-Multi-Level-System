<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionReqisatitionAmount;

class CommissionReqisatitionController extends Controller
{
    public function StateCommissionReqAmou()
    {
        $statecomReq = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','state-head-hcms')->get()->toArray();
        return view('admin.commssionreqam.state_commission_req_list')->with(compact('statecomReq'));
    }

    public function AddEditCommReqAmState(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add State Head Commision & Req Amount";
            $statecomR = new CommissionReqisatitionAmount;
            $message = "State Head Commision & Req Amount  Add Successfully!";
        } else {
            $title = "Edit State Head Commision & Req Amount";
            $statecomR = CommissionReqisatitionAmount::find($id);
            $message = "State Head Commision & Req Amount Update Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;


            $statecomR->admin_type = 'state-head-hcms';
            $statecomR->state_commission = $data['state_commission'];
            $statecomR->state_reqistation_amount = $data['state_reqistation_amount'];
            $statecomR->gst_percentage = $data['gst_percentage'];
            $statecomR->gst_percentage_amount = $data['gst_percentage_amount'];
            $statecomR->total_state_reqistation_amount = $data['total_state_reqistation_amount'];
            $statecomR->created_by = Auth::guard('admin')->user()->id;
            $statecomR->district_commission = 0;
            $statecomR->distrcit_reqistation_amount     = 0;
            $statecomR->city_commission = 0;
            $statecomR->city_reqistation_amount = 0;
            $statecomR->healthcard_commission = 0;
            $statecomR->save();

            return redirect('admin/state-commsion-req')->with('success_message', $message);
        }
        return view('admin.commssionreqam.add_edit_comm_req_state')->with(compact('title', 'statecomR'));
    }

    public function DistrictCommissionReqAmou()
    {
        $districtcomReq = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','district-head-hcms')->get()->toArray();
        return view('admin.commssionreqam.district_commission_req_list')->with(compact('districtcomReq'));
    }

    public function AddEditCommReqAmdistrict(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add District Head Commision & Req Amount";
            $districtcomR = new CommissionReqisatitionAmount;
            $message = "State Head Commision & Req Amount  Add Successfully!";
        } else {
            $title = "Edit State Head Commision & Req Amount";
            $districtcomR = CommissionReqisatitionAmount::find($id);
            $message = "State Head Commision & Req Amount Update Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;


            $districtcomR->admin_type = 'district-head-hcms';
            $districtcomR->state_commission = $data['state_commission'];
            $districtcomR->state_reqistation_amount = 0;
            $districtcomR->created_by = Auth::guard('admin')->user()->id;
            $districtcomR->district_commission = $data['district_commission'];
            $districtcomR->distrcit_reqistation_amount     = $data['distrcit_reqistation_amount'];
            $districtcomR->gst_percentage = $data['gst_percentage'];
            $districtcomR->gst_percentage_amount = $data['gst_percentage_amount'];
            $districtcomR->total_state_reqistation_amount = $data['total_state_reqistation_amount'];
            $districtcomR->city_commission = 0;
            $districtcomR->city_reqistation_amount = 0;
            $districtcomR->healthcard_commission = 0;
            $districtcomR->save();

            return redirect('admin/district-commsion-req')->with('success_message', $message);
        }
        return view('admin.commssionreqam.add_edit_comm_req_district')->with(compact('title', 'districtcomR'));
    }

    public function CityCommissionReqAmou()
    {
        $CitycomReq = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','city-head-hcms')->get()->toArray();
        return view('admin.commssionreqam.city_commission_req_list')->with(compact('CitycomReq'));
    }

    public function AddEditCommReqAmcity(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add City Head Commision & Req Amount";
            $CitycomR = new CommissionReqisatitionAmount;
            $message = "City Head Commision & Req Amount  Add Successfully!";
        } else {
            $title = "Edit City Head Commision & Req Amount";
            $CitycomR = CommissionReqisatitionAmount::find($id);
            $message = "City Head Commision & Req Amount Update Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;


            $CitycomR->admin_type = 'city-head-hcms';
            $CitycomR->state_commission = $data['state_commission'];
            $CitycomR->state_reqistation_amount = 0;
            $CitycomR->created_by = Auth::guard('admin')->user()->id;
            $CitycomR->district_commission = $data['district_commission'];
            $CitycomR->distrcit_reqistation_amount     = 0;
            $CitycomR->city_commission = $data['city_commission'];
            $CitycomR->city_reqistation_amount = $data['city_reqistation_amount'];
            $CitycomR->gst_percentage = $data['gst_percentage'];
            $CitycomR->gst_percentage_amount = $data['gst_percentage_amount'];
            $CitycomR->total_state_reqistation_amount = $data['total_state_reqistation_amount'];
            $CitycomR->healthcard_commission = 0;
            $CitycomR->save();

            return redirect('admin/city-commsion-req')->with('success_message', $message);
        }
        return view('admin.commssionreqam.add_edit_comm_req_city')->with(compact('title', 'CitycomR'));
    }

    public function healthcardCommissionReqAmou()
    {
        $healthcardcom = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','Health_card_Customer')->get()->toArray();
        return view('admin.commssionreqam.healthcard_commission_req_list')->with(compact('healthcardcom'));
    }

    public function AddEditCommReqAmhealthcard(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add Health Card Commsission";
            $healthcarcom = new CommissionReqisatitionAmount;
            $message = "Health Card Commsission  Add Successfully!";
        } else {
            $title = "Edit Health Card Commsission";
            $healthcarcom = CommissionReqisatitionAmount::find($id);
            $message = "Health Card Commsission Update Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;


            $healthcarcom->admin_type = 'Health_card_Customer';
            $healthcarcom->state_commission = $data['state_commission'];
            $healthcarcom->state_reqistation_amount = 0;
            $healthcarcom->created_by = Auth::guard('admin')->user()->id;
            $healthcarcom->district_commission = $data['district_commission'];
            $healthcarcom->distrcit_reqistation_amount     = 0;
            $healthcarcom->city_commission = $data['city_commission'];
            $healthcarcom->city_reqistation_amount = 0;
            $healthcarcom->healthcard_commission = $data['healthcard_commission'];
            $healthcarcom->save();

            return redirect('admin/city-commsion-req')->with('success_message', $message);
        }
        return view('admin.commssionreqam.add_edit_comm_req_healthcard')->with(compact('title', 'healthcarcom'));
    }

    public function HospitalCommission()
    {
        $hospitalcommis = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','Hospital')->get()->toArray();
        return view('admin.commssionreqam.hospital_commission_req_list')->with(compact('hospitalcommis'));
    }
    public function AddEdithospitalcommper(Request $request, $id = null)
    {
            $title = "Edit Hospital Commsission";
            $healthcarcom = CommissionReqisatitionAmount::find($id);
            $message = "Hospital Commsission Update Successfully!";
            $sum_per = $request->state_commission +  $request->district_commission + $request->city_commission;
        if ($request->isMethod('post')) {

            if($sum_per == 50)
            {
                $data = $request->all();
                // echo "<pre>";
                // print_r($data);
                // die;
                $healthcarcom->admin_type = 'Hospital';
                $healthcarcom->state_commission = $data['state_commission'];
                $healthcarcom->state_reqistation_amount = 0;
                $healthcarcom->created_by = Auth::guard('admin')->user()->id;
                $healthcarcom->district_commission = $data['district_commission'];
                $healthcarcom->distrcit_reqistation_amount     = 0;
                $healthcarcom->city_commission = $data['city_commission'];
                $healthcarcom->city_reqistation_amount = 0;
                $healthcarcom->save();
                return redirect('admin/hospital-commsion-req')->with('success_message', $message);
            }else{
                $message =  $sum_per." "."You Entered Wrong No, Please enter valid no so that  Plus of All Percentage should be not more than 50 not less than 50 !";
                return redirect('admin/hospital-commsion-req')->with('error_message', $message);
            }
        }
        return view('admin.commssionreqam.add_edit_comm_req_hospital')->with(compact('title', 'healthcarcom'));
    }
    public function ClinicDoctorCommission()
    {
        $Doctorcommis = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','Clinic-Doctor')->get()->toArray();
        return view('admin.commssionreqam.doctor_commission_req_list')->with(compact('Doctorcommis'));
    }
    public function AddEditClinicDoctorcommper(Request $request, $id = null)
    {
            $title = "Edit clinic Doctor Commsission";
            $healthcarcom = CommissionReqisatitionAmount::find($id);
            $message = "Clinic Doctor Commsission Update Successfully!";
            $sum_per = $request->state_commission +  $request->district_commission + $request->city_commission;
        if ($request->isMethod('post')) {

            if($sum_per == 50)
            {
                $data = $request->all();
                // echo "<pre>";
                // print_r($data);
                // die;
                $healthcarcom->admin_type = 'Clinic-Doctor';
                $healthcarcom->state_commission = $data['state_commission'];
                $healthcarcom->state_reqistation_amount = 0;
                $healthcarcom->created_by = Auth::guard('admin')->user()->id;
                $healthcarcom->district_commission = $data['district_commission'];
                $healthcarcom->distrcit_reqistation_amount     = 0;
                $healthcarcom->city_commission = $data['city_commission'];
                $healthcarcom->city_reqistation_amount = 0;
                $healthcarcom->save();
                return redirect('admin/ClinicDoctor-commsion-req')->with('success_message', $message);
            }else{
                $message =  $sum_per." "."You Entered Wrong No, Please enter valid no so that  Plus of All Percentage should be not more than 50 not less than 50 !";
                return redirect('admin/ClinicDoctor-commsion-req')->with('error_message', $message);
            }
        }
        return view('admin.commssionreqam.add_edit_comm_req_clinicdoctor')->with(compact('title', 'healthcarcom'));
    }
    public function PathologyCommission()
    {
        $Pathologycommis = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','Pathology')->get()->toArray();
        return view('admin.commssionreqam.pathology_commission_req_list')->with(compact('Pathologycommis'));
    }
    public function AddEditPathologycommper(Request $request, $id = null)
    {
            $title = "Edit Pathology Commsission";
            $healthcarcom = CommissionReqisatitionAmount::find($id);
            $message = "Pathology Commsission Update Successfully!";
            $sum_per = $request->state_commission +  $request->district_commission + $request->city_commission;
        if ($request->isMethod('post')) {

            if($sum_per == 50)
            {
                $data = $request->all();
                // echo "<pre>";
                // print_r($data);
                // die;
                $healthcarcom->admin_type = 'Pathology';
                $healthcarcom->state_commission = $data['state_commission'];
                $healthcarcom->state_reqistation_amount = 0;
                $healthcarcom->created_by = Auth::guard('admin')->user()->id;
                $healthcarcom->district_commission = $data['district_commission'];
                $healthcarcom->distrcit_reqistation_amount     = 0;
                $healthcarcom->city_commission = $data['city_commission'];
                $healthcarcom->city_reqistation_amount = 0;
                $healthcarcom->save();
                return redirect('admin/Pathology-commsion-req')->with('success_message', $message);
            }else{
                $message =  $sum_per." "."You Entered Wrong No, Please enter valid no so that  Plus of All Percentage should be not more than 50 not less than 50 !";
                return redirect('admin/Pathology-commsion-req')->with('error_message', $message);
            }
        }
        return view('admin.commssionreqam.add_edit_comm_req_pathology')->with(compact('title', 'healthcarcom'));
    }

    public function ambulanceCommission()
    {
        $ambulancecommis = CommissionReqisatitionAmount::where('commission_reqistation_amount.admin_type','=','Ambulance')->get()->toArray();
        return view('admin.commssionreqam.ambulance_commission_req_list')->with(compact('ambulancecommis'));
    }
    public function AddEditambulancecommper(Request $request, $id = null)
    {
            $title = "Edit Ambulance Commsission";
            $ambulancecommis = CommissionReqisatitionAmount::find($id);
            $message = "Ambulance Commsission Update Successfully!";
            $sum_per = $request->state_commission +  $request->district_commission + $request->city_commission;
        if ($request->isMethod('post')) {

            if($sum_per == 50)
            {
                $data = $request->all();
                // echo "<pre>";
                // print_r($data);
                // die;
                $ambulancecommis->admin_type = 'Ambulance';
                $ambulancecommis->state_commission = $data['state_commission'];
                $ambulancecommis->state_reqistation_amount = 0;
                $ambulancecommis->created_by = Auth::guard('admin')->user()->id;
                $ambulancecommis->district_commission = $data['district_commission'];
                $ambulancecommis->distrcit_reqistation_amount     = 0;
                $ambulancecommis->city_commission = $data['city_commission'];
                $ambulancecommis->city_reqistation_amount = 0;
                $ambulancecommis->save();
                return redirect('admin/ambulance-commsion-req')->with('success_message', $message);
            }else{
                $message =  $sum_per." "."You Entered Wrong No, Please enter valid no so that  Plus of All Percentage should be not more than 50 not less than 50 !";
                return redirect('admin/ambulance-commsion-req')->with('error_message', $message);
            }
        }
        return view('admin.commssionreqam.add_edit_comm_req_ambulance')->with(compact('title', 'ambulancecommis'));
    }
}
