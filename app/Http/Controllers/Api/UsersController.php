<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Passport;

class UsersController extends Controller
{
    //Test
    public function index()
    {
        return 'UsersController';
    }

    public function responseMessage($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function errorMessage($error, $errorMessage = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }

    //register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|max:20',
        ]);

        if ($validator->fails()) {
            return $this->errorMessage('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->responseMessage($success, 'User registered successfully.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')-> accessToken;
            $success['name'] = $user->name;
            return $this->responseMessage($success, 'Logged In Successfully.');
        }
        else {
            return $this->errorMessage('Unauthorised', ['error' => 'Unauthorised']);
        }
    }
}
