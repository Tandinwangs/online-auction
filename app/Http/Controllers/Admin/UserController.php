<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use app\Models\User;
use App\Models\Village;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.pages.users.users', compact('users'));
    }

    public function destroy(string $id)
    {
         $user = User::findOrFail($id);
         $user->delete();
         return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
