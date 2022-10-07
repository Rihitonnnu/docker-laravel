<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /** @return \Illuminate\Contracts\View\View*/
    public function index()
    {
        $users=User::paginate(20);
        return view('admin.user.index', compact('users'));
    }
}
