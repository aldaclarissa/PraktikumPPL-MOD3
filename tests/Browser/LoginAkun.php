<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginAkun extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */
    public function Login(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit(url: '/')
                    ->assertSee(text: 'Enterprise Application Development')
                    ->clickLink(link: 'Login')
                    ->assertPathIs(path: '/login')
                    ->type(field: 'Email', value: 'alda@gmail.com')
                    ->type(field: 'Password', value: 'alda123')
                    ->press(button: 'LOG IN')
                    ->assertPathIs(path: '/dashboard');
        });
    }
}
