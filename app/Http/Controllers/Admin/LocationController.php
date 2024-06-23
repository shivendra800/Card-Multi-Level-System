<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function state()
    {
          Session::put('page','state');
        $states = State::get()->toArray();
        return view('admin.locations.state')->with(compact('states'));
    }
    public function UpdatestateStatus(Request $request)
    {
        Session::put('page','state');
        if ($request->ajax()) {

            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            State::where('id', $data['state_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'state_id' => $data['state_id']]);
        }
    }
    public function district()
    {
        Session::put('page','district');
        $districts = District::select('districts.*','states.state_name')
        ->join('states','states.id','=','districts.state_id')->get()->toArray();
    // dd( $districts);
        return view('admin.locations.district')->with(compact('districts'));
    }
    public function UpdatedistrictStatus(Request $request)
    {
        Session::put('page','district');
        if ($request->ajax()) {

            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            District::where('id', $data['district_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'district_id' => $data['district_id']]);
        }
    }
    public function city()
    {
        Session::put('page','city');
        $citys = City::select('cities.*','states.state_name','districts.district_name')->join('states','states.id','=','cities.state_id')->join('districts','districts.id','=','cities.district_id')->get()->toArray();
       //dd($citys);
        return view('admin.locations.city_town_village')->with(compact('citys'));
    }
    public function UpdatecityStatus(Request $request)
    {
        Session::put('page','city');
        if ($request->ajax()) {

            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            City::where('id', $data['city_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'city_id' => $data['city_id']]);
        }
    }

    public function create($id=null)
    {

        $states= State::get()->toArray();
        $districts= District::get()->toArray();

        return view('admin.locations.add_edit_city')->with(compact('states','districts'));
    }
    public function AddEditCity(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'district_id' => 'required',
            'city_name' => 'required',


        ]);
         $data = array(

             'state_id' => $request->get('state_id'),
             'district_id' => $request->get('district_id'),
             'city_name' => $request->get('city_name'),
             'created_at' => date('Y-m-d H:i:s'),
         );
        //  dd($data);
         DB::table('cities')->insert($data);
         Session::flash('success', 'Content is added Successfully');
         return redirect('admin/city');
    }
        // find city state wise
      }
