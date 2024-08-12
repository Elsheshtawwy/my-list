<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        // Collect all users in a variable named users
        $users = User::all();
        // Return all client response
        return response()->json([
            "users" => $users
        ]);
    }

    public function store(Request $request){
        // Validate the input data
        $input = $request->validate([
            "name" => ['string', "required"],
            "email" => ["string", "email:rfc,dns", "required", "unique:users,email"],
        ]);
        // Store the user in the database
        User::create($input);
        // Return a message to the client
        return response()->json([
            "message" => "Well done :)"
        ]);
    }

    public function show($id){
        // Find the user by id
        $user = User::find($id);
        return response()->json([
            'data' => $user
        ]);
    }
    
    public function destroy($id) {
        // Find the user by id
        $user = User::findOrFail($id);
        // Delete the user
        $user->delete();
        // Return success message
        return response()->json([
            "message" => "User deleted successfully ;)"
        ]);
    }

    public function update(Request $request, $id) {
        // Validate the input data
        $input = $request->validate([
            "name" => ['string'],
            "email" => ["string", "email:rfc,dns", Rule::unique("users", "email")->ignore($id)],
        ]);
        // Find the user by id
        $user = User::findOrFail($id);
        // Update the user in the database
        $user->update($input);
        // Return success message
        return response()->json([
            "message" => "User updated successfully ;)",
            "user" => $user
        ]);
    }
}

