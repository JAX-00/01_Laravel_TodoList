<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    // If user exists redirect to todo list page if not return to login page
    public function home(Request $request): RedirectResponse
    {
        if ($request->session()->exists("user")) {
            return redirect("/todolist");
        } else {
            return redirect("/login");
        }
    }
}
