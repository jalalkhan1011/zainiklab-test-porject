<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\ReCaptcha;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'details' => ['required'],
            'avater' => ['required'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => 'User',
            'password' => Hash::make($data['password']),
        ]);

        $this->creaeCustomer($request,$user->id);

        return $user;
    }

    public function creaeCustomer(Request $request,$userId)
    {
        $file = $request->file('avater');

        $input['avater'] = $file->getClientOriginalName();
        $file->move(public_path('upload'), $file->getClientOriginalName());
        $length = 8;
        $str = random_bytes($length);
        $str = base64_encode($str);
        $str = str_replace(["+", "/", "="], "", $str);
        $str = substr($str, 0, $length);
        $customer = [
            'name' => $request->name,
            'email' => $request->email,
            'details' => $request->details,
            'avater' => $input['avater'],
            'customer_id' => $str,
            'link' => 'customer-info?link=' . '' . $str,
            'user_id' => $userId
        ];

        Customer::create($customer);
    }
}
