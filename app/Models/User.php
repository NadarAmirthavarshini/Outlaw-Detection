<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class User extends Model
{
    use HasFactory;

    public function auth($req){
        $user = DB::table('user')->where('username', $req->username)->where('password',$req->password)->where('status','1')->first();
        if($user->role == "admin"){
            session_start();
            $user_detail =  DB::table('admin')->where('user_id', $user->id)->first();
            session(['id' => $user_detail->id]);
            session(['firstname' => $user_detail->first_name]);
            session(['username' => $user_detail->email_id]);
            session(['role' => $user->role]);
            Session::flash('success', 'Successfully Logged In');
            Session::flash('alert-class', 'alert-success');
        }else if($user->role == "security_staff"){
            session_start();
            $user_detail =  DB::table('airport')->where('user_id', $user->id)->first();
            session(['id' => $user_detail->id]);
            session(['firstname' => $user_detail->airport_name]);
            session(['username' => $user_detail->email_id]);
            session(['role' => $user->role]);
            Session::flash('success', 'Successfully Logged In');
            Session::flash('alert-class', 'alert-success');
        }
        else{
        Session::flash('errors', 'Invalid User!');
        Session::flash('alert-class', 'alert-danger');
        }
        return $user;
    }

    public function getCity(){
        $cities =  DB::table('cities')->where('state_id',$_POST['iso2_val'])->get();
        return $cities;

    }
    public function getAdmins(){
        $result = DB::table('admin')
        ->join('cities', 'admin.city_id', '=', 'cities.id')
        ->join('states', 'admin.state_id', '=', 'states.id')
        ->select('admin.*','cities.city','states.state')
        ->where('admin.status','1')
        ->orderBy('admin.id')
        ->get();
        return $result;
    }
    public function getAdminById($id){
        $result = DB::table('admin')
        ->join('cities', 'admin.city_id', '=', 'cities.id')
        ->join('states', 'admin.state_id', '=', 'states.id')
        ->select('admin.*','cities.city','states.state')
        ->where('admin.id',$id)
        ->get();
        return $result;
    }
    public function storeAdmin($req){
        $date = date("Y-m-d H:i:s");
        $insert_user = [
            "username" => $req->email,
            "password" => $req->password,
            "role" => 'admin',
            "status" => '1'
        ];
        $lastId = DB::table('user')->insertGetId($insert_user);
        $insert_admin = [
            "user_id" => $lastId,
            "first_name" => $req->fname,
            "last_name" => $req->lname,
            "age" => $req->age,
            "gender" => $req->gender,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
            "country_id" =>1,
            "contact_no" => $req->contact,
            "email_id" => $req->email,
            "aadhar_card" => $req->aadhar,
            "status" => "1",
            "created_at" => $date,
            "created_by" => session('id'),
        ];
        $res = DB::table('admin')->insert($insert_admin);
        if($res){
            Session::flash('success', 'Successfully Added Admin');
                Session::flash('alert-class', 'alert-success');
           }else{
            Session::flash('errors', 'Unable to Insert');
            Session::flash('alert-class', 'alert-danger');
           }
           return $res;
    }
    public function updateAdmin($req){
        $update_admin = [
            "first_name" => $req->fname,
            "last_name" => $req->lname,
            "age" => $req->age,
            "gender" => $req->gender,
            "address" => $req->address,
            "state_id" => $req->state,
            "city_id" => $req->city,
            "contact_no" => $req->contact,
            "aadhar_card" => $req->aadhar,
        ];
        $res= DB::table('admin')->where('id', $req->id)->update($update_admin);
        if($res){
            Session::flash('success', 'Successfully Updates Admin');
                Session::flash('alert-class', 'alert-success');
           }else{
            Session::flash('errors', 'Unable to Update');
            Session::flash('alert-class', 'alert-danger');
           }
           return $res;

    }
    public function deleteAdmin($id){
        $res = DB::table('admin')
              ->where('user_id', $id)
              ->update(['status' => '0']);
        $res = DB::table('user')
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

}
