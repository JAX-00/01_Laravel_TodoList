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


    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Juby");
        $this->todolistService->saveTodo("2", "ZW");

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        // if remove data in id 3
        $this->todolistService->removeTodo("3");

        //we still have two data because id 3 none exist in out data

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        // if remove data in id 1
        $this->todolistService->removeTodo("1");

        // we will see only one data
        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));


        // if remove data in id 2
        $this->todolistService->removeTodo("2");

        // all of data have been remove
        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "juby",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ],
                [
                    "id" => "2",
                    "todo" => "juby"
                ]
            ]
        ])->post("/todolist/1/delete")->assertRedirect("/todolist");
    }
}
