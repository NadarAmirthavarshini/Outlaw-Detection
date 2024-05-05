<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Storage;

class Airport extends Model
{
    use HasFactory;
    public function storeAirport($req){
        $insert_user = [
            "username" => $req->email,
            "password" => $req->password,
            "role" => 'security_staff',
            "status" => '1'
        ];
        $lastId = DB::table('user')->insertGetId($insert_user);
        $insert_airport = [
            "user_id" => $lastId,
            "airport_name" => $req->name,
            "contact_no" => $req->contact,
            "email_id" => $req->email,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
            "status" => '1',
        ];
        $res = DB::table('airport')->insert($insert_airport);
        if($res){
            Session::flash('success', 'Successfully Added Airport');
                Session::flash('alert-class', 'alert-success');
           }else{
            Session::flash('errors', 'Unable to Insert');
            Session::flash('alert-class', 'alert-danger');
           }
           return $res;
    }
    public function getAirports(){
        $result = DB::table('airport')
        ->join('cities', 'airport.city_id', '=', 'cities.id')
        ->join('states', 'airport.state_id', '=', 'states.id')
        ->select('airport.*','cities.city','states.state')
        ->orderBy('airport.id')
        ->get();
        return $result;
    }
    public function statusAirport($id){
        $result = DB::table('airport')
        ->where('user_id',$id)
        ->first();
        $status = "1";
        if($result->status =="1"){
            $status ="0";
        }
        $res = DB::table('airport')
              ->where('user_id', $id)
              ->update(['status' => $status]);
        $res = DB::table('user')
              ->where('id', $id)
              ->update(['status' => $status]);
        if($res){
                Session::flash('success', 'Successful');
                    Session::flash('alert-class', 'alert-success');
               }else{
                Session::flash('errors', 'Unable to remove');
                Session::flash('alert-class', 'alert-danger');
               }
               return $res;
    }
    public function getAirportById($id){
        $result = DB::table('airport')
        ->join('cities', 'airport.city_id', '=', 'cities.id')
        ->join('states', 'airport.state_id', '=', 'states.id')
        ->select('airport.*','cities.city','states.state')
        ->where('airport.id',$id)
        ->get();
        return $result;
    }
    public function updateAirport($req){
        $update_airport = [
            "airport_name" => $req->name,
            "contact_no" => $req->contact,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
        ];
        $res= DB::table('airport')->where('id', $req->id)->update($update_airport);
        if($res){
            Session::flash('success', 'Successfully Updates Airport');
            Session::flash('alert-class', 'alert-success');
           }else{
            Session::flash('errors', 'Unable to Update');
            Session::flash('alert-class', 'alert-danger');
           }
           return $res;

    }
    public function storeDevice($req){
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        Storage::put('file.txt',$token);

        $insert_device = [
            "airport_id" => $req->airport,
            "device_name" => $req->name,
            "token" => $token,
            "status" => '1',
        ];
        $res = DB::table('devices')->insert($insert_device);
        if($res){
            Session::flash('success', 'Successfully Added Device');
                Session::flash('alert-class', 'alert-success');
           }else{
            Session::flash('errors', 'Unable to Insert');
            Session::flash('alert-class', 'alert-danger');
           }
           return $res;
    }
    public function getDevice(){
        $result = DB::table('devices')
        ->join('airport', 'devices.airport_id', '=', 'airport.id')
        ->join('cities', 'airport.city_id', '=', 'cities.id')
        ->join('states', 'airport.state_id', '=', 'states.id')
        ->select('devices.device_name','devices.id','devices.status','airport.airport_name','airport.contact_no','airport.address','cities.city','states.state')
        ->orderBy('devices.id')
        ->get();
        return $result;
    }
    public function statusDevice($id){
        $result = DB::table('devices')
        ->where('id',$id)
        ->first();
        $status = "1";
        if($result->status =="1"){
            $status ="0";
        }
        $res = DB::table('devices')
        ->where('id',$id)
              ->update(['status' => $status]);
        if($res){
                Session::flash('success', 'Successful');
                    Session::flash('alert-class', 'alert-success');
               }else{
                Session::flash('errors', 'Unable to remove');
                Session::flash('alert-class', 'alert-danger');
               }
               return $res;
    }

}
