<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testSwaggerLinkExists(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Swagger');
        });
    }

    public function testHorizonLinkExists(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Horizon');
        });
    }
}
