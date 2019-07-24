<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Session,View,File;
use App\Model\Users;

class CrudController extends Controller
{
    //BY IQBALCAKEP
    private $path = "Data";
    private $date = "";

    public function __construct() 
    {
        $nama = "IQBALCAKEP";
        $this->date = date('dmYHis', time());
        View::share('nama', $nama);
    }

    public function index(){
        // $data["data"] = $this->getAllData();
        //dd($data);
        return View('crud/Dashboard');
    }


    //DATA SECTION
    public function getAllData(){
        $files = glob($this->path."/*.txt");
        $result= array();
        foreach($files as $file){
           $detail = explode(',',file_get_contents($file));
           $data = array(substr($file,5),$detail[0],$detail[1],$detail[2],$detail[3],$detail[4],"<img id='".$detail[5]."' src='./assets/file/".$detail[5]."'height='150' width='150'>");
           array_push($result,$data);
        }
        
       return json_encode(array(
           "status" => "success",
           "data" => $result
       ));
    }

    public function insert_post(Request $r){
        $this->validate($r,[
            "nama" => "required|min:5",
            "email" => "required|email",
            "tanggal_lahir" => "required",
            "nohp" => "required",
            "kelamin" => "required"
        ]);
        if($file = $r->file("gambar")){
            $tujuan_upload = 'assets/file/';
            $file->move($tujuan_upload,$r->nama."-".$this->date.".png");
                $gambar = $r->nama."-".$this->date.".png";
                $data = array(
                    "nama" => $r->nama.",",
                    "email" => $r->email.",",
                    "tanggal_lahir" => $r->tanggal_lahir.",",
                    "nohp" => $r->nohp.",",
                    "kelamin" => $r->kelamin.",",
                    "gambar" => $gambar,
                );
            }else{
                $data = array(
                    "nama" => $r->nama.",",
                    "email" => $r->email.",",
                    "tanggal_lahir" => $r->tanggal_lahir.",",
                    "nohp" => $r->nohp.",",
                    "kelamin" => $r->kelamin.",",
                    "gambar" => "NULL.png",
                );
        }

        date_default_timezone_set('asia/jakarta');
        $nama_file = $r->nama."-".$this->date.".txt";
        file_put_contents($this->path."/".$nama_file,$data);
            $response = array(
                "status" => "success",
                "hasil" => $data
                );
            return json_encode($response);

    }

    public function update_post(Request $r){
        $this->validate($r,[
            "nama" => "required|min:5",
            "email" => "required|email",
            "tanggal_lahir" => "required",
            "nohp" => "required",
            "kelamin" => "required"
        ]);
        $temp = file_get_contents($this->path."/".$r->id);  
        $tempDetail = explode(',',$temp);
        if($file = $r->file("gambar")){
            $tujuan_upload = 'assets/file/';
            $file->move($tujuan_upload,$r->nama."-".$this->date.".png");
            $gambar = $r->nama."-".$this->date.".png";
                $data = array(
                    "nama" => $r->nama.",",
                    "email" => $r->email.",",
                    "tanggal_lahir" => $r->tanggal_lahir.",",
                    "nohp" => $r->nohp.",",
                    "kelamin" => $r->kelamin.",",
                    "gambar" => $gambar,
                );
            }else{
                $data = array(
                    "nama" => $r->nama.",",
                    "email" => $r->email.",",
                    "tanggal_lahir" => $r->tanggal_lahir.",",
                    "nohp" => $r->nohp.",",
                    "kelamin" => $r->kelamin.",",
                    "gambar" => $tempDetail[5],
                );
            }

            file_put_contents($this->path."/".$r->id,$data);

            $response = array(
                "status" => "success",
                "hasil" => $data
                );
            return json_encode($response);
    }


    public function delete_post(Request $r){
        unlink($this->path."/".$r->id);
        if($r->gambar != "NULL.png")
        unlink('assets/file/'.$r->gambar);
        $response = array(
			"status" => "success"
            );
        return json_encode($response);
    }

}
