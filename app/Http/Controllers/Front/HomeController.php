<?php

namespace App\Http\Controllers\Front;

use App\Models\Blogs;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SpecializationHospitals;

class HomeController extends Controller
{
    public function index()
    {
        $get_setting_data= DB::table('settings')->first();
        $popularHos = DB::table('create_hospital')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->join('add_multi_images','add_multi_images.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_multi_images.image as multi_images','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)->groupBy('specialization_wise_hospitals.hospital_id')->Paginate('10');
        $getClinicdoctordata = DB::table('create_doctors')
        ->join('states','states.id','create_doctors.state')
        ->join('districts','districts.id','create_doctors.district')
        ->join('cities','cities.id','create_doctors.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.doctor_id','create_doctors.id')
        ->join('add_more_details','add_more_details.doctor_id','create_doctors.doctor_id')
        ->join('add_multi_images','add_multi_images.doctor_id','create_doctors.doctor_id')
        ->select('create_doctors.*','states.state_name','districts.district_name','cities.city_name','add_multi_images.image as multi_images','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_doctors.status','=',1)->groupBy('specialization_wise_hospitals.doctor_id')->Paginate('10');
        $sliderBanners=Banner::where('type','Slider')->get()->toArray();
        $fixBanners=Banner::where('type','Fix')->get()->toArray();
        $AboutUsBanners=Banner::where('type','About-us')->get()->toArray();
        $blog=Blogs::get()->toArray();
        $review = DB::table('reviews')->get();
        return view('front.index')->with(compact('blog','get_setting_data','popularHos','getClinicdoctordata','sliderBanners','fixBanners','AboutUsBanners','review'));
    }

    public function about()
    {
        $get_setting_data= DB::table('settings')->first();
        $AboutUsBanners=Banner::where('type','About-us')->get()->toArray();
        $fixBanners=Banner::where('type','Fix')->get()->toArray();
        return view('front.about')->with(compact('get_setting_data','AboutUsBanners','fixBanners'));
    }

    public function contact()
    {
        $get_setting_data= DB::table('settings')->first();
        return view('front.contact')->with(compact('get_setting_data'));
    }
    public function searchwithhome(Request $request)
    {
        $keyword = $request->get('keyword');
        $service = $request->get('service');
        if($service == "Hospital")
        {
         $gethospitaldata = DB::table('create_hospital')
        ->join('admins','admins.hospital_id','create_hospital.hospital_id')
        ->join('states','states.id','create_hospital.state')
        ->join('districts','districts.id','create_hospital.district')
        ->join('cities','cities.id','create_hospital.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.hospital_id','create_hospital.id')
        ->join('add_more_details','add_more_details.hospital_id','create_hospital.hospital_id')
        ->select('create_hospital.*','states.state_name','districts.district_name','cities.city_name','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_hospital.status','=',1)->groupBy('specialization_wise_hospitals.hospital_id')
        ->where(function($query) use($keyword)  {
            $query->where('create_hospital.name','LIKE','%'.$keyword.'%')
            ->orWhere('specialization_wise_hospitals.specialization_name','LIKE','%'.$keyword.'%')
            ->orWhere('states.state_name','LIKE','%'.$keyword.'%')
            ->orWhere('districts.district_name','LIKE','%'.$keyword.'%')
            ->orWhere('cities.city_name','LIKE','%'.$keyword.'%')
              ;
        })
        ->where('admins.type',$service)
        ->Paginate('10');
        $getspecialization = SpecializationHospitals::get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.hospital.hospital_list')->with(compact('gethospitaldata','getspecialization','get_setting_data')); 
        }
        
        if($service == "Clinic-Doctor")
        {
         $getdoctordata = DB::table('create_doctors')
        ->join('admins','admins.doctor_id','create_doctors.doctor_id')
        ->join('states','states.id','create_doctors.state')
        ->join('districts','districts.id','create_doctors.district')
        ->join('cities','cities.id','create_doctors.city')
        ->join('specialization_wise_hospitals','specialization_wise_hospitals.doctor_id','create_doctors.doctor_id')
        ->join('add_more_details','add_more_details.doctor_id','create_doctors.doctor_id')
        ->select('create_doctors.*','states.state_name','districts.district_name','cities.city_name','add_more_details.sort_description','specialization_wise_hospitals.specialization_name')
        ->where('create_doctors.status','=',1)->groupBy('specialization_wise_hospitals.hospital_id')
        ->where(function($query) use($keyword)  {
            $query->where('create_doctors.name','LIKE','%'.$keyword.'%')
            ->orWhere('create_doctors.clininc_name','LIKE','%'.$keyword.'%')
            ->orWhere('specialization_wise_hospitals.specialization_name','LIKE','%'.$keyword.'%')
            ->orWhere('states.state_name','LIKE','%'.$keyword.'%')
            ->orWhere('districts.district_name','LIKE','%'.$keyword.'%')
            ->orWhere('cities.city_name','LIKE','%'.$keyword.'%')
              ;
        })
        ->where('admins.type',$service)
        ->Paginate('10');
        $getspecialization = SpecializationHospitals::get()->toArray();
        $get_setting_data= DB::table('settings')->first();
        return view('front.doctors.doctors_list')->with(compact('getdoctordata','getspecialization','get_setting_data')); 
        }
        if($service == "Pathology")
        {
         $get_pathology_data = DB::table('create_pathologys')
        ->join('admins','admins.pathology_id','create_pathologys.pathology_id')
        ->join('states','states.id','create_pathologys.state')
        ->join('districts','districts.id','create_pathologys.district')
        ->join('cities','cities.id','create_pathologys.city')
        ->select('create_pathologys.*','states.state_name','districts.district_name','cities.city_name')
        ->where('create_pathologys.status','=',1)
        ->where(function($query) use($keyword)  {
            $query->where('create_pathologys.name','LIKE','%'.$keyword.'%')
            ->orWhere('create_pathologys.clininc_name','LIKE','%'.$keyword.'%')
            ->orWhere('states.state_name','LIKE','%'.$keyword.'%')
            ->orWhere('districts.district_name','LIKE','%'.$keyword.'%')
            ->orWhere('cities.city_name','LIKE','%'.$keyword.'%')
              ;
        })
        ->where('admins.type',$service)
        ->Paginate('10');
        $get_setting_data= DB::table('settings')->first();
        return view('front.pathology.pathology_list')->with(compact('get_pathology_data' ,'get_setting_data')); 
        }

    }
}
