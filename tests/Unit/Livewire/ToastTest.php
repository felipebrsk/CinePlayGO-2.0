<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Toast;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToastTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if can add a notice.
     *
     * @return void
     */
    public function test_if_can_add_a_notice(): void
    {
        $message = 'This is a success message.';
        $type = 'success';

        Livewire::test(Toast::class)
            ->dispatch('notice', ['type' => $type, 'message' => $message])
            ->assertSee($message)
            ->assertSee($type)
            ->assertSet('notices.0.message', $message)
            ->assertSet('notices.0.type', $type);
    }

    /**
     * Test if can remove a notice.
     *
     * @return void
     */
    public function test_if_can_remove_a_notice(): void
    {
        $component = Livewire::test(Toast::class);

        $component->dispatch('notice', ['type' => 'success', 'message' => 'This is a success message.']);

        $notices = $component->viewData('notices');
        $noticeId = $notices[0]['id'];

        $component->call('remove', $noticeId)
            ->assertDontSee('This is a success message.')
            ->assertSet('notices', []);
    }
}
