<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use DB;


class CourseController extends Controller
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
        $course  = DB::table('courses')
        ->join('departments', function ($join) {
            $join->on('departments.id', '=', 'courses.department_id');
        })
        ->select('*','courses.status AS c_s','courses.id AS c_id','courses.description AS c_d','departments.description AS d_d')
        ->get();
        $dept  = Department::all()->where('status', 1);
        
        return view('pages.course.index',compact('course','dept'));

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
        $member = new Course;
        $member->course = $request->input('course');
        $member->description = $request->input('description');
        $member->department_id = $request->input('department_id');
        $member->status = "1";
        $member->save();
        
        return redirect()->back()->with('success','Successfully add course!');
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
        $member = Course::find($id);
        $member->course = $request->input('course');
        $member->description = $request->input('description');
        $member->department_id = $request->input('department_id');
        // $member->status = "1";
        $member->save();
        return redirect()->back()->with('success','Successfully update course!');
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
        $status = $request->input('status');
        $st = "";
        $mess = "";
        if ($status == "0") {
            $st = "1";
            $mess = "activate";
        }else{
            $st = "0";
            $mess = "deactivate";
        }
        $member = Course::find($id);
        $member->status = $st;
        $member->save();

        return redirect()->back()->with('success','Successfully '. $mess.' course!');
    }
}
