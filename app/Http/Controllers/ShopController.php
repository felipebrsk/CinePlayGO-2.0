<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User
     */
    private function getAuthenticatedUser(): User
    {
        return Auth::user();
    }
}
