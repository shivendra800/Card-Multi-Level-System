<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class APIController extends Controller
{
    public function getdiststatewise($stateid)
    {
        try {

            $dist_statewise = DB::table('districts')->where('state_id',$stateid)->get();
            $json['api_status'] = "OK";
            $json['data'] = $dist_statewise;
            $json['msg'] = "";
        } catch (\Exception $e) {
            DB::rollback();

            $json['api_status'] = "ERROR";
            $json['msg'] = "Error-" . $e->getLine() . " :- " . $e->getMessage();

        }
        header('Content-type: application/json');
        echo json_encode($json);
    }
    public function getcitydistwise($distid)
    {
        try {

            $city_distwise = DB::table('cities')->where('district_id',$distid)->get();
            $json['api_status'] = "OK";
            $json['data'] = $city_distwise;
            $json['msg'] = "";
        } catch (\Exception $e) {
            DB::rollback();

            $json['api_status'] = "ERROR";
            $json['msg'] = "Error-" . $e->getLine() . " :- " . $e->getMessage();

        }
        header('Content-type: application/json');
        echo json_encode($json);
    }
    public function getamountcardwise($health_card_type)
    {
        try {
            $health_card_type = DB::table('health_card_type')->where('id',$health_card_type)->get();
            $json['api_status'] = "OK";
            $json['data'] = $health_card_type;
            $json['msg'] = "";
        } catch (\Exception $e) {
            DB::rollback();
            $json['api_status'] = "ERROR";
            $json['msg'] = "Error-" . $e->getLine() . " :- " . $e->getMessage();
        }
        header('Content-type: application/json');
        echo json_encode($json);
    }
    public function getsubcategory($cate_id)
    {
        try {
            $subcategory = DB::table('medicine_sub_categories')->where('medicine_category_id',$cate_id)->get();
            $json['api_status'] = "OK";
            $json['data'] = $subcategory;
            $json['msg'] = "";
        } catch (\Exception $e) {
            DB::rollback();
            $json['api_status'] = "ERROR";
            $json['msg'] = "Error-" . $e->getLine() . " :- " . $e->getMessage();
        }
        header('Content-type: application/json');
        echo json_encode($json);
    }
}
