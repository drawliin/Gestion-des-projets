<?php

namespace App\Http\Controllers;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view("users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();

        return view("users.edit", compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id.',id_utilisateur',
            'role' => 'required|exists:roles,name'
        ], [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',
            'role.required' => 'Please select a role.',
            'role.exists' => 'Selected role is invalid.',
        ]);

        $user = User::with('roles')->find($id);
        $user->syncRoles($request->role);
        $user->update([
            'email' => $request->email
        ]);

        return redirect()->route('users.index')->with('success', 'User Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index");
    }
}
