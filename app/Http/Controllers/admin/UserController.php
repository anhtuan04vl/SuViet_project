<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function listUsers()
    {
        $users = User::all();

        return view('admin.template.listaccount', compact('users'));
    }
}
