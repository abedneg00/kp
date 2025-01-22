<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**  
     * Where to redirect users after registration.  
     *  
     * @var string  
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**  
     * Create a new controller instance.  
     *  
     * @return void  
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**  
     * Get a validator for an incoming registration request.  
     *  
     * @param  array  $data  
     * @return \Illuminate\Contracts\Validation\Validator  
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,kasir'],
        ]);
    }

    /**  
     * Create a new user instance after a valid registration.  
     *  
     * @param  array  $data  
     * @return \App\Models\User  
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**  
     * Handle a registration request for the application.  
     *  
     * @param  \Illuminate\Http\Request  $request  
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse  
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Redirect to the login page after registration  
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}
