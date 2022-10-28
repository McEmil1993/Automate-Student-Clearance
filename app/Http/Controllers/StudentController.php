<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_info;
use App\Models\Prefix;
use App\Models\YearLevel;
use App\Models\Course;
use App\Models\Suffix;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;


class StudentController extends Controller
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
        $prefix =  Prefix::all();
        $suffix =  Suffix::all();
        $course =  Course::all();
        $year_level = YearLevel::all();
        $stu =  Student::all();
        $students = DB::table('users')
            ->join('user__infos', 'users.id', '=', 'user__infos.user_id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->join('year_levels', 'year_levels.id', '=', 'students.year_level_id')
            ->select('*','users.name AS fullname','users.id AS D','students.status AS st')
            ->get();

        return view('pages.students.index',compact('prefix','suffix','course','year_level','stu','students'));
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
        $request->validate([
            'firstname'         =>  'required|string',
            'lastname'          =>  'required|string',
            'middlename'        =>  'required|string',
            'contact'           =>  'required|integer|min:10',
            'course'        =>  'required|string',
            'year_level'          =>  'required|string',
            'status'              =>  'required|string',
            'student_id'  =>  'required|string',
            'address'           =>  'required|string',
            'email'             =>  'required|string',
            'password'          =>  'required|string'
        ]);

        $firstname = $request->input('firstname');
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $suffix = $request->input('suffix');
        $course = $request->input('course');
        $year_level = $request->input('year_level');
        $status = $request->input('status');
        $contact = $request->input('contact');
    
        $address = $request->input('address');
        $email = $request->input('email');
        $password = $request->input('password');
        $student_id = $request->input('student_id');

        $n = "";

        if ($suffix == "") {
            $n = $firstname. ' '. $middlename.' '.$lastname;
        }else{
            $n = $firstname. ' '. $middlename.' '.$lastname. '. '.$suffix;
        }    

        $user = new User;
        $user->name =  $n;
        $user->email = $email;

        if ($request->has('student_profile')) {
            $image = $request->file('student_profile');
            $name = Str::slug($n).'-student-profile';
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);
            $user->profile_image = $filePath;
        }else{
            $user->profile_image = 'uploads/user.png';
        }

        $user->password = Hash::make($password);
        $user->type = "3";
        $user->save();

        $getUser = User::where('email',$email)->first();

        $userId = $getUser->id;

        $User_info = new User_info;
        $User_info->user_id = $userId;
        $User_info->prefix = "";
       
        $User_info->firstname = $firstname;
        $User_info->middlename = $middlename;
        $User_info->lastname = $lastname;
        $User_info->suffix = $suffix;
        $User_info->contact = $contact;
        $User_info->address = $address;
        
        $User_info->role = "3";

        $User_info->save();


        $student = new Student;
        $student->user_id = $userId;
        $student->student_id = $student_id;
        $student->course_id = $course;
        $student->year_level_id = $year_level;
        $student->status = $status;
        $student->chat_st = '0';
        $student->save();

        return redirect()->back()->with('success','Successfully add new student!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_chat_status($id,Request $request)
    {
        $student = Student::where('user_id',$id)->first();
        $student->chat_st = $request->status;
        $student->save();
        $st = "";
        if ($request->status == "1") {
            $st = "Success inabled to reply";
        }else{
            $st = "Success disabled to reply";
        }
        return $st;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $user = User::find($id);

        $User_info = User_info::where('user_id',$id)->first();

        $student = Student::where('user_id',$id)->first();
     

        return response()->json([
            "fullname"=>$user->name,
            "email"=>$user->email,
            "firstname"=>$User_info->firstname,
            "middlename"=>$User_info->middlename,
            "lastname"=>$User_info->lastname,
            "suffix"=>$User_info->suffix,
            "contact"=>$User_info->contact,
            "address"=>$User_info->address,
            "status"=>$student->status,
            "course"=>$student->course_id,
            "year_level"=>$student->year_level_id,
            "student_id"=>$student->student_id
        ]);
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
        $request->validate([
            'firstname'         =>  'required|string',
            'lastname'          =>  'required|string',
            'middlename'        =>  'required|string',
            'contact'           =>  'required|integer|min:10',
            'course'        =>  'required|string',
            'year_level'          =>  'required|string',
            'status'              =>  'required|string',
            'student_id'  =>  'required|string',
            'address'           =>  'required|string',
            'email'             =>  'required|string'
        ]);
        $id = $request->input('id');
        $firstname = $request->input('firstname');
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $suffix = $request->input('suffix');
        $course = $request->input('course');
        $year_level = $request->input('year_level');
        $status = $request->input('status');
        $contact = $request->input('contact');
    
        $address = $request->input('address');
        $email = $request->input('email');
        $password = $request->input('password');
        $student_id = $request->input('student_id');

        $n = "";

        if ($suffix == "") {
            $n = $firstname. ' '. $middlename.' '.$lastname;
        }else{
            $n = $firstname. ' '. $middlename.' '.$lastname. '. '.$suffix;
        }    

        $user = User::find($id);
        $user->name =  $n;
        $user->email = $email;

        if ($request->has('student_profile')) {
            $image = $request->file('student_profile');
            $name = Str::slug($n).'-student-profile';
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $newname = $name. '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/',$newname);
            $user->profile_image = $filePath;
        }
        if ($password != "") {
            $request->validate([
            'password'  =>  'min:8'
            ]);            
            $user->password = Hash::make($password);
        }
        
        $user->type = "3";
        $user->update();

        $User_info = User_info::where('user_id',$id)->first();
        $User_info->prefix = "";
       
        $User_info->firstname = $firstname;
        $User_info->middlename = $middlename;
        $User_info->lastname = $lastname;
        $User_info->suffix = $suffix;
        $User_info->contact = $contact;
        $User_info->address = $address;
        
        $User_info->role = "3";

        $User_info->update();


        $student =  Student::where('user_id',$id)->first();
        $student->student_id = $student_id;
        $student->course_id = $course;
        $student->year_level_id = $year_level;
        $student->status = $status;
        $student->update();

        return response()->json(['success'=>'Successfully update student!']);
    }

    public function status(Request $request)
    {   
        $id = $request->input('id');
        $st = "";
        if ($request->input('status') == "1") {
            $st = "activate";
        }else{
            $st = "deactivate";
        }
        $student = Student::where('user_id',$id)->first();
       
        $student->status = $request->input('status');
        $student->update();

        return redirect()->back()->with('success','Successfully '.$st.' student!');
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
        
        $user = User::where('id',$id)->first();

        $user->delete();

        $User_info = User_info::where('user_id',$id)->first();

        $User_info->delete();

        $assignee = Student::where('user_id',$id)->first();

        $assignee->delete();

        return redirect()->back()->with('success','Successfully delete student!');
    }
}
