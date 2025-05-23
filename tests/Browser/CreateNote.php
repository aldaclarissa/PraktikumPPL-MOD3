<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class CreateNote extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testCreateNote(): void
    {
        $user = User::factory()->create([
            'email' => 'alda' . uniqid() . '@gmail.com',
            'password' => bcrypt('alda123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->waitFor('input[name=email]')
                ->type('email', $user->email)
                ->type('password', 'alda123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/create-note')
                ->waitFor('input[name=title]')
                ->waitFor('textarea[name=description]')
                ->type('title', 'Ini catatan')
                ->type('description', 'Ini adalah isi catatan baru')
                ->press('.btn-submit-note');
        });
    }
}
