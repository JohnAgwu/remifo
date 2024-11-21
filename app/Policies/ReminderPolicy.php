<?php

namespace App\Policies;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReminderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (request()->has('status') && !in_array(request('status'), Reminder::STATUSES)) return false;

        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reminder $reminder): bool
    {
        return isAdmin() || $user->is($reminder->user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reminder $reminder): bool
    {
        return $reminder->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reminder $reminder): bool
    {
        return $reminder->user->is($user);
    }
}
