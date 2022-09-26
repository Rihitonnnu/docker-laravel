<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $requestUser*/
        $requestUser=$request->user();
        if ($requestUser->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        }

        $requestUser->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
