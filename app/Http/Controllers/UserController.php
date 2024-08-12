<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        // collect all users on val name users
        $users = User::all();
        // return all clint res
        return response()->json(
            [
                "users"=> $users
            ]
            );
        
    }
    //



    public function store(Request $request){
            //validate the input data
            $input = $request->validate([
                "name"=> ['string' , "required"],
                "email"=> ["string",'email' => 'email:rfc,dns',"required","unique:users,email"],
            ]);
            //store the users on the database
            User::create($input);
            //return message to the clint
return response()->json([
    "message"=> " well done :) "
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
        // Find the user by id
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    
        // Validate the input data
        $input = $request->validate([
            "name" => ['string', "required"],
            "email" => ["string", 'email' => 'email:rfc,dns', "required", "unique:users,email," . $id],
        ]);
    
        // Update the user in the database
        $user->update($input);
    
        // Return success message
        return response()->json([
            "message" => "User updated successfully",
            "user" => $user
        ]);
    }
    
    
    
    
}

