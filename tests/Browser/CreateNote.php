<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateNote extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function CreateNote(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit(url: '/')
                    ->assertSee(text: 'Create Notes')
                    ->clickLink(link: 'Notes')
                    ->assertPathIs(path: '/notes')
                    ->press(button: 'Create Note')
                    ->assertPathIs(path: '/create-note')
                    ->type(field: 'Title', value: 'Ini Catatan')
                    ->type(field: 'Description', value: 'Ini adalah isi catatan')
                    ->press(button: 'CREATE')
                    ->assertPathIs(path: '/notes');
        });
    }
}
