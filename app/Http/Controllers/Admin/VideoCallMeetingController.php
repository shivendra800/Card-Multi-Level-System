<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Doctors;
use Illuminate\Http\Request;
use App\Models\VideoCallMeetings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VideoCallMeetingController extends Controller
{
    public function RequestVideoCallDoctor()
    {
        if (Auth::guard('admin')->user()->type == "Clinic-Doctor") {
            $title = "Request Send List";
            $VideoCallReq = VideoCallMeetings::where('video_link','=',NULL)->where('doctor_id','=',Auth::guard('admin')->user()->doctor_id)->get();
        }else{
            $title = "Request Send List";
            $VideoCallReq = VideoCallMeetings::where('video_link','=',NULL)->get();
        }

        return view ('admin.videocall.videocall_request_list')->with(compact('VideoCallReq','title'));
    }
    public function VideocallApprovelList()
    {
        if (Auth::guard('admin')->user()->type == "Clinic-Doctor") {
            $title = "Approvel  List";
            $VideoCallReq = VideoCallMeetings::where('video_link','!=',NULL)->where('doctor_id','=',Auth::guard('admin')->user()->doctor_id)->get();
        }else{
            $title = "Approvel List";
            $VideoCallReq = VideoCallMeetings::where('video_link','!=',NULL)->get();
        }
        return view ('admin.videocall.videocall_request_list')->with(compact('VideoCallReq','title'));
    }

    public function AddEditVideoCallRequest(Request $request, $id)
    {
            $title = "Add";
           $DoctorId = Doctors::find($id);
            $addVideoLink = new VideoCallMeetings();
            $message = "VideoCallMeetings Request Send   Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo"<pre>"; print_r($data); die;
                $addVideoLink->date = $data['date'];
                $addVideoLink->paitent_name = $data['paitent_name'];
                $addVideoLink->caused_disease = $data['caused_disease'];
                $addVideoLink->member_id = Auth::guard('admin')->user()->member_id;
                $addVideoLink->doctor_id = $id;
                $addVideoLink->save();
                return redirect('admin/Request-VideoCall-Doctor')->with('success_message', $message);
            }
        return view ('admin.videocall.add_edit_videoCallRequest')->with(compact('title','addVideoLink','DoctorId'));
    }
    public function AddEditVideoCallLink(Request $request, $id)
    {
            $title = "Add Video";
            DB::beginTransaction();
           $addVideoReqLink = VideoCallMeetings::find($id);
            $message = "VideoCallMeetings Link Send   Successfully!";
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo"<pre>"; print_r($data); die;
                $addVideoReqLink->time = $data['time'];
                $addVideoReqLink->video_link = $data['video_link'];
                $addVideoReqLink->doctor_name =Auth::guard('admin')->user()->name;
                $addVideoReqLink->save();
                     //Send Conifirmation Email
                    //     $getvideoreqdetails= VideoCallMeetings::where('id',$id)->first();
                    //  $getAdminDetails = Admin::where('member_id','=',$getvideoreqdetails['member_id'])->first();
                    //  $email= $getAdminDetails['email'];
                    //  $messageData=[
                    //      'video_link' =>$data['video_link'],
                    //      'time' =>$data['time'],
                    //  ];
                    //  Mail::send('emails.video_call_link_send',$messageData,function($message)use($email){
                    //      $message->to($email)->subject('Meeting Link');
                    //  });
                    //  DB::commit();
                return redirect('admin/Request-VideoCall-Doctor')->with('success_message', $message);
            }
        return view ('admin.videocall.add_edit_videoCallRequestLink')->with(compact('title','addVideoReqLink'));
    }
}
