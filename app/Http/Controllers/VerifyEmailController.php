<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Verify email when route is accessed
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('/');
    }

    /**
     * Resend notification in case user doesn't get it before or deletes it
     * @param Request $request
     * @return RedirectResponse
     */
    public function notifyUser(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
