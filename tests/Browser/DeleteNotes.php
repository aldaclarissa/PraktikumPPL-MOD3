<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;

class DeleteNotes extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testDeleteNote()
    {
        $user = User::factory()->create([
            'email' => 'alda' . uniqid() . '@gmail.com',
            'password' => Hash::make('alda123'),
        ]);

        $note = Note::create([
            'penulis_id' => $user->id,
            'judul' => 'Ini hapus catatan',
            'isi' => 'Ini adalah isi catatan yang akan dihapus',
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'alda123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/notes')
                ->assertSee('Ini hapus catatan')
                ->waitFor("#delete-{$note->id}")
                ->click("#delete-{$note->id}");
        });
    }
}
