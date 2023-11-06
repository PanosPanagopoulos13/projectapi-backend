<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        // Validation has passed, so we can continue to create the user
        $user = new User();
        $user->name = $request->input('fullname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Return a response indicating success
        $response = [
            'success' => true,
            'message' => 'User created successfully.',
            'data' => $user,
        ];
        return response()->json($response, 201);
    }

    public function get($id)
    {
        try {
            $user = User::findOrFail($id);
            $response = [
                'success' => true,
                'message' => 'User found.',
                'data' => $user,
            ];
            return response()->json($response, 201);
        }catch (Exception $ex){
            $response = [
                'success' => false,
                'message' => 'User not found.',
                // 'debug' => $ex->getMessage(),
            ];
            return response()->json($response, 404);
        }
    }
}
