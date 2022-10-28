<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolYear;
use DB;
use Session;

class SchoolYearController extends Controller
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
       $SchoolYear = SchoolYear::all();
       $SchoolYear1 = DB::table('school_years')->where('status', '1')->first();
       // Session::put('school_year', $SchoolYear1->school_year);
       // Session::put('semester', $SchoolYear1->semester);

       return view('pages.school_year.index',compact('SchoolYear','SchoolYear1'));
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
        $member = new SchoolYear;
        $member->school_year = $request->input('school_year');
        $member->status = '0';
      
        $member->save();

        return redirect()->back()->with('success','Successfully add school year!');
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
    public function update(Request $request)
    {
        

        $id = $request->input('id');

        $member = SchoolYear::find($id);
        $member->school_year = $request->input('school_year');
        $member->semester = $request->input('semester');
        $member->status = $request->input('status');

        if ($request->input('status') == '1') {

            
            // $sy = SchoolYear::where('status', '1')->first();

            
            // if ($sy) {
                
            //     $sy1 = SchoolYear::find($sy->id);
            //     $sy1->status = '0';
            //     $sy1->save();
            // }

            Session::put('sc_id', $id);
            Session::put('school_year', $request->input('school_year'));
            Session::put('semester', $request->input('semester'));


        }else{

            Session::put('sc_id', '');
            Session::put('school_year', '');
            Session::put('semester', '');
        }

        $member->save();

        return redirect()->back()->with('success','Successfully update school year!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $member = SchoolYear::find($id);
        $member->delete();

        return redirect()->back()->with('success','Successfully delete school level!');
    }
}
