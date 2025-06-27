<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Ressource\RessourceProfilController;
use App\Http\Controllers\Ressource\RessourceEmployeController;
use App\Http\Controllers\Principale\PdfDevisCommandePageController;
use App\Http\Controllers\Ressource\RessourceEmployeContratController;
use App\Http\Controllers\Ressource\RessourceEmployeDocumentController;

//admin
    use App\Http\Controllers\Admin\AdminPageController;
//
//Ressource
    use App\Http\Controllers\Ressource\RessourcePageController;
//
//commercial
    use App\Http\Controllers\Commercial\CommercialPageController;
    use App\Http\Controllers\Commercial\CommercialClientController;
    use App\Http\Controllers\Commercial\CommercialProfilController;
    use App\Http\Controllers\Commercial\CommercialDevisController;
    use App\Http\Controllers\Commercial\CommercialCommandeController;
    use App\Http\Controllers\Commercial\CommercialParticulierController;
    use App\Http\Controllers\Commercial\CommercialController;
//
//Magasinier
    use App\Http\Controllers\Magasinier\MagasinierPageController;
    use App\Http\Controllers\Magasinier\MagasinierProduitController;
    use App\Http\Controllers\Magasinier\MagasinierCategorieController;
    use App\Http\Controllers\Magasinier\MagasinierStockProduitController;
    use App\Http\Controllers\Magasinier\MagasinierProfilController;
    use App\Http\Controllers\Magasinier\MagasinierCommandeController;
//
//Comptable
    use App\Http\Controllers\Comptable\ComptablePageController;
    use App\Http\Controllers\Comptable\ComptableProfilController;
    use App\Http\Controllers\Comptable\ComptableCommandeController;
//
//Logistique
    use App\Http\Controllers\Logistique\LogistiquePageController;
//

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Authentification
    // Admin login
        Route::get('/responsable', [LoginController::class, 'adminLogin'])->name('admin.login');
        Route::post('/login/admin/post',[LoginController::class, 'adminLoginPost'])->name('admin.loginpost');
    //
    // Admin vice login
        Route::get('/ressource', [LoginController::class, 'ressourceLogin'])->name('ressource.login');
        Route::post('/login/ressource/post',[LoginController::class, 'ressourceLoginPost'])->name('ressource.loginpost');
    //
    // Admin login
        Route::get('/comptable', [LoginController::class, 'comptableLogin'])->name('comptable.login');
        Route::post('/login/comptable/post',[LoginController::class, 'comptableLoginPost'])->name('comptable.loginpost');
    //
    // Admin login
        Route::get('/commercial', [LoginController::class, 'commercialLogin'])->name('commercial.login');
        Route::post('/login/commercial/post',[LoginController::class, 'commercialLoginPost'])->name('commercial.loginpost');
    //
    // Admin login
        Route::get('/magasinier', [LoginController::class, 'magasinierLogin'])->name('magasinier.login');
        Route::post('/login/magasinier/post',[LoginController::class, 'magasinierLoginPost'])->name('magasinier.loginpost');
    //
    // Logistique login logistique
        Route::get('/', [LoginController::class, 'logistiqueLogin'])->name('logistique.login');
        Route::post('/loginlLogistique/post',[LoginController::class, 'logistiqueLoginPost'])->name('logistique.loginpost');
    //
//

//pdf devis commande
    Route::get('/pdf/devis/commande/particulier/{particulierdevis}', [PdfDevisCommandePageController::class, 'pdfDevisCommandeParticulier'])->name('pdf.devis.commande.particulier');
    Route::get('/pdf/devis/commande/client/{clientdevis}', [PdfDevisCommandePageController::class, 'pdfDevisCommandeClient'])->name('pdf.devis.commande.client');
//

//Admin pages
    Route::prefix('/admin/dashboard')->middleware('auth:admin')->name('admin.')->group(function(){
        Route::post('/logout', [AdminPageController::class, 'logout'])->name('logout');
        Route::get('/home' , [AdminPageController::class,'home'])->name('home');
        Route::get('/homes' , [AdminPageController::class,'homes'])->name('homes');

        //
        //
    });
//

