<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefix;
use App\Models\Suffix;

class Prefix_SuffixController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $prefix =  Prefix::all();
       $suffix =  Suffix::all();
       return view('pages.prefix_suffix.index',compact('prefix','suffix'));
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
    public function store_prefix(Request $request)
    {
        $member = new Prefix;
        $member->prefix = $request->input('prefix');
        $member->description = $request->input('description');
        $member->save();

        return redirect()->back()->with('success','Successfully add prefix!');
    }

    public function store_suffix(Request $request)
    {
        $member = new Suffix;
        $member->suffix = $request->input('suffix');
        $member->description = $request->input('description');
        $member->save();

        return redirect()->back()->with('success','Successfully add suffix!');
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
    public function update_prefix(Request $request)
    {
        $id = $request->input('id');

        $member = Prefix::find($id);
        $member->prefix = $request->input('prefix');
        $member->description = $request->input('description');
        $member->save();

        return redirect()->back()->with('success','Successfully update prefix!');
    }

    public function update_suffix(Request $request)
    {
        $id = $request->input('id');
        $member = Suffix::find($id);
        $member->suffix = $request->input('suffix');
        $member->description = $request->input('description');
        $member->save();

        return redirect()->back()->with('success','Successfully update suffix!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_prefix(Request $request)
    {
        $id = $request->input('id');

        $member = Prefix::find($id);
        $member->delete();

        return redirect()->back()->with('success','Successfully delete prefix!');
    }
    public function destroy_suffix(Request $request)
    {
        $id = $request->input('id');
        $member = Suffix::find($id);
        $member->delete();

        return redirect()->back()->with('success','Successfully delete suffix!');
    }
}
