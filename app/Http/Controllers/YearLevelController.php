<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearLevel;

class YearLevelController extends Controller
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
        $YearLevel = YearLevel::all();

        return view('pages.year_level.index',compact('YearLevel'));
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
        $member = new YearLevel;
        $member->year_level = $request->input('year_level');
        $member->status = $request->input('status');
      
        $member->save();

        return redirect()->back()->with('success','Successfully add year level!');
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

        $member = YearLevel::find($id);
         $member->year_level = $request->input('year_level');
        $member->status = $request->input('status');
      
        $member->save();

        return redirect()->back()->with('success','Successfully year level!');
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

        $member = YearLevel::find($id);
        $member->delete();

        return redirect()->back()->with('success','Successfully year level!');
    }
}