//logistique pages
    Route::prefix('/logistique/dashboard')->middleware('auth:logistique')->name('logistique.')->group(function(){
        Route::get('/home' , [LogistiquePageController::class,'home'])->name('home');
        Route::post('/logout', [LogistiquePageController::class, 'logout'])->name('logout');
    });
//

//ressource pages
    Route::prefix('/ressource/humaine/dashboard')->middleware('auth:ressource')->name('ressource.')->group(function(){
        Route::get('/home' , [RessourcePageController::class,'home'])->name('home');
        Route::post('/logout', [RessourcePageController::class, 'logout'])->name('logout');
        
        //employe
            Route::resource('/employe', RessourceEmployeController::class);

            Route::resource('/employedoc', RessourceEmployeDocumentController::class)->except(['store']);
            Route::post('/employedoc/store/{employe}', [RessourceEmployeDocumentController::class, 'store'])->name('employedoc.store');

            Route::resource('/employecontrat', RessourceEmployeContratController::class)->except(['store']);
            Route::post('/employecontrat/store/{employe}', [RessourceEmployeContratController::class, 'store'])->name('employecontrat.store');
        //  

        //profil
            Route::get('/mon/profil' , [RessourceProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [RessourceProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//magasinier pages
    Route::prefix('/magasinier/dashboard')->middleware('auth:magasinier')->name('magasinier.')->group(function(){
        Route::get('/home' , [MagasinierPageController::class,'home'])->name('home');
        Route::post('/logout', [MagasinierPageController::class, 'logout'])->name('logout');

        //categorie
            Route::resource('/categorie', MagasinierCategorieController::class);
            Route::get('/entrepôt/produit/{categorie}' , [MagasinierCategorieController::class,'categorieProduit'])->name('categorie.produit');
        //
        //produit
            Route::resource('/produit', MagasinierProduitController::class);
        //
        //stock
            Route::get('/Stock/des/produits/{categorie}', [MagasinierStockProduitController::class, 'StockProduitUn'])->name('stock.global.produit');
            Route::post('/quantite/produit/update/{produit}', [MagasinierStockProduitController::class, 'quantiteProduitUpdate'])->name('quantite.produit.update');
            Route::get('/entrées/sorties/produits', [MagasinierStockProduitController::class, 'StockProduitDeux'])->name('stock.global.produit.deux');
        //
        //commande
            //client
                Route::get('/commande/client/validés' , [MagasinierCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
                Route::get('/commande/client/livrés' , [MagasinierCommandeController::class,'commandeClientLivre'])->name('commande.client.livre');
                Route::get('/commande/client/detail/{clientdevis}' , [MagasinierCommandeController::class,'commandeClientDetail'])->name('commande.client.detail');
                Route::post('/confirme/livraison/commande/client/{clientdevis}' , [MagasinierCommandeController::class,'confirmeLivraisonCommandeClient'])->name('confirme.livraison.commande.client');
            //
            //particulier (entreprise)
                Route::get('/commande/entreprise/validés' , [MagasinierCommandeController::class,'commandeParticulierValide'])->name('commande.particulier.valide');
                Route::get('/commande/entreprise/livrés' , [MagasinierCommandeController::class,'commandeParticulierLivre'])->name('commande.particulier.livre');
                Route::get('/commande/entreprise/detail/{particulierdevis}' , [MagasinierCommandeController::class,'commandeParticulierDetail'])->name('commande.particulier.detail');
                Route::post('/confirme/livraison/commande/entreprise/{particulierdevis}' , [MagasinierCommandeController::class,'confirmeLivraisonCommandeParticulier'])->name('confirme.livraison.commande.particulier');
            //
        //
        //profil
            Route::get('/mon/profil' , [MagasinierProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [MagasinierProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//comptable pages
    Route::prefix('/comptable/dashboard')->middleware('auth:comptable')->name('comptable.')->group(function(){
        Route::get('/home' , [ComptablePageController::class,'home'])->name('home');
        Route::post('/logout', [ComptablePageController::class, 'logout'])->name('logout');
        
        //commande
            //client
                Route::get('/commande/client/encours' , [ComptableCommandeController::class,'commandeClientEncours'])->name('commande.client.encours');
                Route::get('/commande/client/validés' , [ComptableCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
                Route::get('/commande/client/refusés' , [ComptableCommandeController::class,'commandeClientRefuse'])->name('commande.client.refuse');
                Route::get('/commande/client/detail/{clientdevis}' , [ComptableCommandeController::class,'commandeClientDetail'])->name('commande.client.detail');

                Route::post('/rejet/commande/client/store/{clientdevis}' , [ComptableCommandeController::class,'rejetCommandeClientStore'])->name('rejet.commande.client.store');
                Route::get('/annuler/rejet/commande/client/{clientdevis}' , [ComptableCommandeController::class,'annulerRejetCommandeClient'])->name('annuler.rejet.commande.client');
                Route::post('/valider/commande/client/store/{clientdevis}' , [ComptableCommandeController::class,'validerCommandeClientStore'])->name('valider.commande.client.store');
            //
            //particulier (entreprise)
                Route::get('/commande/entreprise/encours' , [ComptableCommandeController::class,'commandeParticulierEncours'])->name('commande.particulier.encours');
                Route::get('/commande/entreprise/validés' , [ComptableCommandeController::class,'commandeParticulierValide'])->name('commande.particulier.valide');
                Route::get('/commande/entreprise/refusés' , [ComptableCommandeController::class,'commandeParticulierRefuse'])->name('commande.particulier.refuse');
                Route::get('/commande/entreprise/detail/{particulierdevis}' , [ComptableCommandeController::class,'commandeParticulierDetail'])->name('commande.particulier.detail');

                Route::post('/rejet/commande/particulier/store/{particulierdevis}' , [ComptableCommandeController::class,'rejetCommandeParticulierStore'])->name('rejet.commande.particulier.store');
                Route::get('/annuler/rejet/commande/particulier/{particulierdevis}' , [ComptableCommandeController::class,'annulerRejetCommandeParticulier'])->name('annuler.rejet.commande.particulier');
                Route::post('/valider/commande/particulier/store/{particulierdevis}' , [ComptableCommandeController::class,'validerCommandeParticulierStore'])->name('valider.commande.particulier.store');
            //
        //

        //profil
            Route::get('/mon/profil' , [ComptableProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [ComptableProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//commercial pages
    Route::prefix('/commercial/dashboard')->middleware('auth:commercial')->name('commercial.')->group(function(){
        Route::get('/home' , [CommercialPageController::class,'home'])->name('home');
        Route::post('/logout', [CommercialPageController::class, 'logout'])->name('logout');

        //client
            Route::resource('/client', CommercialClientController::class);
        //

        //devis 
            //client
                Route::get('/devis/client/create/etape1' , [CommercialDevisController::class,'devisClientCreate'])->name('devis.client.create');
                Route::post('/devis/client/store/etape1' , [CommercialDevisController::class,'devisClientStore'])->name('devis.client.store');
                Route::get('/devis/client/create/etape2/{clientdevis}' , [CommercialDevisController::class,'devisClientCreateDeux'])->name('devis.client.create.deux');
                Route::post('/devis/client/store/etape2/{clientdevis}/{produit}' , [CommercialDevisController::class,'devisClientStoreDeux'])->name('devis.client.store.deux');
                
                Route::post('/produit/devis/qty/update/{clientdevisprod}' , [CommercialDevisController::class,'devisProduitQtyUpdate'])->name('produit.devis.qty.update');
                Route::get('/produit/devis/destroy/{clientdevisprod}' , [CommercialDevisController::class,'devisProduitDestroy'])->name('produit.devis.destroy');
            //
            Route::patch('/devis/produit/prix/update/{produit}' , [CommercialDevisController::class,'devisProduitPrixUpdate'])->name('devis.produit.prix.update');
            //particulier (entreprise)
                Route::get('/devis/entreprise/create/etape1' , [CommercialDevisController::class,'devisParticulierCreate'])->name('devis.particulier.create');
                Route::post('/devis/entreprise/store/etape1' , [CommercialDevisController::class,'devisParticulierStore'])->name('devis.particulier.store');
                Route::get('/devis/entreprise/create/etape2/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierCreateDeux'])->name('devis.particulier.create.deux');
                Route::post('/devis/entreprise/store/etape2/{particulierdevis}/{produit}' , [CommercialDevisController::class,'devisParticulierStoreDeux'])->name('devis.particulier.store.deux');
                Route::post('/produit/devis/entreprise/qty/update/{particulierdevisprod}' , [CommercialDevisController::class,'devisParticulierProduitQtyUpdate'])->name('produit.devis.particulier.qty.update');
                Route::get('/produit/devis/entreprise/destroy/{particulierdevisprod}' , [CommercialDevisController::class,'devisParticulierProduitDestroy'])->name('produit.devis.particulier.destroy');  
            //
            //historique
                //devis
                    Route::get('/devis/client/encours' , [CommercialDevisController::class,'devisClientEncours'])->name('devis.client.encours');
                    Route::get('/devis/client/finalite/{clientdevis}' , [CommercialDevisController::class,'devisClientFinalite'])->name('devis.client.finalite');
                    Route::patch('/devis/client/update/{clientdevis}' , [CommercialDevisController::class,'devisClientUpdate'])->name('devis.client.update');
                    Route::delete('/devis/client/destroy/{clientdevis}' , [CommercialDevisController::class,'devisClientDestroy'])->name('devis.client.destroy');
                    Route::get('/devis/client/convertir/update/{clientdevis}' , [CommercialDevisController::class,'devisClientConvertirUpdate'])->name('devis.client.convertir.update');
                //
                //particulier (entreprise)
                    Route::get('/devis/entreprise/encours' , [CommercialDevisController::class,'devisParticulierEncours'])->name('devis.particulier.encours');
                    Route::get('/devis/entreprise/finalite/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierFinalite'])->name('devis.particulier.finalite');
                    Route::patch('/devis/entreprise/update/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierUpdate'])->name('devis.particulier.update');
                    Route::delete('/devis/entreprise/destroy/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierDestroy'])->name('devis.particulier.destroy');
                    Route::get('/devis/entreprise/convertir/update/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierConvertirUpdate'])->name('devis.particulier.convertir.update');
                //
            //
        //







        //commercial
            Route::resource('/commercial', CommercialController::class);
        //
        //particulier (entreprise)
            Route::resource('/particulier', CommercialParticulierController::class);
        //
        //profil
            Route::get('/mon/profil' , [CommercialProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [CommercialProfilController::class, 'profilUpdate'])->name('profil.update');
        //
        //Historique remise
            Route::get('/Client/remise' , [CommercialPageController::class,'clientRemise'])->name('client.remise');
            Route::patch('/Particulier/remise', [CommercialPageController::class, 'particulierRemise'])->name('particulier.remise');
        //
        //Statistique
            Route::get('/statistique' , [CommercialPageController::class,'statistique'])->name('statistique');
        //
        //stock
            Route::get('/Stock/des/produits/{categorie}', [CommercialPageController::class, 'StockProduit'])->name('stock.global.produit');
        //
        //rapport
            Route::get('/mon/indicateur/de/performance' , [CommercialPageController::class,'rapport'])->name('rapport');
        //
        //commande
            //client
                Route::get('/commande/client/encours' , [CommercialCommandeController::class,'commandeClientEncours'])->name('commande.client.encours');
                Route::get('/commande/client/validés' , [CommercialCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
                Route::get('/commande/client/refusés' , [CommercialCommandeController::class,'commandeClientRefuse'])->name('commande.client.refuse');
            //
            //particulier (entreprise)
                Route::get('/commande/entreprise/encours' , [CommercialCommandeController::class,'commandeParticulierEncours'])->name('commande.particulier.encours');
                Route::get('/commande/entreprise/validés' , [CommercialCommandeController::class,'commandeParticulierValide'])->name('commande.particulier.valide');
                Route::get('/commande/entreprise/refusés' , [CommercialCommandeController::class,'commandeParticulierRefuse'])->name('commande.particulier.refuse');
            //
        //
        
            // Route::resource('/devis', CommercialDevisController::class);//->except(['create','store']);
            // Route::get('/devis/create/deux/{clientdevis}' , [CommercialDevisController::class,'devisCreateDeux'])->name('devis.create.deux');
            // Route::post('/devis/store/deux/{clientdevis}/{produit}' , [CommercialDevisController::class,'devisStoreDeux'])->name('devis.store.deux');

    });
//