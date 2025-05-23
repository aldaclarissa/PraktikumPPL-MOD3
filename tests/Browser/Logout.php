<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class Logout extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testLogout()
    {
        $user = User::factory()->create([
            'email' => 'alda' . uniqid() . '@gmail.com',
            'password' => bcrypt('alda123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'alda123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->click('button.inline-flex.items-center')
                ->clickLink('Log Out')
                ->assertPathIs('/');
        });
    }
}
