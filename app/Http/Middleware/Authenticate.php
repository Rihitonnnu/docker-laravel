<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     *  @var string $userRoute
     */
    private $userRoute = 'user.login';
    /**
     * @var string $adminRoute
     */
    private $adminRoute = 'admin.login';

    protected function redirectTo($request)
    {
        // 未認証の場合にログイン画面へリダイレクトさせる処理
        if (!$request->expectsJson()) {
            if (Route::is('admin.*')) {
                return route($this->adminRoute);
            } else {
                return route($this->userRoute);
            }
        }
    }
}
