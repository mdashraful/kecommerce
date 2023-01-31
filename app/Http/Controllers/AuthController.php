<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\RegistrationEmailNotification;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function processLogin()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = request()->only(['email', 'password']);

        if(auth()->attempt($credentials)){

            if(auth()->user()->email_verified_at == null){
                $this->setError('Your account is not activated.');

                return redirect()->redirect('login');
            }

            $this->setSuccess('User Logged in.');

            return redirect()->intended();
        }
        $this->setError('Invalid Credentials');
        return redirect()->back();
    }

    public function showRegisterForm ()
    {
        return view('frontend.auth.register');
    }

    public function processRegister (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:11|max:13|unique:users,phone_number',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $validated['password'] = bcrypt($request->password);
        $validated['email_verification_token'] = uniqid(time(), true).Str::random(16);

        try {
            $user = User::create($validated);

            $user->notify(new RegistrationEmailNotification($user));

            session()->flash('type', 'success');
            $this->setSuccess('Account registered');

            return redirect()->route('login');
        }catch(\Exception $e) {
            $this->setError($e->getMessage()); 
            
            return redirect()->back();
        }              
    }

    public function activate($token = null)
    {
        if ($token == null) {
            return redirect('/');
        }

        $user = User::where('email_verification_token', $token)->firstOrFail();

        if($user) {
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);

            $this->setSuccess('Account activate, You can login now');
            return redirect()->route('login');
        }
        $this->setError('Invalid token.');
        return redirect()->route('login');        
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
