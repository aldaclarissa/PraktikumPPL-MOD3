<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Note;

class LihatNotes extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testLihatNote()
    {
        $user = User::factory()->create([
            'email' => 'alda' . uniqid() . '@gmail.com',
            'password' => bcrypt('alda123'),
        ]);

        $note = Note::create([
            'penulis_id' => $user->id,
            'judul' => 'Ini catatan',
            'isi' => 'Ini adalah isi catatan baru',
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'alda123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/notes')
                ->assertSee('Ini catatan')
                ->assertSee('Ini adalah isi catatan baru');
        });
    }
}
