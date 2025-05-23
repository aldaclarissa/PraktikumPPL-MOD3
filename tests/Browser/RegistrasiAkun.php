<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrasiAkun extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example,
     */
     public function testRegistrasiAkun(): void
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/')
                 ->assertSee('Enterprise Application Development')
                 ->clickLink('Register')
                 ->assertPathIs('/register')
                 ->type('name', 'Alda')
                 ->type('email', 'alda@gmail.com')
                 ->type('password', 'alda123')
                 ->type('password_confirmation', 'alda123')
                 ->press('REGISTER')
                 ->assertPathIs('/dashboard');
         });
    }
}