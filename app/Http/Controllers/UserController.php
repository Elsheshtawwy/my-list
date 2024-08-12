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
        if ($user == null) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
        return response()->json([
            'data' => $user
        ]);
    }

    public function search(Request $request) {
        // Get the search query from the request
        $query = $request->input('query');
        // Find users by name or email containing the search query
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();
        // Return the users found
        return response()->json([
            "users" => $users
        ]);
    }
    
    public function destroy($id) {
        // Find the user by id
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    
        // Delete the user
        $user->delete();
    
        // Return success message
        return response()->json([
            "message" => "User deleted successfully"
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
            "message" => "User updated successfully",
            "user" => $user
        ]);
    }
}

