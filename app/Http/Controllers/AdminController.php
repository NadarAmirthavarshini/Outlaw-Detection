<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function allAdmin(){
        $admin = new User;
           $result = $admin->getAdmins();
        return view('admin/all-admin')->with('result',$result);
        }
    public function addAdmin()
    {
        return view('admin/add-admin');
    }
    public function storeAdmin(Request $req)
    {
       $admin = new User;
       $res = $admin->storeAdmin($req);
       return redirect('all-suspect');
    }
    public function editAdmin($id)
    {
        $admin = new User;
        $result['admin'] = $admin->getAdminById($id);
        return view('admin/edit-admin')->with($result);
    }
    public function updateAdmin(Request $req)
    {
        $admin = new User;
       $res = $admin->updateAdmin($req);
       return redirect('all-admin');
    }
    public function deleteAdmin($id)
    {
        $admin = new User;
       $res = $admin->deleteAdmin($id);
       return redirect('all-admin');
    }
}
