<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
$validator =  validator::make($request->all(),[
    'email' => 'required|email',
    'password'=>'required'
]);
if($validator->passes()){
if(Auth::guard(admin)->attempt(['email'=> $request->email,'password'=> $request->password],$request->get('remeber'))){
return redirect()->route('admin.dashborad');
}else {
    return redirect()->route('admin.login')->with('error','Either Email/password is incorrect') ;
    }

}else{
    return redirect()->route('admin.login')->withErrors($validator)->withInput($request->only(email));
} 

    }
}
