<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Suspect;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    //

    public function allSuspect(){
        $suspect = new Suspect;
        $result = $suspect->getSuspects();
        // $result['states'] = $suspect->getSuspectWantedStates();
        // dd($result);
        return view('suspect/all-suspect')->with('result',$result);
    }
    public function addSuspect()
    {
        return view('suspect/add-suspect');
    }

    public function viewSuspect($id)
    {
        $suspect = new Suspect;
        $result['suspect'] = $suspect->getSuspectsById($id);
        $result['states'] = $suspect->getSuspectWantedStatesById($id);
        // dd($result);
        return view('suspect/view-suspect')->with($result);
    }
    public function editSuspect($id)
    {
        $suspect = new Suspect;
        $result['suspect'] = $suspect->getSuspectsById($id);
        // $result['states'] = $suspect->getSuspectWantedStatesById($id);
        // dd($result);
        return view('suspect/edit-suspect')->with($result);
    }
    public function deleteSuspect($id)
    {
       $suspect = new Suspect;
       $res = $suspect->deleteSuspect($id);
       return redirect('all-suspect');
    }
    public function getCity(){
        // dd("ok");
        $user = new User;
        return $user->getCity();

    }
    public function storeSuspect(Request $req)
    {
       $suspect = new Suspect;
       $res = $suspect->storeSuspect($req);
       return redirect('all-suspect');
        // dd($req);
    }
    public function updateSuspect(Request $req)
    {
       $suspect = new Suspect;
       $res = $suspect->updateSuspect($req);
       return redirect('all-suspect');
        // dd($req);
    }

    public function notification(){
        $suspect = new Suspect;
        $result = $suspect->getnotification();
        // $result['states'] = $suspect->getSuspectWantedStates();
        // dd($result);
        return view('notification/notification')->with('result',$result);
    }
    public function getNotification(){
        $suspect = new Suspect;
        $result = $suspect->getnotification();
        // $result['states'] = $suspect->getSuspectWantedStates();
        // dd($result);
        return $result;
    }
}
