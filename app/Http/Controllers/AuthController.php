<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(){
        return view('auth.login');
      }

      public function user_register(){
        return view('auth.register');
      }

        public function login(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json(['error'=> true, 'message'=>'Unauthorized'], 401);
        }
        $user = Auth::user();
        if (!$user->email_verified_at) {
            return response()->json(['error' => true, 'message'=>'Account not verified'], 403);
        }

        if ($user->status == "0") {
            return response()->json(['error' => true, 'message'=>'You are Disable by Admin'], 403);
        }

        return response()->json([
            'token' => $token,
            'message' => 'Login successful',
        ]);
    }


        public function dashboard_view(Request $request)
    {
        try {
            $token = $request->query('token');

            if (!$token) {
                return response()->json(['error' => 'Token not provided'], 401);
            }
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();
            if ($user->role == "user") {
                App::setLocale($user->language);
                $labels = trans('dashboard');
                return view('dashboard', compact('user', 'labels')); 
            } elseif ($user->role == "admin") {
                $alluser = User::where('role', 'user')->paginate(10);
                return view('dashboard', compact('alluser')); 
            }

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token error: ' . $e->getMessage()], 401);
        }
    }

        public function logout()
        {
            return redirect()->route('login')->with('success','logout successfully');
        }

        public function edit_user($id){
            $user=User::find($id);
            if($user){
            return view('auth.useredit',compact('user'));
            }
            return redirect()->back()->with('error','Something Went Wrong');
        }
    

        public function user_update(Request $request)
        {
            try {

                $validator = Validator::make($request->all(), [
                    'user_id' => 'required|integer|exists:users,id',
                    'status' => 'required|in:0,1',
                ]);
            

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
        

                $user = User::findOrFail($request->user_id);
                $user->status = $request->status;
                $user->save();
                return redirect()->route('dashboard.view', ['token' => $request->token])
                ->with('success', 'Status updated successfully.');
            } catch (\Exception $e) {
                \Log::error('Error updating user: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to update user status. Please try again.');
            }
        }

}
