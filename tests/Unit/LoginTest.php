<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Mode\Users;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->assertDatabaseHas('users', [
            'id'=>1,'username' => 'admin','password' => MD5("admin")
         ]);

         $response = $this->withSession(['username' => 'username'])
         ->get('/crud');
         $response->assertStatus(200);
    }
    


}
