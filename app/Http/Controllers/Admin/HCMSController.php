<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CityHeadHCMS;
use App\Models\IssueHealthCard;
use App\Models\DistrictHeadHCMS;
use Illuminate\Http\Request;
use App\Models\StateHeadHCMS;
use Illuminate\Support\Facades\Auth;

class HCMSController extends Controller
{
    public function dashboard()
    { 
            $total_statehead_amount = StateHeadHCMS::sum('amount');
            $total_disthead_amount = DistrictHeadHCMS::sum('amount');
            $total_cityhead_amount = CityHeadHCMS::sum('amount');
            $total_assigncard = IssueHealthCard::count();
            $total_assigncardamount = IssueHealthCard::sum('health_card_amount');
         
       
           
            $total_disthead_amount_withuser = DistrictHeadHCMS::where('districtheadhcms.created_by',Auth::guard('admin')->user()->id)->sum('amount');
            $total_cityhead_amountwithuser = CityHeadHCMS::where('cityheadhcms.created_by',Auth::guard('admin')->user()->id)->sum('amount');
            $total_assigncardwithuser = IssueHealthCard::where('create_health_card.created_by',Auth::guard('admin')->user()->id)->count();
            $total_assigncardamountwithuser = IssueHealthCard::where('create_health_card.created_by',Auth::guard('admin')->user()->id)->sum('health_card_amount');
        
       
        return view('admin.hcms_dashboard')->with(compact('total_statehead_amount','total_disthead_amount','total_cityhead_amount',
        'total_assigncard','total_assigncardamount','total_disthead_amount_withuser','total_cityhead_amountwithuser',
        'total_assigncardwithuser','total_assigncardamountwithuser'));
    }

    public function profile()
    {
        $stateuser = StateHeadHCMS::join('states','states.id','=','stateheadhcmss.assign_state')
        ->join('admins','admins.id','=','stateheadhcmss.referred_by')
        ->join('states as stateaddress','stateaddress.id','=','stateheadhcmss.state')
        ->join('cities','cities.id','=','stateheadhcmss.city')
        ->join('districts','districts.id','=','stateheadhcmss.district')
        ->select('stateheadhcmss.*','districts.district_name','admins.name as referred_name','admins.type',
        'states.state_name','stateaddress.state_name as state_nameaddress','cities.city_name')
        ->where('stateheadhcmss.id',Auth::guard('admin')->user()->state_head_hcms_id)->first();
        //  dd($distuser);


        $distuser = DistrictHeadHCMS::join('districts','districts.id','=','districtheadhcms.assign_district')
        ->join('admins','admins.id','=','districtheadhcms.referred_by')
        ->join('states','states.id','=','districtheadhcms.state')
        ->join('cities','cities.id','=','districtheadhcms.city')
        ->join('districts as district_name_id','district_name_id.id','=','districtheadhcms.district')

        ->select('districtheadhcms.*','districts.district_name','admins.name as referred_name','admins.type',
        'states.state_name','district_name_id.district_name as district_nameaddress','cities.city_name')
        ->where('districtheadhcms.id',Auth::guard('admin')->user()->district_head_hcms_id)->first();
        //  dd($distuser);

        $cityuser = CityHeadHCMS::join('cities','cities.id','=','cityheadhcms.assign_city')
        ->join('admins','admins.id','=','cityheadhcms.referred_by')
        ->join('states','states.id','=','cityheadhcms.state')
        ->join('districts','districts.id','=','cityheadhcms.district')
        ->join('cities as cityaddress','cityaddress.id','=','cityheadhcms.city')
        ->select('cityheadhcms.*','cities.city_name as assign_city','admins.type','admins.name as referred_name',
        'states.state_name','districts.district_name','cityaddress.city_name')
        ->where('cityheadhcms.id',Auth::guard('admin')->user()->city_head_hcms_id)->first();

        $healthcarduser = IssueHealthCard::join('cities','cities.id','=','create_health_card.assign_city')
        ->join('admins','admins.id','=','create_health_card.referred_by')
        ->join('states','states.id','=','create_health_card.assign_state')
        ->join('districts','districts.id','=','create_health_card.assign_district')
        ->join('health_card_type','health_card_type.id','=','create_health_card.health_card_type')
        ->select('create_health_card.*','cities.city_name','admins.type','admins.name as referred_name',
        'states.state_name','districts.district_name','health_card_type.health_card_type as health_card_type_name')
        ->where('create_health_card.id',Auth::guard('admin')->user()->	health_card_customer_id)->first();

        
         

        return view('admin.hcms_profile')->with(compact('distuser','cityuser','healthcarduser','stateuser'));
    }

    public function AccountDetails()
    {
        $stateuser = StateHeadHCMS::join('states','states.id','=','stateheadhcmss.assign_state')
        ->join('admins','admins.id','=','stateheadhcmss.referred_by')
        ->join('states as stateaddress','stateaddress.id','=','stateheadhcmss.state')
        ->join('cities','cities.id','=','stateheadhcmss.city')
        ->join('districts','districts.id','=','stateheadhcmss.district')
        ->select('stateheadhcmss.*','districts.district_name','admins.name as referred_name','admins.type',
        'states.state_name','stateaddress.state_name as state_nameaddress','cities.city_name')
        ->where('stateheadhcmss.id',Auth::guard('admin')->user()->state_head_hcms_id)->first();
        //  dd($distuser);


        $distuser = DistrictHeadHCMS::join('districts','districts.id','=','districtheadhcms.assign_district')
        ->join('admins','admins.id','=','districtheadhcms.referred_by')
        ->join('states','states.id','=','districtheadhcms.state')
        ->join('cities','cities.id','=','districtheadhcms.city')
        ->join('districts as district_name_id','district_name_id.id','=','districtheadhcms.district')

        ->select('districtheadhcms.*','districts.district_name','admins.name as referred_name','admins.type',
        'states.state_name','district_name_id.district_name as district_nameaddress','cities.city_name')
        ->where('districtheadhcms.id',Auth::guard('admin')->user()->district_head_hcms_id)->first();
        //  dd($distuser);

        $cityuser = CityHeadHCMS::join('cities','cities.id','=','cityheadhcms.assign_city')
        ->join('admins','admins.id','=','cityheadhcms.referred_by')
        ->join('states','states.id','=','cityheadhcms.state')
        ->join('districts','districts.id','=','cityheadhcms.district')
        ->join('cities as cityaddress','cityaddress.id','=','cityheadhcms.city')
        ->select('cityheadhcms.*','cities.city_name as assign_city','admins.type','admins.name as referred_name',
        'states.state_name','districts.district_name','cityaddress.city_name')
        ->where('cityheadhcms.id',Auth::guard('admin')->user()->city_head_hcms_id)->first();

        $healthcarduser = IssueHealthCard::join('cities','cities.id','=','create_health_card.assign_city')
        ->join('admins','admins.id','=','create_health_card.referred_by')
        ->join('states','states.id','=','create_health_card.assign_state')
        ->join('districts','districts.id','=','create_health_card.assign_district')
        ->join('health_card_type','health_card_type.id','=','create_health_card.health_card_type')
        ->select('create_health_card.*','cities.city_name','admins.type','admins.name as referred_name',
        'states.state_name','districts.district_name','health_card_type.health_card_type as health_card_type_name')
        ->where('create_health_card.id',Auth::guard('admin')->user()->	health_card_customer_id)->first();

        
         

        return view('admin.account_tra_histroy')->with(compact('distuser','cityuser','healthcarduser','stateuser'));
    }
}
