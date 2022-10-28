<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SignatoryAssign;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SignatoryAssignController extends Controller
{
    private $name;

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

        return view('pages.signatory_assign.index',compact('sig'));
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
            'name'          =>  'required|string'
        ]); 

        $sig = new SignatoryAssign;
        $sig->name = $request->input('name');
        $sig->status ="1";

        // $_SESSION['name1'] = $request->input('name');

        $sig->save();



        // Schema::table('clearances', function (Blueprint $table) {
            
        //     $name = $_SESSION['name1'];
        //     $table->string($name)->nullable();


        // });

        // $table->renameColumn('emp_name', 'employee_name');

        return redirect()->back()->with('success','Successfully add Signatory Assign!');

    }


      public function setName($name){
         $this->name = $name;
      }
      public function getName(){
         return $this->name;
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
        $request->validate([
            'name'          =>  'required|string'
        ]);

        $id = $request->input('id');
        $sig = SignatoryAssign::find($id);
        $sig->name = $request->input('name');
        $sig->status ="1";

        $sig->save();

        return redirect()->back()->with('success','Successfully add Signatory Assign!');
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
        $member = SignatoryAssign::find($id);
        $member->status = $st;
        $member->delete();

        return redirect()->back()->with('success','Successfully delete Signatory Assign!');
    }
}
