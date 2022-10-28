<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use DB;
class departmentController extends Controller
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
         $dept  = Department::all();
         // $d = 


                foreach ($dept as $key=>$value)
                {
                    $data[] = [
                        $value['id'],
                       
                    ];
                }

// DB::table('cashier')->insert($data);

         // $cour = Course::whereIn('department_id',$dept['id'])->get();
        // $d = "";
        //  foreach ($data as $key => $v) {
        //      // code...
        //     $d .=", ".$v['products_id']; 
        //  }

         // echo $d;

         $cour   = DB::table('courses')->whereIn('department_id',$data)->get();


         // echo json_encode($cour);
         return view('pages.department.index',compact('dept','cour') );
         
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
        $member = new Department;
        $member->department = $request->input('department');
        $member->description = $request->input('description');
        $member->status = "1";
      
        $member->save();

        return redirect()->back()->with('success','Successfully add department!');
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

        $member = Department::find($id);
        $member->department = $request->input('department');
        $member->description = $request->input('description');
      
        if ($member->save()) {
            return redirect()->back()->with('success','Successfully update department!');
        }else{
            return redirect()->back()->with('error','Error update department!');
        }

        
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
        $member = Department::find($id);
        $member->status = $st;
        $member->save();

        return redirect()->back()->with('success','Successfully '. $mess.' department!');
    }
}
