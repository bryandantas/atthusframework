<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AdminController extends Controller
{
    /**
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Home', [
            'title' => 'Início',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function profile(): RedirectResponse
    {
        return Redirect::route('admin.users.user', ['id' => auth()->id()]);
    }
}
