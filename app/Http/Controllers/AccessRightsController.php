<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\PDO\Connection;
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
use App\Models\Access_right;
use App\Models\Permission;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;


class AccessRightsController extends Controller
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


        // $r = "";
        // for ($i=1; $i < 2000; $i++) { 
        //     $r .= $i.',';
        // }

        // echo $r;
        // $g_id = Session::get('sc_id');
        // $user = Clearance_log::where('school_year', $g_id)->where('clearance_status', Auth::user()->id)->exists();

        // if ($user != "1") {
            // $students = Student::all();
       

            // $st=[];
            // foreach ($students as $key=>$value)
            // {
                
            //     $r[] = $value['user_id'];

            //     Clearance_log::create([
            //         'student_id' => $value['user_id'],
            //         'school_year'=> $g_id,
            //         'clearance_status' => Auth::user()->id,
            //     ]);

            // }


        // }



        
        //  $user;



        // $stu12 =  DB::table('clearance_logs')
        // ->where('clearance_status',22)
        // ->groupBy('student_id')
        // ->get();

        // $arr = array();

        // $arr1 = array();

        // foreach ($stu12 as $key1 ) {
         
        //     $arr[] =  $key1->student_id;
        //     $arr1[] =  $key1->clearance_status;

        // }

        // $st = DB::table('clearance_logs')
        // ->whereIn('clearance_status',$arr1)
        // ->whereIn('student_id',$arr)
        // ->groupBy('student_id')
        // ->first();

        // if ($st) {

        //      $stu1 =  DB::table('students')
        //     ->whereNotIn('user_id',$arr)
        //     ->get();

        //     foreach ($stu1 as $key) {

        //         echo $key->user_id;

        //     }

        // }else{

        //     $stu1 =  DB::table('students')
        //     ->whereNotIn('user_id',$arr)
        //     ->get();

        //     foreach ($stu1 as $key) {

        //         echo $key->user_id;

        //     }
        // }



        // $g_id = Session::get('sc_id');
        // $stu12 =  DB::table('clearance_logs')
        // ->where('clearance_status',Auth::user()->id)
        // ->groupBy('student_id')
        // ->get();

        // $arr = array();

        // $arr1 = array();

        // foreach ($stu12 as $key1 ) {
         
        //     $arr[] =  $key1->student_id;
        //     $arr1[] =  $key1->clearance_status;

        // }



        // $st = DB::table('clearance_logs')
        // ->whereIn('clearance_status',$arr1)
        // ->whereIn('student_id',$arr)
        // ->groupBy('student_id')
        // ->first();

        // if ($st) {

        //     $ass = DB::table('assignees')
        //     ->where('user_id',Auth::user()->id)
        //     ->first();

        //     $student_exist = DB::table('students')
        //     ->join('courses','courses.id','=','students.course_id')
        //     ->where('courses.department_id',$ass->department_id)
        //     ->exists();

        //     if ($student_exist) {

        //         $stu1 = DB::table('students')
        //         ->join('courses','courses.id','=','students.course_id')
        //         ->where('courses.department_id',$ass->department_id)
        //         ->whereNotIn('user_id',$arr)
        //         ->get();

                

        //         foreach ($stu1 as $key) {

        //             Clearance_log::create([
        //                 'student_id' => $key->user_id,
        //                 'school_year'=> $g_id,
        //                 'clearance_status' => Auth::user()->id,
        //             ]);

        //             // echo $key->user_id;

        //         }

        //     }else{

        //         $stu1 = DB::table('students')
        //         ->whereNotIn('user_id',$arr)
        //         ->get();

        //         foreach ($stu1 as $key) {

        //             Clearance_log::create([
        //                 'student_id' => $key->user_id,
        //                 'school_year'=> $g_id,
        //                 'clearance_status' => Auth::user()->id,
        //             ]);

        //         }

        //     }
 

        // }else{

        //     $ass = DB::table('assignees')
        //     ->where('user_id',Auth::user()->id)
        //     ->first();

        //     $student_exist = DB::table('students')
        //     ->join('courses','courses.id','=','students.course_id')
        //     ->where('courses.department_id',$ass->department_id)
        //     ->exists();

        //     if ($student_exist) {

        //         $stu1 = DB::table('students')
        //         ->join('courses','courses.id','=','students.course_id')
        //         ->where('courses.department_id',$ass->department_id)
        //         ->whereNotIn('user_id',$arr)
        //         ->get();


        //         foreach ($stu1 as $key) {

        //             Clearance_log::create([
        //                 'student_id' => $key->user_id,
        //                 'school_year'=> $g_id,
        //                 'clearance_status' => Auth::user()->id,
        //             ]);

        //         }

        //     }else{

        //         $stu1 = DB::table('students')
        //         ->whereNotIn('user_id',$arr)
        //         ->get();

        //         foreach ($stu1 as $key) {

        //             Clearance_log::create([
        //                 'student_id' => $key->user_id,
        //                 'school_year'=> $g_id,
        //                 'clearance_status' => Auth::user()->id,
        //             ]);

        //         }

        //     }
        // }

       
       
        $user = User_info::where('user_id',Auth::user()->id)->first();

        $permis_status = DB::table('roles_')
        ->join('permissions_','permissions_.id','=','roles_.permission_id')
        ->where('role_id',$user->role)
        ->where('permission_id','5')
        ->select('*','roles_.id AS r_id')
        ->first();

        // if($permis_status->sig == '0'){

        //    include '404.php';

        // }else{

            $access = Access_right::all();
            $permiss = DB::table('permissions_')->get();

            $permis_status = DB::table('permissions_')->where('status','1')->get();

            return view('pages.accessmanage.index',compact('access','permiss','permis_status'));
        // }




       

    }
    public function getAlldata($id)
    {
        $permis_status = DB::table('roles_')
        ->join('permissions_','permissions_.id','=','roles_.permission_id')
        ->where('role_id',$id)
        ->select('*','roles_.id AS r_id')
        ->get();
        return $permis_status;
    }

    public function access_roole($id,$name)
    {
        $user = User_info::where('user_id',$id)->first();

        $permis_status = DB::table('roles_')
        ->join('permissions_','permissions_.id','=','roles_.permission_id')
        ->where('role_id',$user->role)
        ->where('permission_id',$name)
        ->select('*','roles_.id AS r_id')
        ->first();

        return $permis_status;
    }

    public function check_user()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $make = "po";
        return $make;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $access = new Access_right;
        $access->type = $request->input('type');
        $access->access_right = $request->input('access_right');
        $access->row = $request->input('row');
        $access->all = '0';
        $access->add = '0';
        $access->update = '0';
        $access->delete = '0';
        $access->save();

        return redirect()->back()->with('success','Successfully add new permission!');

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

    public function new_permission(Request $request)
    {
        if ($request->input('access_right') != "") {

            $per = DB::table('permissions_')->where('id',$request->input('id'))->first();

            if ($per) {
                DB::update('update permissions_ set name=? ,updated_at=? where id =?',[$request->input('access_right'),NOW(),$request->input('id')]);
                return response()->json(['success'=>'Successfully update permission.','result'=> '1']);
            }else{

                $per1 = DB::table('permissions_')->where('name',$request->input('access_right'))->first();

                if ($per1) {

                    return response()->json(['error'=>'Name is already exists!','result'=> '0']);

                }else{

                    DB::insert('insert into permissions_ (name,status,created_at)  values(?,?,?)',[$request->input('access_right'),'1',NOW()]);

                    $per = DB::table('permissions_')->where('name',$request->input('access_right'))->first();

                    DB::insert('insert into roles_ (permission_id, role_id, sig,created_at)  values(?,?,?,?)',[$per->id,'1','0',NOW()]);
                    DB::insert('insert into roles_ (permission_id, role_id, sig,created_at)  values(?,?,?,?)',[$per->id,'2','0',NOW()]);

                    return response()->json(['success'=>'Successfully add new permission.','result'=> '1']);
                }

                
            }
        }else{

            return response()->json(['error'=>'Please input name.','result'=> '0']);
        }
       

        
    }
    public function delete(Request $request)
    {
        $status = "1";
        $de = "active";

        $per = DB::table('permissions_')->where('id',$request->input('id'))->first();

        if ($per->status == '1') {

            $status = "0";
            $de = "deactivated";

            DB::delete('DELETE FROM roles_ WHERE permission_id=?',[$request->input('id')]);

        }else{

            DB::insert('insert into roles_ (permission_id, role_id, sig,created_at)  values(?,?,?,?)',[$request->input('id'),'1','0',NOW()]);
            DB::insert('insert into roles_ (permission_id, role_id, sig,created_at)  values(?,?,?,?)',[$request->input('id'),'2','0',NOW()]);
        }

        DB::update('update permissions_ set status=? ,updated_at=? where id =?',[$status,NOW(),$request->input('id')]);

        return redirect()->back()->with('success','Successfully '.$de.' permission.');
    }

    public function check_sig($id)
    {
        $status = "1";

        $chk = DB::table('roles_')
        ->join('permissions_','permissions_.id','=','roles_.permission_id')
        ->where('roles_.id',$id)
        ->select('*','roles_.id AS r_id')
        ->first();

        if ($chk->sig == "1") {

            $status = "0";
        }

        DB::update('update roles_ set sig=? , updated_at=? where id =?',[$status,NOW(),$id]);

        return response()->json(['success'=>'Successfully update '.$chk->name.'.','result'=> '1']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response     protected $fillable = [ 'type', 'access_right', 'column', 'add', 'update', 'delete'];
     */
    public function update(Request $request)
    {   
        $id = $request->input('id');
        $access = Access_right::find($id);
        $access->type = $request->input('type');
        $access->access_right = $request->input('access_right');
        $access->row = $request->input('row');
        $access->all = $request->input('all');
        $access->add = $request->input('add');
        $access->update = $request->input('update');
        $access->delete = $request->input('delete');
        $access->update();

        return redirect()->back()->with('success','Successfully update permission!');
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
