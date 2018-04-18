<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
Use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
  


    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
      
        $userAuth = User::where('email',$user->getEmail())->first();
       
        if($userAuth)
        {
            
         Auth::login($userAuth);
             return redirect('/');

        }
           

else
{
         $password = bcrypt(str_random(10));

           $newUser=User::create([
            'name' => $user->getNickName(),
            'email' => $user->getEmail(),
            'password' =>$password]);
           
            Auth::login($newUser);
             return redirect('/');
            
    
}
}
}
