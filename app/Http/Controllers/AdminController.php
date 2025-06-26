<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalRoles' => Role::count(),
            'totalCategories' => NewsCategory::count(),
        ]);
    }
}
