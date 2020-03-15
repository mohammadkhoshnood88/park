<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            "name.required" => "نام را وارد کنید",
            "mobile.required" => "شماره تماس را وارد کنید",
            "password.required" => "رمز عبور را وارد کنید",
            "mobile.min" => "شماره تماس وارد شده معتبر نیست",
            "password.min" => "رمز عبور حداقل شامل 6 کاراکتر است",
            "password.confirmed" => "تایید رمز عبور را به درستی وارد کنید",
        ];
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11', 'min:11'],
            'password' => 'required|min:6|confirmed',
        ];


           return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('mobile', $request->mobile);

//        if ($request->get('password') == ""){
//            return back()->with('error_text' , 'رمز عبور را وارد کنید');
//        }
        $mobile = User::where('mobile', '=', $request->get('mobile'))->get();
//        return $mobile;
//        if (count($mobile)) {
//            return back()->with('error_text', 'با این شماره تماس یک کاربر وجود دارد.');
//        }


//        if ($this->validator($request->all())->fails()) {
//            return "asdf";
//        }
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user = User::all()->where('mobile', '=', $request->get('mobile'));

//            $this->guard()->login($user);

//        return back();
        return redirect($this->redirectPath())->with('error_text_r', 'ثبت نام شما با موفقیت انجام شد، شما در صف تایید قرار گرفتید.');


//            return $this->registered($request, $user)
//                ?: redirect($this->redirectPath());

    }

    public function redirectTo()
    {
        return url()->previous();
    }

}
