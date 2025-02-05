<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    // take todolist from todolist service
    private TodolistService  $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }
    // action => show page todo
    public function todoList(Request $request)
    {
        $todolist = $this->todolistService->getTodolist();
        return response()->view("todolist.todolist", ["title" => "Todolist", "todolist" => $todolist]);
    }
    // add todo
    public function addTodo(Request $request) {}
    // remove todo
    public function removeTodo(Request $request, string $todoId) {}
}
