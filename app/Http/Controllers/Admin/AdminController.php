<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Home', [
            'title' => 'Início',
        ]);
    }

    public function profile()
    {
        return Redirect::route('admin.users.user', ['id' => auth()->id()]);
    }
}
