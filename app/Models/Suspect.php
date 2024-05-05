<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Suspect extends Model
{
    use HasFactory;
    public function getSuspects(){
        $result = DB::table('suspect')
        ->join('cities', 'suspect.city_id', '=', 'cities.id')
        ->join('states', 'suspect.state_id', '=', 'states.id')
        ->join('admin', 'suspect.created_by', '=', 'admin.id')
        ->select('suspect.*','cities.city','states.state','admin.first_name')
        ->where('suspect.status','1')
        ->orderBy('suspect.id')
        ->get();
        return $result;
    }
    public function getSuspectsById($id){
        $result = DB::table('suspect')
        ->join('cities', 'suspect.city_id', '=', 'cities.id')
        ->join('states', 'suspect.state_id', '=', 'states.id')
        ->select('suspect.*','cities.city','states.state')
        ->where('suspect.id',$id)
        ->get();
        return $result;
    }
    public function getSuspectWantedStatesById($id){
        $result = DB::table('wanted_states')
        ->join('states', 'wanted_states.state_id', '=', 'states.id')
        ->select('wanted_states.*','states.*')
        ->where('wanted_states.suspect_id',$id)
        ->get();
        return $result;
    }
    public function storeSuspect($req){
        $all_state ='1';
        if($req->all_state==null){
            $all_state = '0';
        }
        $filePath = $req->file("img")->store("uploads/suspect",'public');
        $uploadedFile = $req->file("img");
        $date = date("Y-m-d H:i:s");
        $insert_suspect = [
            "fname" => $req->fname,
            "lname" => $req->lname,
            "age" => $req->age,
            "gender" => $req->gender,
            "dob" => $req->dob,
            "alert_mode" => $req->alert_mode,
            "alert_admin" => $req->alert_admin,
            "image_name" => $uploadedFile->hashName(),
            "birth_mark" => $req->details,
            "aadhar_card" => $req->aadhar,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
            "all_states" => $all_state,
            "description" => $req->description,
            "created_at" => $date,
            "created_by" => session('id'),
        ];
        $lastId = DB::table('suspect')->insertGetId($insert_suspect);
        $res = false;
        if($all_state == '1'){
            $insert_states = array([
                "suspect_id" => $lastId,
                "state_id" => '0',
            ]);
            $res = DB::table('wanted_states')->insert($insert_states);
        }else{
            $values = $req->wanted_state;
            foreach ($values as $a){
            $insert_states = array([
                "suspect_id" => $lastId,
                "state_id" => $a,
            ]);
            $res = DB::table('wanted_states')->insert($insert_states);
            }
        }

       if($res){
        Session::flash('success', 'Successfully Added Suspect');
            Session::flash('alert-class', 'alert-success');
       }else{
        Session::flash('errors', 'Unable to Insert');
        Session::flash('alert-class', 'alert-danger');
       }
       return $res;
    }
    public function updateSuspect($req){
        $id = $req->id;
        $all_state ='1';
        $image_name = null;
        if($req->all_state==null){
            $all_state = '0';
        }
        if($req->img!=null){
            $filePath = $req->file("img")->store("uploads/suspect",'public');
            $uploadedFile = $req->file("img");
            $image_name = $uploadedFile->hashName();
        }
        $update_suspect = [
            "fname" => $req->fname,
            "lname" => $req->lname,
            "age" => $req->age,
            "gender" => $req->gender,
            "dob" => $req->dob,
            "alert_mode" => $req->alert_mode,
            "alert_admin" => $req->alert_admin,
            "image_name" => $image_name ?? $req->old_img,
            "birth_mark" => $req->details,
            "aadhar_card" => $req->aadhar,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
            "all_states" => $all_state,
            "description" => $req->description,
        ];
        $lastId = DB::table('suspect')->where('id', $id)->update($update_suspect);
        DB::table('wanted_states')->where('suspect_id', $id)->delete();
        $res = false;
        if($all_state == '1'){
            $insert_states = array([
                "suspect_id" => $id,
                "state_id" => '0',
            ]);
            $res = DB::table('wanted_states')->insert($insert_states);
        }else{
            $values = $req->wanted_state;
            foreach ($values as $a){
            $insert_states = array([
                "suspect_id" => $id,
                "state_id" => $a,
            ]);
            $res = DB::table('wanted_states')->insert($insert_states);
            }
        }

       if($res){
        Session::flash('success', 'Successfully Updated Suspect');
            Session::flash('alert-class', 'alert-success');
       }else{
        Session::flash('errors', 'Unable to Update');
        Session::flash('alert-class', 'alert-danger');
       }
       return $res;
    }
    public function deleteSuspect($id){
        $res = DB::table('suspect')
              ->where('id', $id)
              ->update(['status' => '0']);
              if($res){
                Session::flash('success', 'Successfully Removed Suspect');
                    Session::flash('alert-class', 'alert-success');
               }else{
                Session::flash('errors', 'Unable to remove');
                Session::flash('alert-class', 'alert-danger');
               }
               return $res;
    }
    public function getNotification(){
        $role = session('role');
        $user_id = session('id');
        if($role == "admin"){
            $result = DB::table('notification')
        ->join('devices','notification.device_id','=','devices.id')
        ->join('airport','devices.airport_id','=','airport.id')
        ->join('cities', 'airport.city_id', '=', 'cities.id')
        ->join('states', 'airport.state_id', '=', 'states.id')
        ->join('suspect','notification.suspect_id','=','suspect.id')
        ->join('admin', 'suspect.created_by', '=', 'admin.id')
        ->select('notification.suspect_image_name','notification.date_time','devices.device_name','airport.airport_name','airport.contact_no','airport.address','suspect.id','suspect.fname','suspect.lname','cities.city','states.state','admin.first_name')
        ->where('suspect.alert_admin','all')
        ->orWhere('suspect.created_by',$user_id)
        ->orderBy('notification.id','DESC')
        ->get();
        }
        else{
            $result = DB::table('notification')
        ->join('devices','notification.device_id','=','devices.id')
        ->join('airport','devices.airport_id','=','airport.id')
        ->join('cities', 'airport.city_id', '=', 'cities.id')
        ->join('states', 'airport.state_id', '=', 'states.id')
        ->join('suspect','notification.suspect_id','=','suspect.id')
        ->join('admin', 'suspect.created_by', '=', 'admin.id')
        ->select('notification.suspect_image_name','notification.date_time','devices.device_name','airport.airport_name','airport.contact_no','airport.address','suspect.id','suspect.fname','suspect.lname','cities.city','states.state','admin.first_name')
        ->where('airport.id',$user_id)
        ->orderBy('notification.id','DESC')
        ->get();
        }
        return $result;
    }

}
