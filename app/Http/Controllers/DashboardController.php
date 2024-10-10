<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return app(AdminController::class)->dashboard();
        }
        if ($user->role === 'superadmin') {
            return app(SuperAdminController::class)->dashboard();
        }
        return redirect()->intended(route('home', absolute: false));
    }
}
