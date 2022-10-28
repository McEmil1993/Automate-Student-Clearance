<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SignatoryAssign;
use App\Models\Message;
use App\Models\Student;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sig = SignatoryAssign::all();

        return view('pages.student_dash.message',compact('sig'));
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
        $date = date_create(date('Y-m-d H:i:s'));
        $student = Student::where('user_id',$request->input('user_id'))->first();
        if ($student) {
            if ($student->chat_st == '0') {
                return response()->json(['result'=>'0']);
            }else{
                $mess = new Message;
                $mess->clearance_id = $request->input('clearance_id');
                $mess->user_id = $request->input('user_id');
                $mess->message = $request->input('message');
                $mess->chat_status = '0';
                $mess->datetime_mess = date_format($date, 'F d, Y h:i A - D');
                $mess->save();

                return response()->json(['result'=>'1']);
            }
        }else{
            $mess = new Message;
                $mess->clearance_id = $request->input('clearance_id');
                $mess->user_id = $request->input('user_id');
                $mess->message = $request->input('message');
                $mess->chat_status = '0';
                $mess->datetime_mess = date_format($date, 'F d, Y h:i A - D');
                $mess->save();

                return response()->json(['result'=>'1']);
        }
        
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $mess = Message::where('clearance_id',$id)
        ->join('users','users.id','=','messages.user_id')
        ->get();
        $arr = array();
        if ($mess) {
            $arr = $mess;
        }
        return json_encode($arr);
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
