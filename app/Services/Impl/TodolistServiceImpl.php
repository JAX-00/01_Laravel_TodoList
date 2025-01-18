<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodoListService
{
    public function saveTodo(string $id, string $todo): void
    {
        // save data in sesssion (there is a !session if not execution this )
        if (!Session::exists("todoList")) {
            Session::put("todolist", []);
        }

        // insert session data in array
        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    // take array data in session
    public function getTodolist(): array
    {
        // get data in todo list , if not take array 0 value
        return Session::get("todolist", []);
    }
}
