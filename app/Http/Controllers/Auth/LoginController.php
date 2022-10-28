<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login2(Request $request) {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
  
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                
                
                $credentials = $request->only('email', 'password');

                 Auth::attempt($credentials);

                 $SchoolYear = DB::table('school_years')->where('status', '1')->first();

                 if ($SchoolYear) {
                    Session::put('sc_id', $SchoolYear->id);
                    Session::put('school_year', $SchoolYear->school_year);
                    Session::put('semester', $SchoolYear->semester);
                 }else{
                    Session::put('sc_id', '');
                    Session::put('school_year', '');
                    Session::put('semester', '');
                 }
 
// echo $user->name;
                 
                 return response()->json(["true"=>"true","result"=>$user->type]);

            } else {
                return response()->json("falsepass");
            }
        } else {
                return response()->json("falseuser");
            // return redirect()->back()->with(['err_email' => "* Input email doesn't exist!"]);
        }
         
    }

    public function check_user(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $user = User::where('email', $request->email)->first();
        $result = "";
        if (!$user) {
            $result = "false";
        } 
        return response()->json($result);
    }
    
}
