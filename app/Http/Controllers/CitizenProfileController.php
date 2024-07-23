<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitizenProfileController extends Controller
{
    public function index(){
        $login_id = Auth::user()->login_id;
        $citizen = DB::select('select * from citizens where login_id = '.$login_id);
        $street = DB::select('select * from streets where id = '.$citizen[0]->street_id);
        $quarter = DB::select('select * from quarters where id = '.$street[0]->quarter_id);
        $city = DB::select('select * from districts where id = '.$quarter[0]->district_id);
        $region = DB::select('select * from regions where id = '.$city[0]->region_id);
//        dd($region[0]->name);
        return view('citizen',compact('citizen','street','quarter','city','region'));
    }
    public function update(Request $request){
        $home_members = array();
         $home_members[0] = $request->house_owner;
          foreach ($request->registered as $key=>$registered_member){
              $home_members[$key+1] = $registered_member;
          }
//          dd($home_members);
        $registered = json_encode($home_members,JSON_HEX_TAG);
//        echo json_last_error_msg(); // Print out the error if any
//        die(); // halt the script
//        dd($registered);
        $login_id = Auth::user()->login_id;
        $citizen = DB::select('select * from citizens where login_id = '.$login_id);
        $updating = Citizen::where('login_id',$login_id)->update(['registered'=>$registered]);
//        $updating = DB::update('update citizens set registered = '.$registered.' where login_id = '.$login_id);
      if ($updating){
          return redirect()->route('citizen-profile-logged');
      }
      else{
          return error_log('fail');
      }
    }
}
