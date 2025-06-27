<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Conseilastuce;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminConseilAstuceController extends Controller
{
    use ValidatesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conseilastuces = Conseilastuce::all();
        return view('dashboard.admin.conseil-astuce.all-conseil-astuce', compact('conseilastuces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.conseil-astuce.add-conseil-astuce');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre'   => 'required|min:3',
            'contenu'   => 'required|min:5',
            'type'   => 'required',
            'fichier' => 'mimes:png,jpg,jpeg,avi,mp3,mp4',
        ]);

        //données
            $fichier = null;
            $type = 0;
            if($request->type === "conseil"){$type = 1;}
        //

        if (isset($request->fichier))
        {
            if (!empty($request->fichier))
            {
                $this->validate($request, [
                    'fichier' => 'required|mimes:png,jpg,jpeg',
                ]);
                
                $filename = time() . '.' . $request->fichier->extension();
                $fichier = $request->file('fichier')->storeAs(
                    'AdminConseilAstuceFichier',
                    $filename,
                    'public'
                );
            }
        }

        $conseilastuce = Conseilastuce::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $type,
            'fichier' => $fichier,
        ]);

        return redirect()->route('admin.conseilastuce.index')->with('success', "$conseilastuce->titre ajouté avec succès");
    }

    /**
     * Display the specified resource.
    //  */
    // public function detailProduit(string $id)
    // { 
    //     $produit = Produit::findOrFail($id);
    //     return view('dashboard.admin.produit.detail-produit', compact('produit'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conseilastuce $conseilastuce)     //(string $id)
    {
        return view('dashboard.admin.conseil-astuce.edit-conseil-astuce', compact('conseilastuce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conseilastuce $conseilastuce)
    {
        $this->validate($request, [
            'titre'   => 'required|min:3',
            'contenu'   => 'required|min:5',
            'fichier' => 'mimes:png,jpg,jpeg,avi,mp3,mp4',
        ]);

        //données
            $noms = $conseilastuce->titre;
            $fichier = $conseilastuce->fichier;
        //


        if (!empty($request->fichier))
        {
            $this->validate($request, [
                'fichier' => 'required|mimes:png,jpg,jpeg,avi,mp3,mp4',
            ]);
            
            if($conseilastuce->fichier){ Storage::disk('public')->delete($conseilastuce->fichier); }

            $filename = time() . '.' . $request->fichier->extension();
            $fichier = $request->file('fichier')->storeAs(
                'AdminConseilAstuceFichier',
                $filename,
                'public'
            );
        }
        
        $conseilastuce->update([
            'fichier' => $fichier
        ]);

        $conseilastuce->update($request->post());

        return redirect()->route('admin.conseilastuce.index')->with('success', "$noms modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conseilastuce $conseilastuce)
    {
        $noms = $conseilastuce->titre;
        if($conseilastuce->fichier){ Storage::disk('public')->delete($conseilastuce->fichier); }
        $conseilastuce->delete();
        return back()->with('success', "$noms supprimé avec succès");
    }

}