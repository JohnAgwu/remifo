<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Constants;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\UnauthorizedException;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        if (!isAdmin()) {
            return view('errors.401');
        }
        $users = User::latest()->paginate(Constants::PG_NUM);

        return view('pages.users.index', compact('users'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('pages.users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:11', Rule::unique('users')->ignoreModel($user)]
        ]);

        try {
            $old_name = $user->name;
            $old_phone = $user->phone;

            if ($old_name != $request->name && !$user->name_changed) {
                $user->name = $request->name;
                $user->name_changed = true;
            }

            if ($old_phone != $request->phone && !$user->phone_changed) {
                $user->phone = $request->phone;
                $user->phone_changed = true;
            }

            $user->save();

            $msg = $user->phone_changed && $user->name_changed ? 'Update Successful! Can no longer edit profile.' : 'Update successful!';

            return back()->with('success', $msg);

        }
        catch (\Exception $e) {
            return back()->with('error', 'An error occurred. Please try Again!');
        }
    }

    /**
     * Deletes a user and the corresponding reminders
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user): \Illuminate\Http\RedirectResponse
    {
        try {
            $name = $user->name;
            $email = $user->email;

            $user->deleteOrFail();

            return back()->with('success', "User - $name | $email along with corresponding reminders deleted successfully!");
        }
        catch (\Throwable $e) {

            return back()->with('error', 'An error occurred. Try Again!');
        }

    }
}
