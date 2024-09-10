<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Session;
use DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function user_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/|confirmed',
            'language' => 'required|in:en,de',
            'mobile' => 'nullable|digits:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = 'user';
        $user->password = Hash::make($request->input('password'));
        
        $user->language = $request->input('language');
        $user->mobile = $request->input('mobile');
        $user->save();

        $this->sendVerificationEmail($user);

        return redirect()->route('login')->with('success', 'Registration successful! Please verify your email.');
    }

    protected function sendVerificationEmail($user)
    {
        $verificationLink = route('verify.email', ['id' => $user->id, 'token' => base64_encode($user->email)]);
        
        $emailTemplate = $user->language == 'en' ? 'emails.verify_en' : 'emails.verify_de';
        $emailSubject = $user->language == 'en' ? 'Verify your email' : 'E-Mail-Adresse bestätigen';

        Mail::send($emailTemplate, ['user' => $user, 'verificationLink' => $verificationLink], function($message) use ($user, $emailSubject) {
            $message->to($user->email);
            $message->subject($emailSubject);
        });
    }




    public function verifyEmail($id, $token)
    {
      $user = User::find($id);
      if ($user && base64_decode($token) === $user->email) {
          $user->email_verified_at = now();
          $user->save();
          return redirect()->route('login')->with('success', 'Email verified successfully.');
      }
      return redirect()->route('login')->with('error', 'Invalid verification link.');
  }

  
  public function getUserInfo(Request $request)
  {
      $request->validate([
          'username' => 'required|email',
      ]);

      $user = User::where('email', $request->input('username'))->first();

      if (!$user) {
          return response()->json(['error' => 'User not found'], 404);
      }
      
      return response()->json([
          'name' => $user->name,
          'username' => $user->email,
          'language' => $user->language,
          'mobile' => $user->mobile,
      ]);
  }
    
}

