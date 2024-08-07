<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
        ], ['email.unique' => 'Email already exists']);

        $user = new User();
        $user->fill($validated);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Successfully registered');
    }

    public function edit(User $user) {
 
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], ['email.unique' => 'Email already exists']);

        
        $user->fill($validated);
        $user->save();
        return redirect()->route('users.index')->with('success', 'Successfully updated');
    }

    public function destroy(User $user) {

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Successfully deleted');
    }
}
