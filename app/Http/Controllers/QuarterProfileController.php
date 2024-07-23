<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuarterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $users = DB::select('select * from users where id = '.$user_id);
        $regions = DB::select('select * from regions');
        $cities = DB::select('select * from districts');
        $quarters = DB::select('select * from quarters where quarters.id = '.$users[0]->quarter_id);
        $streets = DB::select('select * from streets where streets.quarter_id = '.$users[0]->quarter_id);
        dd($streets);
        $quarterFiles = DB::select('select * from quarterfiles ');
        // $datas = Excel::toArray(new UsersImport, $users[5]->file);

        return view('citizens_info_for_user',compact('users','regions','cities','quarters','streets','quarterFiles'));

    }
    public function citizenInfo($id){
        $citizens = DB::select('select * from citizens where street_id = '.$id);
        return view('quarter_profile',compact('citizens'));
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
