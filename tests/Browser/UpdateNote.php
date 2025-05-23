<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Note;

class UpdateNote extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testUpdateNote(): void
    {
        $user = User::factory()->create([
            'email' => 'alda' . uniqid() . '@gmail.com',
            'password' => bcrypt('alda123'),
        ]);

        // Buat note baru via model agar dapat ID-nya
        $note = Note::create([
            'judul' => 'Catatan Lama',
            'isi' => 'Isi lama',
            'penulis_id' => $user->id,
        ]);

        $this->browse(function (\Laravel\Dusk\Browser $browser) use ($user, $note) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'alda123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/edit-note-page/' . $note->id)
                ->screenshot('edit-note-debug')
                ->waitFor('input[name=title]')
                ->waitFor('textarea[name=description]')
                ->type('title', 'Ini catatan baru')
                ->type('description', 'Ini adalah isi catatan baru')
                ->press('button[type=submit]')
                ->waitForLocation('/notes');
        });
    }
}
