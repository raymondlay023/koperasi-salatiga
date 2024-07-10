<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function indexowner()
    {
        $roles = Role::all();
        return view('users.index', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role_id' => 'required|integer|in:1,2,3,4'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'User created successfully!');
        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the user. Please try again.');
        } catch (\Exception $e) {
            Log::error('Unexpected error: '.$e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found!');
        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the user. Please try again.');
        } catch (\Exception $e) {
            Log::error('Unexpected error: '.$e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function resetPassword($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['password' => Hash::make('koperasisalatiga1234')]);

            return redirect()->back()->with('success', 'User password reset successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found!');
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while resetting the password.');
        }
    }
}
