<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clearance;
use App\Models\Clearance_log;
use App\Models\Assignee;
use App\Models\User;
use App\Models\Department;
use App\Models\User_info;
use App\Models\Position;
use App\Models\Prefix;
use App\Models\Suffix;
use App\Models\SignatoryAssign;
use App\Models\YearLevel;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class ClearanceController extends Controller
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

        // $g_id = Session::get('sc_id');

        //     $students = Student::all();
           
        //     // $string='';

        //     foreach ($students as $key=>$value)
        //     {

        //         $data[]= ['student_id' => $value['user_id'],];
        //         $rt[] = [$value['user_id'],];
        //         $string[]= $value['user_id'];
        //         // Clearance_log::create([
        //         //     'student_id' => $value['user_id'],
        //         // ]);
        //     }

        //     // $user = User::where('student_id', $request->email)->get();

        //     $ret = Clearance_log::whereIn('student_id', $rt)->get();

        //     foreach ($ret as $key => $value) {
        //         // code...
               

        //          $string1[]=  $value['student_id'];


        //          // $string .= $rt.',';
        //     }

        //     // echo $string;
        //     for ($i=0; $i < count($string); $i++) { 

        //          echo $string[$i] .'=='. $string1[$i];
                     
                
        //     }
           
            
        $sign_count1 = Clearance_log::where('clearance_status',Auth::user()->id)->count();
        $sign_count2 = Clearance_log::where('assignee_id',Auth::user()->id)->count();
     


        

        
        
            // $data = [];
            // foreach ($cl as $key=>$value)
            // {
            //     $data[] = [
            //         $value['user_id'],
                   
            //     ];

            //     // $stu_id[] = [$value['student_id'],];
            // }

            // $count = Clearance_log::whereIn('id',$data);

            // $sign   = DB::table('clearance_logs')->whereIn('assignee_id',$data)->get();

        // $clearance_log = Clearance_log::where();

            // echo json_encode($cl);

        // foreach($sign as $s){

        //   if($s->clearance_status == 1)


        //    echo $s->name;

        //   }

        // $ass1 = DB::table('assignees')
        // ->where('user_id',Auth::user()->id)
        // ->first();

        // $student_exist1 = DB::table('students')
        // ->join('courses','courses.id','=','students.course_id')
        // ->where('courses.department_id',$ass->department_id)
        // ->exists();

        // if ($student_exist1) {
        //     // code...
        // }

        // $stu12 =  DB::table('clearance_logs')
        // ->groupBy('student_id')
        // ->get();

        // $arr = array();

        // foreach ($stu12 as $key1 ) {
         
        //     $arr[] =  $key1->student_id;

        // }

        // $stu1 =  DB::table('students')
        // ->whereNotIn('user_id',$arr)
        // ->get();

        // foreach ($stu1 as $key) {

        //     echo $key->user_id;

        // }


        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');

       

        $stu12 =  DB::table('clearance_logs')
        ->where('clearance_status',Auth::user()->id)
        ->where('school_year',$g_id)
        ->where('sem',$sem)
        ->groupBy('student_id')
        ->get();

        $arr = array();

        $arr1 = array();

        $sch_arr = array();
        $sem_arr = array();


        foreach ($stu12 as $key1 ) {
         
            $arr[] =  $key1->student_id;
            $arr1[] =  $key1->clearance_status;
            $sch_arr[] =  $key1->school_year;
            $sem_arr[] =  $key1->sem;

        }
       // echo json_encode($sem_arr);


        $st = DB::table('clearance_logs')

        ->whereIn('clearance_status',$arr1)
        ->whereIn('student_id',$arr)
        ->whereIn('school_year',$sch_arr)
        ->whereIn('sem',$sem_arr)
        ->groupBy('student_id')
        ->first();

        

        if ($st) {

            $ass = DB::table('assignees')
            ->where('user_id',Auth::user()->id)
            ->first();

            $student_exist = DB::table('students')
            ->join('courses','courses.id','=','students.course_id')
            ->where('courses.department_id',$ass->department_id)
            ->exists();

            if ($student_exist) {

                $stu1 = DB::table('students')
                ->join('courses','courses.id','=','students.course_id')
                ->where('courses.department_id',$ass->department_id)
                ->whereNotIn('user_id',$arr)
                ->get();

                

                foreach ($stu1 as $key) {

                    Clearance_log::create([
                        'student_id' => $key->user_id,
                        'school_year'=> $g_id,
                        'sem'=> $sem,
                        'clearance_status' => Auth::user()->id,
                        
                    ]);

                    // echo $key->user_id;

                }

            }else{

                $stu1 = DB::table('students')
                ->whereNotIn('user_id',$arr)
                ->get();

                foreach ($stu1 as $key) {

                    Clearance_log::create([
                        'student_id' => $key->user_id,
                        'school_year'=> $g_id,
                        'sem'=> $sem,
                        'clearance_status' => Auth::user()->id,
                    ]);

                }

            }
 

        }else{

            $ass = DB::table('assignees')
            ->where('user_id',Auth::user()->id)
            ->first();

            $student_exist = DB::table('students')
            ->join('courses','courses.id','=','students.course_id')
            ->where('courses.department_id',$ass->department_id)
            ->exists();

            if ($student_exist) {

                $stu1 = DB::table('students')
                ->join('courses','courses.id','=','students.course_id')
                ->where('courses.department_id',$ass->department_id)
                ->whereNotIn('user_id',$arr)
                ->get();


                foreach ($stu1 as $key) {

                    Clearance_log::create([
                        'student_id' => $key->user_id,
                        'school_year'=> $g_id,
                        'sem'=> $sem,
                        'clearance_status' => Auth::user()->id,
                    ]);

                }

            }else{

                $stu1 = DB::table('students')
                ->whereNotIn('user_id',$arr)
                ->get();

                foreach ($stu1 as $key) {

                    Clearance_log::create([
                        'student_id' => $key->user_id,
                        'school_year'=> $g_id,
                        'sem'=> $sem,
                        'clearance_status' => Auth::user()->id,
                    ]);

                }

            }
        }

        $st30 = DB::table('clearance_logs')
        ->whereIn('school_year',$sch_arr)
        ->whereIn('sem',$sem_arr)
        ->groupBy('student_id')
        ->get();
       
        $tr = DB::table('clearance_logs')->latest('control_number')->first();

        $int = (int)$tr->control_number;

        $t = $int + 1;

        $stu_id ='';
        $con_ = "";

        for ($i=0; $i < count($st30); $i++) { 

            
            if ($tr->control_number == "") {
                
                if (strlen($t) == 1) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '0000'.$t.' ';
                }elseif (strlen($t) == 2) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '000'.$t.' ';
                }elseif (strlen($t) == 3) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '00'.$t.' ';
                }elseif (strlen($t) == 4) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '0'.$t.' ';
                }else{
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= $t.' ';
                }


            }else{

                if (strlen($t) == 1) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '0000'.$t.' ';
                }elseif (strlen($t) == 2) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '000'.$t.' ';
                }elseif (strlen($t) == 3) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '00'.$t.' ';
                }elseif (strlen($t) == 4) {
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= '0'.$t.' ';
                }else{
                    $stu_id .= $st30[$i]->student_id.' ';
                    $con_ .= $t.' ';
                }
            }

            $t++;


        }

        // echo json_encode(explode(" ",$stu_id));
        // echo '<br>';
        // echo json_encode(explode(" ",$con_));

        $st31 = DB::table('clearance_logs')
        ->whereIn('control_number',explode(" ",$con_))
        ->whereIn('student_id',explode(" ",$stu_id))
        ->whereIn('school_year',$sch_arr)
        ->whereIn('sem',$sem_arr)
        ->groupBy('student_id')
        ->get();

        $tr1 = DB::table('clearance_logs')->latest('control_number')->first();

        $int1 = (int)$tr->control_number;

        $t1 = $int1 + 1;

        for ($i=0; $i < count($st31); $i++) { 

           // echo $st31[$i]->student_id;
            if ($tr1->control_number == "") {
                if (strlen($t1) == 1) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','0000'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '0000'.$t1]);
                    }

                }elseif (strlen($t1) == 2) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','000'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '000'.$t1]);
                    }
                    // echo '000'.$t1 .'-->'.$st31[$i]->student_id;
                }elseif (strlen($t1) == 3) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','00'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '00'.$t1]);
                    }
                }elseif (strlen($t1) == 4) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','0'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '0'.$t1]);
                    }
                }else{
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number',$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $t1]);
                    }
                }

            }else{
                 if (strlen($t1) == 1) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','0000'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '0000'.$t1]);
                    }
                   
                }elseif (strlen($t1) == 2) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','000'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '000'.$t1]);
                    }
                    // echo '000'.$t1 .'-->'.$st31[$i]->student_id;
                }elseif (strlen($t1) == 3) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','00'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '00'.$t1]);
                    }
                }elseif (strlen($t1) == 4) {
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number','0'.$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> '0'.$t1]);
                    }
                }else{
                    $ex = Clearance_log::where('student_id',$st31[$i]->student_id)
                    ->where('school_year',$g_id)
                    ->where('sem',$sem)
                    ->where('control_number',$int1)
                    ->first();

                    if ($ex) {
                         Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $ex->control_number]);
                    }else{
                        Clearance_log::where('student_id',$st31[$i]->student_id)
                        ->where('school_year',$g_id)
                        ->where('sem',$sem)
                        ->update(['control_number'=> $t1]);
                    }
                }
            }
         $t1++;
        }


        if(AccessRightsController::access_roole(Auth::user()->id,'1')->sig == '0'){
            include '404.php';
        }else{
            return view('pages.clearance.index',compact('sign_count1','sign_count2'));
        }

       
    }


    public static function getUserByID($id){
        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');

        $sign = Clearance_log::where('clearance_logs.student_id',$id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
        ->select('users.profile_image AS H','users.name AS fullname','clearance_logs.id as cid')
        ->get();
      
        return $sign;
    }

   

    public static function get_assignee($id,$student_id){
          $g_id = Session::get('sc_id');
         $sem = Session::get('semester');
        $sign = Clearance_log::where('clearance_status',$id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->where('student_id',$student_id)
        ->select('*','clearance_logs.id AS cid')
        ->first();

        return $sign;
    }

    public static function getsignatory($id){
         $g_id = Session::get('sc_id');
         $sem = Session::get('semester');
        $sign = Clearance_log::where('clearance_logs.student_id',$id)
         ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
        ->join('assignees', 'assignees.user_id', '=', 'clearance_logs.assignee_id')
        ->join('signatory_assigns', 'assignees.signature_assign', '=', 'signatory_assigns.id')
        ->select('users.profile_image AS H','users.name AS fullname','signatory_assigns.name AS nm')
        ->get();

        return $sign;
    }

    public static function getDept(){
        $dp = Assignee::where('user_id',Auth::user()->id)
        ->join('departments','departments.id','=','assignees.department_id')
        ->select('departments.id AS d')
        ->first();

        return $dp->d; 
    }

    public static function getDept_student($stu){

        $dp = Student::where('user_id',$stu)
        ->join('courses','courses.id','=','students.course_id')
        ->join('departments','departments.id','=','courses.department_id')
        ->select('departments.id AS d')
        ->first();

        return $dp->d; 
    }

    public function student_clearance()
    {
         

         $g_id = Session::get('sc_id');
         $sem = Session::get('semester');


        $dp = Assignee::where('user_id',Auth::user()->id)
        ->join('departments','departments.id','=','assignees.department_id')
        ->select('departments.id AS d')
        ->first();
        

         $dp1 = DB::table('users')
        ->join('clearance_logs', 'users.id', '=', 'clearance_logs.student_id')
        ->join('user__infos', 'users.id', '=', 'user__infos.user_id')
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('courses', 'students.course_id', '=', 'courses.id')
        ->join('year_levels', 'year_levels.id', '=', 'students.year_level_id')
        ->where('courses.department_id',$dp->d)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->select('*','clearance_logs.id AS c_id','users.name AS fullname','users.id AS D','students.status AS st','clearance_logs.student_id as ct','clearance_logs.assignee_id as e')
        ->groupBy('d')
        ->havingRaw('COUNT(*)  > 0')
        ->get();

        $dp2 = DB::table('users')
        ->join('clearance_logs', 'users.id', '=', 'clearance_logs.student_id')
        ->join('user__infos', 'users.id', '=', 'user__infos.user_id')
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('courses', 'students.course_id', '=', 'courses.id')
        ->join('year_levels', 'year_levels.id', '=', 'students.year_level_id')
        ->where('courses.department_id',$dp->d)
        ->select('*','clearance_logs.id AS c_id','users.name AS fullname','users.id AS D','students.status AS st','clearance_logs.student_id as ct','clearance_logs.assignee_id as e')
        ->groupBy('d')
        ->havingRaw('COUNT(*)  > 0')
        ->exists();

        $students2 = DB::table('users')
        ->join('clearance_logs', 'users.id', '=', 'clearance_logs.student_id')
        ->join('user__infos', 'users.id', '=', 'user__infos.user_id')
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('courses', 'students.course_id', '=', 'courses.id')
        ->join('year_levels', 'year_levels.id', '=', 'students.year_level_id')
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->select('*','clearance_logs.id AS c_id','users.name AS fullname','users.id AS D','students.status AS st','clearance_logs.student_id as ct','clearance_logs.assignee_id as e')
        ->groupBy('d')
        ->havingRaw('COUNT(*)  > 0')
        ->get();

        if ($dp2) {
            return $dp1; 
        }else {
            return $students2;
        }
        
        

        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

        $clearance = Clearance_log::findOrFail($id);

        $student_id = $clearance->student_id;

        if ($clearance->assignee_id == NULL) {

             $clearance->assignee_id = Auth::user()->id;

        }else{

            $clearance->assignee_id = NULL;
        }
       
        $clearance->update();

        $g_id = Session::get('sc_id');
        $sem = Session::get('semester');

        $sign = Clearance_log::where('clearance_logs.student_id',$student_id)
        ->where('clearance_logs.school_year',$g_id)
        ->where('clearance_logs.sem',$sem)
        ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
        ->select('users.profile_image AS H','users.name AS fullname')
        ->get();

        return $sign;
        

    }

    public function checkall(Request $request)
    {
        $value = $request->ids;
        $ch = $request->chk;


        if($id == '1'){
            Clearance_log::whereIn('id', '=', $ch)->update(['assignee_id' => Auth::user()->id]);
            $value = "0";
        }else{
            Clearance_log::whereIn('id', '=', $ch)->update(['assignee_id' => NULL]);
            $value = "1";
        }

        
         $sign = Clearance_log::where('clearance_logs.student_id',$student_id)
            ->join('users', 'users.id', '=', 'clearance_logs.assignee_id')
            ->select('users.profile_image AS H','users.name AS fullname')
            ->get();

            return $sign;
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
