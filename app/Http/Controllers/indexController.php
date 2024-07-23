<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = json_encode(DB::select('select * from regions'),JSON_HEX_QUOT);
        return view('indexs',compact('regions'));
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
    public function houseData(Request $request){
        $streetId = $request->street_id;
        $house = json_encode(DB::select('select * from citizens where street_id ='.$streetId),JSON_HEX_QUOT);
        return $house;
    }
    public function locationData(Request $request){
        $home_number = $request->home_number;
        $house = json_encode(DB::select('select location from citizens where home_number ='.$home_number),JSON_HEX_QUOT);
        return $house;
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
