<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /** @return \Illuminate\Contracts\View\View*/
    public function index()
    {
        $users=DB::table('users')->select('id', 'name')->paginate(20);
        return view('admin.user.index', compact('users'));
    }
}
