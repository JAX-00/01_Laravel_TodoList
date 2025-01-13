<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText("Login");
    }

    public function testLoginForMember()
    {
        $this->withSession([
            "user" => "juby"
        ])->get('/login')->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "juby"
        ])->post('/login', [
            "user" => "juby",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "juby",
            "password" => "rahasia"
        ])->assertRedirect("/")->assertSessionHas("user", "juby");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("user or password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "juby"
        ])->post('/logout')->assertRedirect("/")->assertSessionMissing("user");
    }

    public function testGuest()
    {
        $this->post('/logout')->assertRedirect("/");
    }
}
