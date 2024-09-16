<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use app\Models\User;
use App\Models\Village;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserAddMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index() {
        $users = User::role('user')->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        return view('admin.pages.users.users', compact('users'));
    }

    public function destroy(string $id)
    {
         $user = User::findOrFail($id);
         $user->delete();
         return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function adminUsers() {
        $adminUsers = User::role('admin')->get();

        return view('admin.pages.users.adminUsers', compact('adminUsers'));
    }

    public function store(Request $request) {
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
    
            // Find the admin role
            $adminRole = Role::where('name', 'admin')->first();
    
            // Create user with validated data and hash the password, without 'cid'
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make('Bnbl@2024'),
            ]);
    
            // Assign the admin role to the created user
            $user->assignRole($adminRole);
            $password = 'Bnbl@2024';

            Mail::to($user->email)->send(new UserAddMail($user, $password));
    
            // Return a response (redirect, success message, etc.)
            return redirect()->back()->with('success', 'Admin User added successfully');
        }
    }

}
