<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_is_hashed_correctly()
    {
        $user = new User();
        $plainPassword = 'password123';

        $user->password = bcrypt($plainPassword);

        $this->assertTrue(Hash::check($plainPassword, $user->password));
    }
}
