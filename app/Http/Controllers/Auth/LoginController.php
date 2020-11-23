<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\Semester;
use App\Models\Room;
use App\User;


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
    // protected $redirectTo = '/home';
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // return view('auth.login');
        return view('login');
    }

    public function login(Request $request)
    {
        if (count(User::all()) == 0) {
            $admin          = new User();
            $admin->name    = 'Admin';
            $admin->email   = 'admin@gmail.com';
            $admin->password= Hash::make('admin@gmail.com');
            $admin->save();

            //For semester
            $checkSemester = Semester::all();

            if (count($checkSemester)==0) 
            {       
                for ($i=1; $i <= 8 ; $i++) 
                { 
                    $semester = new Semester();

                    if ($i==1) {
                        $semester->semester_name = '1st';
                    }elseif ($i==2) {
                        $semester->semester_name = '2nd';
                    }elseif ($i==3) {
                        $semester->semester_name = '3rd';
                    }elseif ($i==4 || $i==5 || $i==6 || $i==7 || $i==8) {
                        $semester->semester_name = $i.'th';
                    }
                    
                    $semester->save();
                }
            }

            //For Rooms
            $checkRoom = Room::all();

            if (count($checkRoom)==0) 
            {  
                for ($i=1; $i <= 5 ; $i++) 
                { 
                    $room = new Room();

                    $room->room_no = '10'.$i;
                    
                    $room->save();
                }
            }


            return redirect()->back();
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        // return $this->loggedOut($request) ?: redirect('/');
        return $this->loggedOut($request) ?: redirect('/login');
    }
}
