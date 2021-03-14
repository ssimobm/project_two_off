<?php

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FilmoqtvPublicHomeTest extends DuskTestCase
{

    /**
     * My test implementation
     */
    public function testInfrastructureIsUnbranded()
    {

        $this->browse(function (Browser $browser) {
          $browser->visit('/');
          $browser->clickLink('Login');
          $browser->visit('/login');
          $browser->type('email', 'simo1pro@gmail.com');
          $browser->type('password', '223223223');
          $browser->press('Login');
          $browser->assertPathIs('/home');
        });

    }
}
