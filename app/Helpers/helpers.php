<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('checkAdminAccess')) {
    function checkAdminAccess()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return true;
            } elseif ($user->hasRole('user')) {
               return false;
            } else {
                dd('unknown role');
            }
        } else {
            redirect('/');
        }
    }
}
