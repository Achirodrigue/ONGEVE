<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest:geststock')->except('logout');
        $this->middleware('guest:packauto')->except('logout');
        $this->middleware('guest:secretaire')->except('logout');
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
            // dd(5);
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
    
    //pack auto
        public function packautoLogin()
        {
            return view('auth.login-packauto', ['url' => route('packauto.loginpost')]);
        }
        public function packautoLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);

            $logged = Auth::guard('packauto')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('packauto.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //gestionnnaire stock
        public function geststockLogin()
        {
            return view('auth.login-geststock', ['url' => route('geststock.loginpost')]);
        }
        public function geststockLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);

            $logged = Auth::guard('geststock')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('geststock.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //

    //secretaire
        public function secretaireLogin()
        {
            return view('auth.login-secretaire', ['url' => route('secretaire.loginpost')]);
        }
        public function secretaireLoginPost(Request $request)
        {
            $this->validate($request, [
                'identifiant'   => 'required|min:4',
                'password' => 'required|min:4'
            ]);

            $logged = Auth::guard('secretaire')->attempt($request->only(['identifiant','password']));

            if ($logged){
                return redirect()->intended(route('secretaire.home'));
            }

            return back()->withInput($request->only('identifiant', 'remember'))->with('error','Coordonnées incorrects');
        }
    //
}
