<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\User\UpdateRequest;

class UserController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /** @return \Illuminate\Contracts\View\View*/
    public function index()
    {
        return view('admin.user.index', ['users' => User::paginate(20)]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @param int $id
     *
     * */
    public function show(int $id)
    {
        return view('admin.user.show', ['user' => User::find($id)]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @param int $id
     *
     * */
    public function edit(int $id)
    {
        return view('admin.user.edit', ['user' => User::find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        /** @var string $userName */
        $userName = $request->name;
        /** @var string $userEmail */
        $userEmail = $request->email;
        return to_route('admin.user.index', $this->user->updateUser($userName, $userEmail, $id));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        return to_route('admin.user.index', $this->user->deleteUser($id));
    }
}
