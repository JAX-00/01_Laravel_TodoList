<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "juby",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ]
            ]
        ])->get('/todolist')->assertSeeText("1")->assertSeeText("juby");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "juby"
        ])->post("/todolist", [])->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "juby"
        ])->post("/todolist", [
            "todo" => "Eko"
        ])->assertRedirect("/todolist");
    }
}
