<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function login(Request $request)
    {
        try {
            //Validate input
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            //checking credential login
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
            //if hash not success
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('invalid credentials');
            }
            //if success login
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => "Something Went Wrong",
                'error' => $error,
            ], 'Authenticated Failed', 500);
        }
    }

    public function register(UserRequest $request)
    {
        try {
            // $request->validate([
            //     'name' => ['required', 'string', 'max:255'],
            //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => $this->passwordRules()
            // ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'houseNumber' => $request->houseNumber,
                'phoneNumber' => $request->phoneNumber,
                'city' => $request->city,
                'password' => Hash::make($request->password),
            ]);
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $token,
                'token_type' => 'bearer',
                'User' => $user
            ]);
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => 'something when wrong',
                'error' => $e,
            ], 'authentication failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $stats = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($stats, 'Token Revoked');
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $user = Auth::user();
            $user->update($data);
            return ResponseFormatter::success($user, 'updated success');
        } catch (Exception $e) {
        }
    }

    public function profile(Request $request)
    {
    
        return ResponseFormatter::success($request->user(), 'profile data');
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'file' =>'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error'=> $validator->errors()
            ], 'Update photo failed', 401);
        }

        if ($request->file('fille')) {
            $file = $request->file->storeAs('assets/user', $user->name, 'public');

            $user->profile_photo_path = $file;
            $user->update();

            return ResponseFormatter::success([$file], 'Success upload file');
        }


    }
}
