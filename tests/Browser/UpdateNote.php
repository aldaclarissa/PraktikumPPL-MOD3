<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateNote extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function UpdateNote(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/')
                    ->assertSee(text: 'Notes')
                    ->clickLink(link: 'Notes')
                    ->assertPathIs(path: '/notes')
                    ->press(button: 'Edit')
                    ->assertPathIs(path: '/edit-note-page/1')
                    ->type(field: 'Title', value: 'Edit Catatan')
                    ->type(field: 'Description', value: 'Catatan baruuu')
                    ->press(button: 'UPDATE')
                    ->assertPathIs(path: '/notes');
        });
    }
}
