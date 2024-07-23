<?php

namespace App\Http\Controllers;

use App\Models\quarterfile;
use App\Models\street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class QuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // private $regionData;
    // public function __construct(QuarterController $quarter) {
    //     $this->regionData = $quarter;
    // }


    public function index()
    {
        $regions = DB::table('regions')->get()->toArray();
        $city = json_encode(DB::table('quarters')->get()->toArray(),JSON_HEX_QUOT);
        return view('setting.registerMain',compact('regions'));
    }
    public function cityData(Request $request){
      $regionId = $request->region_id;
      $city = json_encode(DB::select('select * from districts where region_id ='.$regionId),JSON_HEX_QUOT);
      return $city;
    }
    public function quarterData(Request $request){
        $districtId = $request->district_id;
        $quarter = json_encode(DB::select('select * from quarters where district_id ='.$districtId),JSON_HEX_QUOT);
        return $quarter;
      }
      public function streetData(Request $request){
        $quarterId = $request->quarter_id;
        $street = json_encode(DB::select('select * from streets where quarter_id ='.$quarterId),JSON_HEX_QUOT);
        return $street;
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!empty($request->file)) {

            $file = $request->file->getClientOriginalName();

//            $filename = pathinfo($file, PATHINFO_FILENAME);
//            $extension = $data['file']->getClientOriginalExtension();
//            $fileNameToStore = $filename . '_' . date('Y-m-d H:i:s') . '.' . $extension;
////            $content = file_get_contents($file);
            Storage::disk('public')->putFileAs('files',$request->file,$file);


        }
        if (!empty($request->street_input)){
            $street = street::create([
                'quarter_id'=>(int)$request->quarter,
                'name'=>$request->street_input,
            ]);

        }
        $lastInsertedId = $street->id;
            if ((int)$request->street != 0){
                if(!(User::where('name', '=',$request->username))){
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'file' => 'public/files/'.$file,
            'password' => Hash::make($request->password),
            'region_id' => (int)$request->region,
            'district_id' =>(int)$request->city,
            'quarter_id' => (int)$request->quarter,
            'street_id' => (int)$request->street,
        ]);
            }

        quarterfile::create([
            'street_id'=>(int)$request->street,
            'file'=>'public/files/'.$file,
        ]);
            }
            else{
                if(!(User::where('name', '=',$request->username))) {
                    User::create([
                        'name' => $request->username,
                        'email' => $request->email,
                        'file' => 'public/files/' . $file,
                        'password' => Hash::make($request->password),
                        'region_id' => (int)$request->region,
                        'district_id' => (int)$request->city,
                        'quarter_id' => (int)$request->quarter,
                        'street_id' => $lastInsertedId,
                    ]);
                }

                quarterfile::create([
                    'street_id'=>$lastInsertedId,
                    'file'=>'public/files/'.$file,
                ]);
            }


        return redirect()->route('add-quarter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
