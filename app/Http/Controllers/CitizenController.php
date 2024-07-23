<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\quarterfile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('select * from users');
        $regions = DB::select('select * from regions');
        $cities = DB::select('select * from districts');
        $quarters = DB::select('select * from quarters');
        $streets = DB::select('select * from streets');
        $quarterFiles = DB::select('select * from quarterfiles');
            // $datas = Excel::toArray(new UsersImport, $users[5]->file);

       return view('setting.citizenRegister',compact('users','regions','cities','quarters','streets','quarterFiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = '12345678';
        $citizen_id = array();
        $file_id = $request->file_id;
        $file = DB::select('select street_id,file from quarterfiles where id = '.$file_id);

        $street = DB::select('select * from streets where id = '.$file[0]->street_id);
        $quarter = DB::select('select * from quarters where id = '.$street[0]->quarter_id);
        $city = DB::select('select * from districts where id = '.$quarter[0]->district_id);
        $region = DB::select('select * from regions where id = '.$city[0]->region_id);
//   dd((int)$street[0]->id);
        $datas = Excel::toArray(new UsersImport, $file[0]->file);
        foreach($datas as $data){
//            dd(count($data));
            for ($i=7,$j=0; $i<count($data) ; $i++,$j++) {
//                dd($data[$i]);
//                foreach($data[$i] as $dt){
//                   if (!empty($dt)) {
//
                    $citizen_id[$j] = $region[0]->id.$city[0]->id.$quarter[0]->id.$street[0]->id.((string)$data[$i][1]);
//                   break;
//                   }
//                print_r($data[$i][4]);
                if (!empty($data[$i][1])){
                Citizen::create([
                    'street_id'=>$street[0]->id,
                    'home_number'=>(string)$data[$i][1],
                    'location'=>$data[$i][4],
                    'registered'=>null,
                    'login_id'=>$citizen_id[$j],
                    'password' => Hash::make($password),
                ]);
               DB::table('quarterfiles')->where('street_id',(int)$street[0]->id)->update(['confirmed' => true]);
                }
                }
            }
//        }
        // $citizen_id = (int)($region[0]->id.$city[0]->id.$quarter[0]->id.$street[0]->id);
//        dd($citizen_id);



//        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
