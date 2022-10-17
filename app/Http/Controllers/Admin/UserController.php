<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /** @return \Illuminate\Contracts\View\View*/
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @param int $id
     *
     * */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show', compact('user'));
    }
}
