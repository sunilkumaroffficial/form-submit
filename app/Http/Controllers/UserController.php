<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Function to submit the user data
    public function store(Request $request)
    {
        // Validate the all the user data received from the client side
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/',
            'description' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if any field missing the required validation return the error
        if ($validator->fails()) {
            // Format and combine all error messages into a single string
            $stringError = implode("<br>", array_map(function ($messages) {
                return $messages[0]; // Take the first error message only
            }, $validator->errors()->toArray()));

            $errors = [
                'status' => 'ERROR',
                'message' => 'Validation Error',
                'errors' => $stringError
            ];

            return response()->json($errors, 400);
        }

        // Retrieve all the data from the request
        $userData = $request->all();

        // Check if profile available then store in the profile directory with in the public directory
        if ($request->hasFile('profile')) {
            $userData['profile'] = $request->file('profile')->store('profile', 'public');
        }

        $user = User::create($userData);

        // Return the success response on successfull user creation
        return response()->json(['status' => 'OK', 'message' => "User {$user->id} created successfully!"], 200);
    }

    // Function to get the all users with their roles
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
}