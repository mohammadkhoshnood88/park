<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Shop;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
    protected $redirectTo = '/home';
    protected $first_redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'mobile';
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

    }

    public function login(Request $request)
    {

        Session::flash('mobile' , $request->mobile);
        if ($request->get('password') == "") {
            return back()->with(['error_text' => 'رمز عبور را وارد کنید']);
        }

        $user = User::all()->where('mobile', '=', $request->mobile)->first();

        if (!$user) {
            return back()->with('error_text', 'شما تا کنون ثبت نام نکرده اید');
        }
        if ($user->isuser == 1) {
            $this->validateLogin($request);
            $profile = Shop::where('user_id', '=', $user->id)->get();


            if (count($profile) == 0) {

                redirect('/profile');

            } else {

                redirect('/home');
            }


            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        } elseif ($user->isuser == 0) {
            return back()->with('error_text_q', 'شما در صف تایید قرار دارید. لطفا منتظر بمانید');


//            return "<div style='background: #f0e68c;border: 1px solid #f1f4f6;margin: 10px'><h2 style='text-align: center;'>شما در صف تایید قرار دارید<br/>لطفا منتظر بمانید
//</h2><h5 style='text-align: center;'><a href='/login'>بازگشت به فرم ورود</a></h5></div>";
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

    }


    public function redirectTo()
    {
        $profile = Shop::where('user_id', '=', Auth::user()->id)->get();


        if (count($profile) == 0) {

            return '/profile';
        } else {

            return '/home';
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return back()->with('error_text', 'رمز عبور را اشتباه وارد کرده اید.');
    }


}

