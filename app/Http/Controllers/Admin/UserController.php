<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\User\UpdateRequest;

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

    /**
     * @return \Illuminate\Contracts\View\View
     * @param int $id
     *
     * */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = User::find($id);

        try {
            DB::transaction(function () use ($user, $request) {
                /** @var string $requestName */
                $requestName = $request->name;

                /** @var string $requestEmail */
                $requestEmail = $request->email;

                $user->name = $requestName;
                $user->email = $requestEmail;

                $user->save();
            });
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        return to_route('admin.user.index');
    }
}
