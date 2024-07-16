<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class Toast extends Component
{
    /**
     * The notices to show on toast.
     *
     * @var array<int, mixed>
     */
    public $notices = [];

    /**
     * Define the listeners for the component.
     *
     * @var array<int, string>
     */
    protected $listeners = ['notice'];

    /**
     * Create the notice for the toast.
     *
     * @param array<string, string>
     * @return void
     */
    public function notice(array $detail): void
    {
        $this->notices[] = [
            'id' => uniqid(),
            'type' => $detail['type'],
            'message' => $detail['message'],
        ];
    }

    /**
     * Remove the notice from notices.
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        $this->notices = array_filter($this->notices, function (array $notice) use ($id) {
            return $notice['id'] !== $id;
        });
    }

    /**
     * Render the livewire toast.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.toast');
    }
}
