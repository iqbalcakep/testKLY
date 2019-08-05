<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session,View,File;
use App\Model\Users;

class UsersController extends Controller
{

    public function __construct() 
    {
        $nama = "IQBALCAKEP";
        View::share('nama', $nama);
    }
    //
    public function index(){
        return View('crud/User');
    }

    public function getAllUsers(Request $r){
        $responseUsser =Users::select('id','username')->get();
        // dd($responseUsser);
        return json_encode(array(
            "status" => "success",
            "data" => $responseUsser
        ));
    }

    public function insert_post(Request $r){
        $this->validate($r,[
            "username" => "required",
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
       $checkUsername = Users::where("username",$r->username)->count();
        if($checkUsername>0){
            $response = array(
                "status" => "danger"
                );
        }else{
            Users::create([
                "username" => $r->username,
                "password" => MD5($r->password)
            ]);
            $response = array(
                "status" => "success"
            );
        }
        return json_encode($response);
    }

    public function update_post(Request $r){
        $this->validate($r,[
            "username" => "required",
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $checkUsername = Users::where("username",$r->username)->count();
        if($checkUsername>0){
            Users::where("username",$r->username)->update([
                "password" => MD5($r->password)
            ]);
            $response = array(
                "status" => "success"
            );
        }else{
            $response = array(
                "status" => "danger"
                );
            
        }
        return json_encode($response);      
    }


    public function delete_post(Request $r){
      Users::where('id',$r->id)->delete();
        $response = array(
			"status" => "success"
            );
        return json_encode($response);
    }

}
