<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Modules\Task\App\Models\Task;
use Tests\DuskTestCase;

class LetterControllerTest extends DuskTestCase
{

    public function testIndexPage(): void
    {
        $user = User::factory()->admin()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('panel.letters.index'))
                ->assertSee('Letters');
        });
    }

    public function testCreatePage(): void
    {
        $user = User::factory()->admin()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('panel.letters.create'))
                ->assertSee('Create Letter');
        });
    }

    public function testStoreMethod(): void
    {
        $this->browse(function (Browser $browser) {
            $adminUser = User::factory()->admin()->create();
            $user = User::factory()->user()->create();
            $tasks = Task::factory()->count(3)->create();

            $browser->loginAs($adminUser)
                ->visit(route('panel.letters.create'))
                ->type('title', 'Test Letter')
                ->type('body', 'This is a test letter.')
                ->select('user_id', $user->id)
                ->select('tasks[]', $tasks->pluck('id')->toArray())
//                ->pause(1000) // Add a 1-second delay
                ->press('Save')
//                ->pause(2000) // Add a 2-second delay
                ->assertPathIs('/panel/letters')
                ->assertSee('Letter has been created successfully!');
        });
    }
}
