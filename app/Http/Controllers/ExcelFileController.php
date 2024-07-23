<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('welcome');
    }

    public function importFiles(Request $request,$id){
//        $file = $request->file('excelFile');
        $user_file = DB::select('select file from quarterfiles where id= '.$id);
        $user = Auth::user()->file;
        $files = Storage::allFiles('/public');
//        dd((string)$user_file[0]->file);
        $file = Storage::disk('public')->url($user_file[0]->file);
//        dd($file);
        $datas = Excel::toArray(new UsersImport, $user_file[0]->file);
        return view('welcome')->with('datas',$datas);
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
        // $file = $request->file('excelFile')->getClientOriginalName();

        // $request->validate([
        //     'excelFile'=>['required','mimes:xls', 'mimes:xlm', 'mimes:xla', 'mimes:xlc', 'mimes:xlt', 'mimes:xlw','mimes:xltm','mimes:xlsm','mimes:xlsb','mimes:xlam']
        // ]);

        if ($request->hasFile('excelFile')) {
            $file = $request->file('excelFile');
            // $file = $request->file('excelFile')->getClientOriginalName();
            // // dd($file);
            // $filename = pathinfo($file, PATHINFO_FILENAME);
            // $extension = $request->file('excelFile')->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.date('Y-m-d H:i:s').'.'.$extension;

            // $path = Storage::disk('local')->put('/files',$fileNameToStore);
            // dd($path);
            // dd(Excel::load($file, function($reader) {

            // })->get());
            // return view('welcome',compact($excelData));

            return view('welcome')->with('datas',import($file));
        }


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
