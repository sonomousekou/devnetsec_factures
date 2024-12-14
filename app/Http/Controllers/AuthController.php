<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
    * Affiche le formulaire de connexion.
    *
    * @return \Illuminate\View\View
    */
   public function showLoginForm()
   {
       return view('auth.login'); 
   }

   /**
    * Gère la tentative de connexion.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function login(Request $request)
   {
       // Validation des données de connexion
       $credentials = $request->validate([
           'email' => ['required', 'email'],
           'password' => ['required'],
       ]);

        // Valider les données d'entrée
        // $credentials = $request->only('email', 'password');

        // Si l'option "Remember me" est cochée, ajouter l'option `true`
        $remember = $request->has('remember');

       // Tentative de connexion
       if (Auth::attempt($credentials, $remember)) {
           // Redirection après connexion réussie
           $request->session()->regenerate();
           return redirect()->route('profile');
       }

       // Retour en cas d'échec
       return back()->withErrors([
           'email' => 'Les informations d’identification ne correspondent pas.',
       ])->onlyInput('email');
   }

   /**
    * Gère la déconnexion de l'utilisateur.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function logout(Request $request)
   {
       Auth::logout();

       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect('/'); // Remplacez "/" par votre route après déconnexion
   }

       /**
    * Affiche le formulaire de register.
    *
    * @return \Illuminate\View\View
    */
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }


    /**
     * Fonction pour enregistrer un nouvel utilisateur
     */
    public function register(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            'password' => 'required|string|min:4',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->intended('/login'); 

        // Retourner une réponse
        return response()->json(['message' => 'Utilisateur enregistré avec succès!'], 201);
    }

    /* Afficher le profil de l'utilisateur connecté.
    *
    * @return \Illuminate\View\View
    */
   public function profile()
   {
       // Récupérer l'utilisateur authentifié
       $user = Auth::user();

       // Retourner la vue du profil avec les informations de l'utilisateur
       return view('auth.profile', compact('user'));
   }

   
}
