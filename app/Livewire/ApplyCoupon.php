<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Exceptions\BadRequestException;
use Illuminate\Validation\ValidationException;

class ApplyCoupon extends Component
{
    /**
     * The coupon code.
     *
     * @var string
     */
    public $code;

    /**
     * The rules for validation.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'code' => 'required|string',
    ];

    /**
     * Apply the coupon.
     *
     * @return void
     */
    public function apply(): void
    {
        $this->validate();

        $couponService = couponService();

        try {
            $couponService->apply($this->code);

            $this->dispatch('updatePrices');
            $this->dispatch('notice', ['message' => 'The coupon was successfully applied', 'type' => 'success']);
        } catch (BadRequestException $e) {
            throw ValidationException::withMessages(['code' => $e->getMessage()]);
        }
    }

    /**
     * Remove the coupon.
     *
     * @return void
     */
    public function remove(): void
    {
        $couponService = couponService();

        $couponService->remove();

        $this->dispatch('updatePrices');
    }

    /**
     * Render the apply coupon view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.apply-coupon');
    }
}
