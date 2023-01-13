<?php

namespace App\Http\Controllers;

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
    use HasApiTokens, Notifiable;
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|max:20'
        ]);

        $result = $request->all();
        $create = $this->create($result);

        return redirect('showLogin')->withSuccess('Successful');
    }

    public function create(array $save)
    {
        return user::create([
            'name' => $save['name'],
            'email' => $save['email'],
            'password' => Hash::make($save['password']),
            'remember_token' => Str::random(60)
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7|max:20'
        ]);

        $loginCredentials = $request->only('email', 'password');
        if (!(Auth::attempt($loginCredentials))) {
            return response(['message' => 'Wrong credentials']);
        }

        $user = Auth::user();
        $user_id = $user->id;
        $data = User::where('id', $user_id)->get();
        //$token = Auth::user()->createToken('Token')->accessToken;
        //$token = Auth::user()->createToken('Token')->accessToken;
        $capsule = array('data' => $data);
        $response = Response::view('home')->header('Content-Type', $capsule);
        return $response;

        /*
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:7|max:20'
        ]);

        $user = User::where('email', '=', $request->email)->first();
       

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId',$user->id);
                return redirect('home')->with($capsule);
            } else {
                return back()->with('fail', 'Password is incorrect');
            }
        } else {
            return back()->with('fail', 'Email is not registered');
        }
        */
    }


    public function showRegister()
    {
        return view('register');
    }
    public function showLogin()
    {
        return view('login');
    }
}
