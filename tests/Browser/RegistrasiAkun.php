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
     public function RegistrasiAkun(): void
     {
         $this->browse(function (Browser $browser): void {
             $browser->visit(url: '/register')
                     ->assertSee(text:'Enterprise Application Development')
                     ->clicklink(link: 'Register')
                     ->assertPathIs('/register')
                     ->type(field: 'Name', value: 'Alda Clarissa Syahda Nur') 
                     ->type(field: 'Email', value: 'alda@example.com')
                     ->type(field: 'Password', value: 'alda123')
                     ->type(field: 'Confirm Password', value: 'alda123')
                     ->press(button: 'REGISTER')
                     ->asserPathIs(path: '/dashboard');
         });
    }
}