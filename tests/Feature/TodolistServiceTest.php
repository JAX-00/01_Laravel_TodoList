<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    // Validation the service provider exiting or not
    private TodolistService  $todolistService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodoListNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "juby");

        $todolist = Session::get("todolist");
        foreach ($todolist as  $value) {
            self::assertEquals("1", $value['id']);
            self::assertEquals("juby", $value['todo']);
        }
    }

    // test data empty
    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "juby"
            ],
            [
                "id" => "2",
                "todo" => "leu"
            ]
        ];

        $this->todolistService->saveTodo("1", "juby");
        $this->todolistService->saveTodo("2", "leu");

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }
}
