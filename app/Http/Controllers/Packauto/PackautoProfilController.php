<?php

namespace App\Http\Controllers\Packauto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PackautoProfilController extends Controller
{
    public function profil()
    {
        return view('dashboard.packauto.profil.profil');
    }
    public function profilUpdate(Request $request)
    {
        //données
            $password = auth()->user()->password;
            $photo = auth()->user()->photo;
        //
        
        $this->validate($request, [
            'contact'   => 'required|unique:rpackautos,contact,' . auth()->user()->id . '|min:8|max:12',
            'email'   => 'required|email|unique:rpackautos,email,' . auth()->user()->id . '|min:8',
            'nom'   => 'required|min:2',
            'prenom'   => 'required|min:2',
            'identifiant'   => 'required|min:4',
        ]);
        // dd(1);
        
        if(!empty($request->password))
        {
            $this->validate($request, [
                'password'   => 'required|min:5',
            ]);

            $password = Hash::make($request->password);
        }

        if (!empty($request->photo))
        {
            $this->validate($request, [
                'photo' => 'required|mimes:png,jpg,jpeg',
            ]);

            // Sauvegarde de photo
            if(auth()->user()->photo) { Storage::disk('public')->delete(auth()->user()->photo); }
            $photo = storeImage($request->file('photo'), "PackautoPhoto");
        }

        auth()->user()->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact,
            'email' => $request->email,
            'photo' => $photo,
            'identifiant' => $request->identifiant,
            'password' => $password
        ]);

        return back()->with('success','Profil modifié avec success');
    }
}
