<?php

namespace App\Http\Controllers\Admin\FonctionPersonnelle;

class FonctionPersonnelle
{
    public static function PageAccessibleAdmin()
    {
        if(!auth()->user()->role) 
        {
            if(auth()->user()->adminsecteur?->secteur_id !== null) 
            {
                return redirect()->route('admin.home')->with('error',"Désolé! vous n'êtes pas un superviseur ou super admin");
            } 

            if(auth()->user()->adminsecteur?->secteur_id === null && !auth()->user()->autorise) 
            {
                return redirect()->route('admin.home')->with('error',"Désolé! vous n'êtes pas un superviseur ou super admin");
            }
        } 
    }
}
