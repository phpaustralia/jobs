<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    /**
     * @test
     */
    public function loginTest()
    {
        $user = factory(App\User::class)->create([
            'password' => bcrypt('secret')
        ]);

        $this->visit("/")
            ->click("Login")
            ->type($user->email, 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/home');
    }

    /**
     * @test
     */
    public function logoutTest()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
            ->visit("/home")
            ->click("Logout")
            ->seePageIs("/");
    }

    /**
     * @test
     */
    public function registerTest()
    {
        $this->visit("/register")
            ->type('John Doe', 'name')
            ->type('john@doe.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Register')
            ->seeInDatabase('users', ['name' => 'John Doe', 'email' => 'john@doe.com']);
    }
}
