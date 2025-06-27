<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:ressource')->except('logout');
        
        $this->middleware('guest:comptable')->except('logout');
        $this->middleware('guest:commercial')->except('logout');
        $this->middleware('guest:magasinier')->except('logout');
        $this->middleware('guest:logistique')->except('logout');
    }

    //admin
        public function adminLogin()
        {
            return view('auth.login-admin', ['url' => route('admin.loginpost')]);
        }
        public function adminLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('admin')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('admin.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //logistique
        public function logistiqueLogin()
        {
            return view('auth.login-logistique', ['url' => route('logistique.loginpost')]);
        }
        public function logistiqueLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('logistique')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('logistique.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //commercial
        public function commercialLogin()
        {
            return view('auth.login-commercial', ['url' => route('commercial.loginpost')]);
        }
        public function commercialLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('commercial')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('commercial.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //comptable
        public function comptableLogin()
        {
            return view('auth.login-comptable', ['url' => route('comptable.loginpost')]);
        }
        public function comptableLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('comptable')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('comptable.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //magasinier
        public function magasinierLogin()
        {
            return view('auth.login-magasinier', ['url' => route('magasinier.loginpost')]);
        }
        public function magasinierLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('magasinier')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('magasinier.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //ressource
        public function ressourceLogin()
        {
            return view('auth.login-ressource', ['url' => route('ressource.loginpost')]);
        }
        public function ressourceLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);


            $logged = Auth::guard('ressource')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('ressource.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //
}
