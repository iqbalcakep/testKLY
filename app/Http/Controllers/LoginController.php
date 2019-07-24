<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session;
use App\Model\Users;

class LoginController extends Controller
{
    //BY IQBALCAKEP

    public function index(Request $request){
        if(Session::has("username"))
        return redirect("/crud");
        else
        return view('Login');
    }

    public function login_proses(Request $request){
        $data = Users::where(["username"=>$request->username,"password"=>MD5($request->password)])->first();
        if($data){
            Session::put(['username'=>$request->username,"id_user"=>$data["id_user"]]);
            return "success";
        }else{
            return "danger";
        }
    }

    public function Logout(){
        Session::flush();
        return redirect('/');
    }
}
