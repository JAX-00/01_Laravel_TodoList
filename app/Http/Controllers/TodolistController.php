<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistController extends Controller
{
    // action => show page todo
    public function todolist(Request $request) {}
    // add todo
    public function addTodo(Request $request) {}
    // remove todo
    public function removeTodo(Request $request, string $todoId) {}
}
