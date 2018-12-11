<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('The Cabinet Memo Processing')
			 ->dontSee('NotFoundHttpException')
			 ->click('MPS')
			 ->see('Login')
			 ->see('Register')
			 ->click('Register');
			 
/*
			$user = App\User::find(6);
			$this->actingAs($user)
             ->withSession(['foo' => 'bar'])
             ->visit('/')
             ->see($user->name);

			 
//			 ->visit('/login')
             /*->see('Address')
             ->type('namanquah@ashesi.edu.gh', 'email')
             ->type('records', 'password')
             ->press('Login')
             */
             
/*             $this->actingAs($user)
				 ->withSession(['UserlevelID' => '2'])
				 ->visit('http://localhost/mywebs/laraveltest/nnademo/public/home')
 				 ->see('Inbox')
				 ->see('Setup meeting')
				 ->see('Search for Document')
				 ->seePageIs('/home');
				 
*/				 
    }
}
