<?php

namespace App\Http\Controllers;
use App\Models\Airport;


use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function allAirport(){
        $airport = new Airport;
           $result = $airport->getAirports();
        return view('airport/all-airport')->with('result',$result);
        }
    public function addAirport()
    {
        return view('airport/add-airport');
    }
    public function storeAirport(Request $req)
    {
       $airport = new Airport;
       $res = $airport->storeAirport($req);
       return redirect('all-airport');
    }
    public function editAirport($id)
    {
        $airport = new Airport;
        $result['airport'] = $airport->getAirportById($id);
        return view('airport/edit-airport')->with($result);
    }
    public function updateAirport(Request $req)
    {
        $airport = new Airport;
       $res = $airport->updateAirport($req);
       return redirect('all-airport');
    }
    public function statusAirport($id)
    {
        $airport = new Airport;
       $res = $airport->statusAirport($id);
       return redirect('all-airport');
    }
    public function allDevice(){
        $airport = new Airport;
           $result = $airport->getDevice();
        return view('airport/all-device')->with('result',$result);
        }
    public function addDevice()
    {
        return view('airport/add-device');
    }
    public function storeDevice(Request $req)
    {
        // dd("okkkk");
       $airport = new Airport;
       $res = $airport->storeDevice($req);
       return redirect('all-device');
    }
    public function statusDevice($id)
    {
        $airport = new Airport;
       $res = $airport->statusDevice($id);
       return redirect('all-device');
    }
}
