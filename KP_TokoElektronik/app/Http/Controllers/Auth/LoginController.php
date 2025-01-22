<?php  
  
namespace App\Http\Controllers\Auth;  
  
use App\Http\Controllers\Controller;  
use Illuminate\Foundation\Auth\AuthenticatesUsers;  
use Illuminate\Http\Request;  
  
class LoginController extends Controller  
{  
    use AuthenticatesUsers;  
  
    /**  
     * Where to redirect users after login.  
     *  
     * @var string  
     */  
    protected $redirectTo = '/home'; // Default redirect  
  
    /**  
     * Create a new controller instance.  
     *  
     * @return void  
     */  
    public function __construct()  
    {  
        $this->middleware('guest')->except('logout');  
        $this->middleware('auth')->only('logout');  
    }  
  
    /**  
     * Handle a successful login.  
     *  
     * @param  Request  $request  
     * @param  mixed  $user  
     * @return \Illuminate\Http\RedirectResponse  
     */  
    protected function authenticated(Request $request, $user)  
    {  
        // Check the user's role  
        if ($user->role === 'kasir') {  
            return redirect()->route('transaction.index'); // Redirect to transaction.index for kasir  
        }  
  
        return redirect()->intended($this->redirectTo); // Default redirect for other roles  
    }  
}  
