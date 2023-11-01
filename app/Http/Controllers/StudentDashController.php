<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SignatoryAssign;
use App\Models\Clearance_log;
use App\Models\Assignee;
use App\Models\User_Info;
use DB;
use Session;



class StudentDashController extends Controller
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

        $sig = SignatoryAssign::all();
        return view('pages.student_dash.index',compact('sig'));
        //  $g_id = Session::get('sc_id');
        // $sem = Session::get('semester');

       

        // $stu12 =  DB::table('clearance_logs')
        // ->where('clearance_status',22)
        // ->where('school_year',$g_id)
        // ->where('sem',$sem)
        // ->groupBy('student_id')
        // ->get();

        // $arr = array();

        // $arr1 = array();

        // $sch_arr = array();
        // $sem_arr = array();


        // foreach ($stu12 as $key1 ) {
         
        //     $arr[] =  $key1->student_id;
        //     $arr1[] =  $key1->clearance_status;
        //     $sch_arr[] =  $key1->school_year;
        //     $sem_arr[] =  $key1->sem;

        // }
        

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

     public static function get($id,$ass_id){
        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');
        $sign = Clearance_log::where('clearance_logs.student_id',$id)
        ->where('assignees.signature_assign',$ass_id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('assignees', 'assignees.user_id', '=', 'clearance_logs.clearance_status')
        ->join('users', 'users.id', '=', 'clearance_logs.clearance_status')
        ->select('users.profile_image AS H','users.name AS fullname','assignees.siganture_photo AS sp','clearance_logs.id AS g','clearance_logs.clearance_status AS cc')
        ->first();
      
        return $sign;
    }

     public static function getAssByID($id,$ass_id){
        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');
        $sign = Clearance_log::where('clearance_logs.student_id',$id)
        ->where('assignees.signature_assign',$ass_id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('assignees', 'assignees.user_id', '=', 'clearance_logs.assignee_id')
        ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
        ->select('users.profile_image AS H','users.name AS fullname','clearance_logs.id as cid')
        ->first();
      
        return $sign;
    }


    public static function getAssBySig($id,$ass_id){
        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');
        $sign = Clearance_log::where('clearance_logs.student_id',$id)
        ->where('assignees.signature_assign',$ass_id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('assignees', 'assignees.user_id', '=', 'clearance_logs.assignee_id')
        ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
        ->select('users.profile_image AS H','users.name AS fullname','assignees.siganture_photo AS sp','users.id AS g')
        ->first();
      
        return $sign;
    }

    public function getAss($ass_id)
    {

            $ass = DB::table('assignees')
            ->where('signature_assign',$ass_id)
            ->first();

            if (isset($ass) && is_object($ass) && property_exists($ass, 'department_id')) {
                $student_exist = DB::table('students')
                    ->join('courses', 'courses.id', '=', 'students.course_id')
                    ->where('courses.department_id', $ass->department_id)
                    ->exists();

                    if ($student_exist) {

                        $s = DB::table('students')
                       ->join('courses','courses.id','=','students.course_id')
                       ->where('students.user_id',Auth::user()->id)
                       ->first();
                       
       
                       $student_exist1 =Assignee::join('departments','departments.id','=','assignees.department_id')
                       ->join('users', 'users.id', '=', 'assignees.user_id')
                       ->where('departments.id', $s->department_id)
                       ->select('users.profile_image AS H','users.name AS fullname')
                       ->first();
       
                       return $student_exist1;
       
                   }else{
       
                       $sign = Assignee::where('assignees.signature_assign',$ass_id)
                       ->join('users', 'users.id', '=', 'assignees.user_id')
                       ->select('users.profile_image AS H','users.name AS fullname')
                       ->first();
       
                       return $sign;
       
                   }
                
            }

           
    }

    public function get_info()
    {
         $user = User_Info::where('users.id',Auth::user()->id)
         ->join('students','students.user_id','=','user__infos.user_id')
         ->join('users', 'users.id', '=', 'user__infos.user_id')
         ->join('courses','courses.id','=','students.course_id')
         ->join('clearance_logs','clearance_logs.student_id','=','user__infos.user_id')
         ->select('*','students.student_id AS st')
         ->first();
      
        return $user;
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
