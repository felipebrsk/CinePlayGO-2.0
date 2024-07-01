<?php

namespace Tests\Unit\Traits;

use Tests\TestCase;
use Tests\Traits\HasDummyUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasPasswordTest extends TestCase
{
    use HasDummyUser;
    use RefreshDatabase;

    /**
     * Test if can hash the password on user creation.
     *
     * @return void
     */
    public function test_if_can_hash_the_password_on_user_creation(): void
    {
        $user = $this->createDummyUser([
            'password' => 'admin1234'
        ]);

        $this->assertDatabaseMissing('users', [
            'password' => 'admin1234'
        ]);

        $this->assertTrue(Hash::check('admin1234', $user->password));

        $user->update([
            'password' => 'user1234',
        ]);

        $this->assertTrue(Hash::check('user1234', $user->password));
    }
}
