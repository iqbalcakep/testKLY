<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AJAXurlTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $session = $this->withSession(['username' => 'admin']);
        
        $session->get('/getAllData')->assertSee('success');
        $session->post('/crud/insert_post',["nama"=>"iqbal","email"=>"admin@iqbalcakep.com","tanggal_lahir" => "1998-06-1998"
                            ,"nohp"=>"082244604241","kelamin"=>"male","gambar"=>"NULL.png"])->assertSee('success');
        $session->post('/crud/update_post',["nama"=>"iqbal","email"=>"admin@iqbalcakep.com","tanggal_lahir" => "1998-06-1998"
                             ,"nohp"=>"082244604241","kelamin"=>"male","gambar"=>"NULL.png"])->assertSee('success');
        
    }
}
