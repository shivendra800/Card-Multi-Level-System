<?php

namespace App\Http\Controllers\Admin;

use App\Models\WalletHCMS;
use Illuminate\Http\Request;
use App\Models\PatientDetails;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
  public function state_report()
    {
       $stateWalletTrans= WalletHCMS::where('state_percentage','!=',0)->join('states','states.id','wallet.assign_state')->select('wallet.*','states.state_name')->orderby('created_at','DESC')->get()->toArray();
       $stateWalletHelathCardTrans= DB::table('wallet_healthcard')->where('state_percentage','!=',0)->join('states','states.id','wallet_healthcard.assign_state')->select('wallet_healthcard.*','states.state_name')->orderby('created_at','DESC')->get();
       $stateWalletHospitalTrans= DB::table('wallet_hospital')->where('wallet_hospital.state_per_amount','!=',0)->join('admins','admins.id','wallet_hospital.hospital_id')->join('states','states.id','admins.state')->select('wallet_hospital.*','states.state_name')->orderby('created_at','DESC')->get();
       $stateWalletDoctoralTrans= DB::table('wallet_doctor')->where('wallet_doctor.state_per_amount','!=',0)->join('admins','admins.id','wallet_doctor.doctor_id')->join('states','states.id','admins.state')->select('wallet_doctor.*','states.state_name')->orderby('created_at','DESC')->get();
       $stateWalletPathologyalTrans= DB::table('wallet_pathologys')->where('wallet_pathologys.state_per_amount','!=',0)->join('admins','admins.id','wallet_pathologys.pathology_id')->join('states','states.id','admins.state')->select('wallet_pathologys.*','states.state_name')->orderby('created_at','DESC')->get();
       $totalwalletCollection = WalletHCMS::where('state_hcms_trans_amt','!=',0)->sum('state_hcms_trans_amt');
       $totalHealthCardCollection = DB::table('wallet_healthcard')->where('state_hcms_trans_amt','!=',0)->sum('state_hcms_trans_amt');
       $totalDoctorCollection = DB::table('wallet_doctor')->where('state_per_amount','!=',0)->sum('state_per_amount');
       $totalHospitalCollection = DB::table('wallet_hospital')->where('state_per_amount','!=',0)->sum('state_per_amount');
       $totalPathologyCollection = DB::table('wallet_pathologys')->where('state_per_amount','!=',0)->sum('state_per_amount');
       $totalCollection= $totalwalletCollection+$totalHealthCardCollection+$totalHospitalCollection+$totalDoctorCollection+$totalPathologyCollection;
      return view('admin.report.state_report')->with(compact('stateWalletTrans','stateWalletHelathCardTrans',
      'stateWalletHospitalTrans','stateWalletDoctoralTrans','stateWalletPathologyalTrans','totalwalletCollection','totalHealthCardCollection',
      'totalDoctorCollection','totalHospitalCollection','totalPathologyCollection','totalCollection'));
    }
    public function DistrictReport()
    {
       $stateWalletTrans= WalletHCMS::where('district_percentage','!=',0)->join('states','states.id','wallet.assign_state')->join('districts','districts.id','wallet.assign_dist')->select('wallet.*','states.state_name','districts.district_name')->orderby('created_at','DESC')->get()->toArray();
       $stateWalletHelathCardTrans= DB::table('wallet_healthcard')->where('district_percentage','!=',0)->join('states','states.id','wallet_healthcard.assign_state')->join('districts','districts.id','wallet_healthcard.assign_dist')->select('wallet_healthcard.*','states.state_name','districts.district_name')->orderby('created_at','DESC')->get();
       $stateWalletHospitalTrans= DB::table('wallet_hospital')->where('wallet_hospital.district_per_amount','!=',0)->join('admins','admins.id','wallet_hospital.hospital_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->select('wallet_hospital.*','states.state_name','districts.district_name')->orderby('created_at','DESC')->get();
       $stateWalletDoctoralTrans= DB::table('wallet_doctor')->where('wallet_doctor.district_per_amount','!=',0)->join('admins','admins.id','wallet_doctor.doctor_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->select('wallet_doctor.*','states.state_name','districts.district_name')->orderby('created_at','DESC')->get();
       $stateWalletPathologyalTrans= DB::table('wallet_pathologys')->where('wallet_pathologys.district_per_amount','!=',0)->join('admins','admins.id','wallet_pathologys.pathology_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->select('wallet_pathologys.*','states.state_name','districts.district_name')->orderby('created_at','DESC')->get();
       $totalwalletCollection = WalletHCMS::where('dist_hcms_trans_amt','!=',0)->sum('dist_hcms_trans_amt');
       $totalHealthCardCollection = DB::table('wallet_healthcard')->where('dist_hcms_trans_amt','!=',0)->sum('dist_hcms_trans_amt');
       $totalDoctorCollection = DB::table('wallet_doctor')->where('district_per_amount','!=',0)->sum('district_per_amount');
       $totalHospitalCollection = DB::table('wallet_hospital')->where('district_per_amount','!=',0)->sum('district_per_amount');
       $totalPathologyCollection = DB::table('wallet_pathologys')->where('district_per_amount','!=',0)->sum('district_per_amount');
       $totalCollection= $totalwalletCollection+$totalHealthCardCollection+$totalHospitalCollection+$totalDoctorCollection+$totalPathologyCollection;
       return view('admin.report.district_report')->with(compact('stateWalletTrans','stateWalletHelathCardTrans',
      'stateWalletHospitalTrans','stateWalletDoctoralTrans','stateWalletPathologyalTrans','totalwalletCollection','totalHealthCardCollection',
      'totalDoctorCollection','totalHospitalCollection','totalPathologyCollection','totalCollection'));
    }
    public function CityHeadReport()
    {
       $stateWalletHelathCardTrans= DB::table('wallet_healthcard')->where('city_percentage','!=',0)->join('states','states.id','wallet_healthcard.assign_state')->join('districts','districts.id','wallet_healthcard.assign_dist')->join('cities','cities.id','wallet_healthcard.assign_city')->select('wallet_healthcard.*','states.state_name','districts.district_name','cities.city_name')->orderby('created_at','DESC')->get();
       $stateWalletHospitalTrans= DB::table('wallet_hospital')->where('wallet_hospital.city_per_amount','!=',0)->join('admins','admins.id','wallet_hospital.hospital_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->join('cities','cities.id','admins.city')->select('wallet_hospital.*','states.state_name','districts.district_name','cities.city_name')->orderby('created_at','DESC')->get();
       $stateWalletDoctoralTrans= DB::table('wallet_doctor')->where('wallet_doctor.city_per_amount','!=',0)->join('admins','admins.id','wallet_doctor.doctor_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->join('cities','cities.id','admins.city')->select('wallet_doctor.*','states.state_name','districts.district_name','cities.city_name')->orderby('created_at','DESC')->get();
       $stateWalletPathologyalTrans= DB::table('wallet_pathologys')->where('wallet_pathologys.city_per_amount','!=',0)->join('admins','admins.id','wallet_pathologys.pathology_id')->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')->join('cities','cities.id','admins.city')->select('wallet_pathologys.*','states.state_name','districts.district_name','cities.city_name')->orderby('created_at','DESC')->get();

       $totalHealthCardCollection = DB::table('wallet_healthcard')->where('city_hcms_trans_amt','!=',0)->sum('city_hcms_trans_amt');
       $totalDoctorCollection = DB::table('wallet_doctor')->where('city_per_amount','!=',0)->sum('city_per_amount');
       $totalHospitalCollection = DB::table('wallet_hospital')->where('city_per_amount','!=',0)->sum('city_per_amount');
       $totalPathologyCollection = DB::table('wallet_pathologys')->where('city_per_amount','!=',0)->sum('city_per_amount');
       $totalCollection= $totalHealthCardCollection+$totalHospitalCollection+$totalDoctorCollection+$totalPathologyCollection;
       return view('admin.report.city_report')->with(compact('stateWalletHelathCardTrans',
      'stateWalletHospitalTrans','stateWalletDoctoralTrans','stateWalletPathologyalTrans','totalHealthCardCollection',
      'totalDoctorCollection','totalHospitalCollection','totalPathologyCollection','totalCollection'));
    }
    public function HealthCardReport()
    {
       $stateWalletHelathCardTrans= DB::table('wallet_healthcard')->where('healthcard_percentage','!=',0)->join('states','states.id','wallet_healthcard.assign_state')->join('districts','districts.id','wallet_healthcard.assign_dist')->join('cities','cities.id','wallet_healthcard.assign_city')->join('admins','admins.id','wallet_healthcard.selected_referred_user_id')->select('wallet_healthcard.*','states.state_name','districts.district_name','cities.city_name','admins.name','admins.member_id')->orderby('created_at','DESC')->get();
       $totalHealthCardCollection = DB::table('wallet_healthcard')->where('city_hcms_trans_amt','!=',0)->sum('city_hcms_trans_amt');
       return view('admin.report.Healthcard_report')->with(compact('stateWalletHelathCardTrans','totalHealthCardCollection'));
    }

    public function hospital_report()
    {

      
        $gettbldatawallet_hospital = DB::table('wallet_hospital')
        ->join('admins','admins.id','wallet_hospital.hospital_id')
          ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
          ->join('cities','cities.id','admins.city')
          ->select('wallet_hospital.*','states.state_name','districts.district_name','cities.city_name')
          ->get();

          $todayDate = Carbon::now()->format('Y-m-d');
          $thisMonth = Carbon::now()->format('m');
          $thisYear = Carbon::now()->format('Y');

              $totalPatientDetails = PatientDetails::where('hospital_id','!=',0)->count();
      
          $todayPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->count();
          $thisMonthPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
          $thisYearPatientDetails = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->count();
      
          $totalPatientDetailsadiscountamount = PatientDetails::where('hospital_id','!=',0)->sum('paitent_discount_amount');
          $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
          $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
          $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');
      
          $totalPatientdischargeamount = PatientDetails::where('hospital_id','!=',0)->sum('after_discount_finall_bill');
          $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
          $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
          $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');
      
      
          $totalcompanycommission = PatientDetails::where('hospital_id','!=',0)->sum('company_commission_amount');
          $totalDaycompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
          $totalMonthscompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
          $totalYearcompanycommission = DB::table('add_paitent_details')->where('hospital_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
        return view('admin.report.hospital_report')->with(compact(
                                                'gettbldatawallet_hospital',
                                                'totalPatientDetails',
                                                'todayPatientDetails',
                                                'thisMonthPatientDetails',
                                                'thisYearPatientDetails',
                                                'totalDayPatientDetailsadiscountamount',
                                                'totalPatientDetailsadiscountamount',
                                                'totalMonthsPatientDetailsadiscountamount',
                                                'totalYearPatientDetailsadiscountamount',
                                                'totalDayPatientdischargeamount',
                                                'totalPatientdischargeamount',
                                                'totalMonthsPatientdischargeamount',
                                                'totalYearPatientdischargeamount',
                                                'totalDaycompanycommission',
                                                'totalcompanycommission',
                                                'totalMonthscompanycommission',
                                                'totalYearcompanycommission'

        ));
    }
    public function ClinicDoctorReport()
    {
     

      $gettbldatawallet_doctor = DB::table('wallet_doctor')
      ->join('admins','admins.id','wallet_doctor.doctor_id')
        ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
        ->join('cities','cities.id','admins.city')
        ->select('wallet_doctor.*','states.state_name','districts.district_name','cities.city_name')
        ->get();
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        $totalPatientDetails = PatientDetails::where('doctor_id','!=',0)->count();
        $todayPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->count();
        $thisMonthPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
        $thisYearPatientDetails = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->count();

        $totalPatientDetailsadiscountamount = PatientDetails::where('doctor_id','!=',0)->sum('paitent_discount_amount');
        $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
        $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
        $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

        $totalPatientdischargeamount = PatientDetails::where('doctor_id','!=',0)->sum('after_discount_finall_bill');
        $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
        $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
        $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


        $totalcompanycommission = PatientDetails::where('doctor_id','!=',0)->sum('company_commission_amount');
        $totalDaycompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
        $totalMonthscompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
        $totalYearcompanycommission = DB::table('add_paitent_details')->where('doctor_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');

      return view('admin.report.clinic_report')->with(compact('gettbldatawallet_doctor', 'totalPatientDetails',
      'todayPatientDetails',
      'thisMonthPatientDetails',
      'thisYearPatientDetails',
      'totalDayPatientDetailsadiscountamount',
      'totalPatientDetailsadiscountamount',
      'totalMonthsPatientDetailsadiscountamount',
      'totalYearPatientDetailsadiscountamount',
      'totalDayPatientdischargeamount',
      'totalPatientdischargeamount',
      'totalMonthsPatientdischargeamount',
      'totalYearPatientdischargeamount',
      'totalDaycompanycommission',
      'totalcompanycommission',
      'totalMonthscompanycommission',
      'totalYearcompanycommission'));
    }
    public function PathologyReport()
    {
      $gettbldatawallet_pathology = DB::table('wallet_pathologys')
      ->join('admins','admins.id','wallet_pathologys.pathology_id')
        ->join('states','states.id','admins.state')->join('districts','districts.id','admins.district')
        ->join('cities','cities.id','admins.city')
        ->select('wallet_pathologys.*','states.state_name','districts.district_name','cities.city_name')
        ->get();
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        $totalPatientDetails = PatientDetails::where('pathology_id','!=',0)->count();

        $todayPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->count();
        $thisMonthPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->count();
        $thisYearPatientDetails = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->count();

        $totalPatientDetailsadiscountamount = PatientDetails::where('pathology_id','!=',0)->sum('paitent_discount_amount');
        $totalDayPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('paitent_discount_amount');
        $totalMonthsPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('paitent_discount_amount');
        $totalYearPatientDetailsadiscountamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('paitent_discount_amount');

        $totalPatientdischargeamount = PatientDetails::where('pathology_id','!=',0)->sum('after_discount_finall_bill');
        $totalDayPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('after_discount_finall_bill');
        $totalMonthsPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('after_discount_finall_bill');
        $totalYearPatientdischargeamount = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('after_discount_finall_bill');


        $totalcompanycommission = PatientDetails::where('pathology_id','!=',0)->sum('company_commission_amount');
        $totalDaycompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereDate('created_at', $todayDate)->sum('company_commission_amount');
        $totalMonthscompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereMonth('created_at', $thisMonth)->sum('company_commission_amount');
        $totalYearcompanycommission = DB::table('add_paitent_details')->where('pathology_id','!=',0)->whereYear('created_at', $thisYear)->sum('company_commission_amount');
      return view('admin.report.pathology_report')->with(compact('gettbldatawallet_pathology', 'totalPatientDetails',
            'todayPatientDetails',
            'thisMonthPatientDetails',
            'thisYearPatientDetails',
            'totalDayPatientDetailsadiscountamount',
            'totalPatientDetailsadiscountamount',
            'totalMonthsPatientDetailsadiscountamount',
            'totalYearPatientDetailsadiscountamount',
            'totalDayPatientdischargeamount',
            'totalPatientdischargeamount',
            'totalMonthsPatientdischargeamount',
            'totalYearPatientdischargeamount',
            'totalDaycompanycommission',
            'totalcompanycommission',
            'totalMonthscompanycommission',
            'totalYearcompanycommission'));
      
    }
    public function LevelIncomeHistoryReport()
    {
      $tabledata = DB::table('income2')->get();
      return view('admin.report.level_income_history_report')->with(compact('tabledata'));
    }
    
}
