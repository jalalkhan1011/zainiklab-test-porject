<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->user_type == 'Admin'){
            $customerInfos = Customer::paginate(5);
        }elseif($user->user_type == 'User'){
            $customerInfos = Customer::where('user_id',$user->id)->first(); 
        }
        
        return view('home', compact('customerInfos'));
    }
}
