<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use TodoApp\Models\Todo;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('authTenant');
    }

    public function index()
    {
        $todos = Todo::all();
        return view('tenant.dashboard', ['todos' => $todos]);
    }
}
