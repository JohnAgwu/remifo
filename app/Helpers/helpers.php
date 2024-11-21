<?php

/**
 * If the logged in user is an admin
 *
 * @return bool
 */
function isAdmin(): bool
{
    return auth()->user()->role == 'ADMIN';
}
