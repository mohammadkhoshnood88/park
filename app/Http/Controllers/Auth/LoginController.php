<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;

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
    protected $redirectTo = '/';

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

    public function login(Request $request)
    {
        $user = User::all()->where('mobile', '=', $request->mobile)->first();

        if (!$user) {
            return "<div style='background: #2176bd;border: 1px solid saddlebrown;margin: 50px; box-shadow: 10px 10px 25px black'><h2 style='text-align: center;'>شما هنوز ثبت نام نکرده اید
</h2><h5 style='text-align: center;'><a href='/register'>ایجاد حساب</a></h5></div>";
        }
        if ($user->isuser == 1) {
            $this->validateLogin($request);


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
        } elseif ($user->isuser == 0 || !$user) {
            return "<div style='background: #2176bd;border: 1px solid saddlebrown;margin: 10px'><h2 style='text-align: center;'>شما در صف تایید قرار دارید<br/>لطفا منتظر بمانید
</h2><h5 style='text-align: center;'><a href='/'>بازگشت به فرم ورود</a></h5></div>";
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

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('mobile', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

}

