<?php

// use App\Models\Fournisseur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comptable\ComptableController;
use App\Http\Controllers\Commun\CommunProduitController;

// //model
//     use App\Models\Logistique;
//     use App\Models\Magasinier;
// //
// //Fne
//     use App\Models\Facturefne;
//     use App\Services\FNEApiService;
// //
//Auth , Commun , Principale
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Commun\FournisseurController;
    use App\Http\Controllers\Commun\ProjetController;
    use App\Http\Controllers\Commun\CommunPageController;
    use App\Http\Controllers\Commun\ProjetTacheController;
    use App\Http\Controllers\Principale\PdfDevisCommandePageController;
//
//admin
    use App\Http\Controllers\Admin\AdminPageController;
    use App\Http\Controllers\Admin\AdminProfilController;
    use App\Http\Controllers\Admin\AdminClientController;
    use App\Http\Controllers\Admin\AdminDepenseController;
    use App\Http\Controllers\Admin\AdminCommandeController;
    use App\Http\Controllers\Admin\AdminFournisseurFactureController;
    
    use App\Http\Controllers\Admin\AdminComptableController;
    use App\Http\Controllers\Admin\AdminCommercialController;
    use App\Http\Controllers\Admin\AdminMagasinierController;
//
//Ressource
    use App\Http\Controllers\Ressource\RessourcePageController;
    use App\Http\Controllers\Ressource\RessourceProfilController;
    use App\Http\Controllers\Ressource\RessourceEmployesController;
    use App\Http\Controllers\Ressource\RessourceEmployeContratController;
    use App\Http\Controllers\Ressource\RessourceEmployeDocumentController;

    use App\Http\Controllers\Ressource\Colaborateur\RessourceEmployeController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourcePaieController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceCongeController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceProfileController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourcePaiementController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceDashboardController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceEntretienController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceDemandeDocumentController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourcePagesController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourcePresenceController;
    use App\Http\Controllers\Ressource\Colaborateur\RessourceVehiculeController;
//
//commercial
    use App\Http\Controllers\Commercial\CommercialPageController;
    use App\Http\Controllers\Commercial\CommercialClientController;
    use App\Http\Controllers\Commercial\CommercialProfilController;
    use App\Http\Controllers\Commercial\CommercialDevisController;
    use App\Http\Controllers\Commercial\CommercialCommandeController;
    use App\Http\Controllers\Commercial\CommercialParticulierController;
    use App\Http\Controllers\Commercial\CommercialController;
    use App\Http\Controllers\Commercial\newFonction\CommercialFactureClientController;
//
//Magasinier
    use App\Http\Controllers\Magasinier\MagasinierPageController;
    use App\Http\Controllers\Magasinier\MagasinierProduitController;
    use App\Http\Controllers\Magasinier\MagasinierCategorieController;
    use App\Http\Controllers\Magasinier\MagasinierStockProduitController;
    use App\Http\Controllers\Magasinier\MagasinierProfilController;
    use App\Http\Controllers\Magasinier\MagasinierCommandeController;
    use App\Http\Controllers\Magasinier\MagasinierFournisseurController;
    use App\Http\Controllers\Magasinier\MagasinierFournisseurFactureController;
//
//Comptable
    use App\Http\Controllers\Comptable\ComptablePageController;
    use App\Http\Controllers\Comptable\ComptableProfilController;
    use App\Http\Controllers\Comptable\ComptableCommandeController;
    use App\Http\Controllers\Comptable\ComptableSuiviTresorerieController;
    use App\Http\Controllers\Comptable\newFonction\ComptableFNEController;
    use App\Http\Controllers\Comptable\ComptableFournisseurFactureController;
    use App\Http\Controllers\Comptable\newFonction\ComptableDepenseController;
    use App\Http\Controllers\Comptable\newFonction\ComptableEtatCompteController;
    use App\Http\Controllers\Comptable\ComptableBilanController;
    use App\Http\Controllers\Comptable\ComptableClientController;
    use App\Http\Controllers\Comptable\newFonction\ComptableFournisseurFactureComptableController;   
//
//Geststock
    use App\Http\Controllers\Geststock\GeststockPageController; 
    use App\Http\Controllers\Geststock\GeststockProfilController;
    use App\Http\Controllers\Geststock\GeststockProduitController;
    use App\Http\Controllers\Geststock\GeststockCategorieController;
    use App\Http\Controllers\Geststock\GeststockStockProduitController;
    use App\Http\Controllers\Geststock\GeststockCommandeController;
    use App\Http\Controllers\Geststock\GeststockFournisseurController;
    use App\Http\Controllers\Geststock\GeststockFournisseurFactureController;
//
//Secretaire
    use App\Http\Controllers\Secretaire\SecretairePageController;
    use App\Http\Controllers\Secretaire\SecretaireProfilController;
//
//Packauto
    use App\Http\Controllers\Packauto\PackautoPageController;
    use App\Http\Controllers\Packauto\PackautoProfilController;
    use App\Http\Controllers\Packauto\PackautoVehiculeController;
    use App\Http\Controllers\Packauto\PackautoDemandeCarburantController;
use App\Http\Controllers\Commun\CommunEtablirFactureClientController;
use App\Http\Controllers\Commun\FournisseurFactureComptableController;
use App\Http\Controllers\Commun\reglage\CommunMoyenPaiementController;
use App\Http\Controllers\Comptable\reglage\ComptableDelaipayController;
use App\Http\Controllers\Geststock\GeststockCategorieProduitController;
use App\Http\Controllers\Geststock\GeststockEntrepotCategorieController;
use App\Http\Controllers\Comptable\newFonction\ComptableEtablirFactureClientController;

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
    // pack auto login
        Route::get('/packauto', [LoginController::class, 'packautoLogin'])->name('packauto.login');
        Route::post('/login/packauto/post',[LoginController::class, 'packautoLoginPost'])->name('packauto.loginpost');
    //
    // gestionnnaire stock login
        Route::get('/geststock', [LoginController::class, 'geststockLogin'])->name('geststock.login');
        Route::post('/login/geststock/post',[LoginController::class, 'geststockLoginPost'])->name('geststock.loginpost');
    //
    // secretaire login
        Route::get('/', [LoginController::class, 'secretaireLogin'])->name('secretaire.login');
        Route::post('/login/secretaire/post',[LoginController::class, 'secretaireLoginPost'])->name('secretaire.loginpost');
    //
//

//pdf et excel
    //pdf devis commande /{clientdevis}
        Route::get('/pdf/vente/{clientdevis}', [PdfDevisCommandePageController::class, 'pdfVente'])->name('pdf.devis.commande.client');
        Route::get('/pdf/location', [PdfDevisCommandePageController::class, 'pdfLocation'])->name('pdf.location');
        Route::get('/pdf/prestation', [PdfDevisCommandePageController::class, 'pdfPrestation'])->name('pdf.prestation');

        Route::get('/pdf/avoir/{clientdevisavoir}', [PdfDevisCommandePageController::class, 'pdfAvoir'])->name('pdf.avoir');
        Route::get('/pdf/bordereau/{clientdevis}', [PdfDevisCommandePageController::class, 'pdfBordereau'])->name('pdf.bordereau');
    //
    //excel
        //client
            Route::get('/client/facture/export', [ComptablePageController::class, 'clientFactureExport'])->name('client.facture.export');
            Route::get('/client/facture/individuel/export/{client}', [ComptablePageController::class, 'clientFactureIndividuelExport'])->name('client.facture.individuel.export');
            Route::get('/client/facture/general/export/{statut}', [ComptablePageController::class, 'clientFactureGeneralExport'])->name('client.facture.general.export');
            Route::get('/client/facture/general/export/CA/{statut}', [ComptablePageController::class, 'clientFactureGeneralCAExport'])->name('client.facture.general.CA.export');
        //
        //fournisseur
            Route::get('/fournisseur/facture/export', [ComptablePageController::class, 'fournisseurFactureExport'])->name('fournisseur.facture.export');
            Route::get('/fournisseur/facture/individuel/export/{fournisseur}/{statut}', [ComptablePageController::class, 'fournisseurFactureIndividuelExport'])->name('fournisseur.facture.individuel.export');
            Route::get('/fournisseur/facture/general/export/{statut}', [ComptablePageController::class, 'fournisseurFactureGeneralExport'])->name('fournisseur.facture.general.export');
        //
    //
//


//Commune pages
    Route::prefix('/commune/page')->name('commun.')->group(function(){
        //fournisseur
            Route::resource('/fournisseur', FournisseurController::class);
            Route::resource('/fournisseurfacturecomptable', FournisseurFactureComptableController::class);
            
            //Fournisseur facture add produit
                Route::post('/fournisseur/facture/add/produit/store/{fournisseurfacturecomptable}/{produit}' , [GeststockPageController::class,'fournisseurFactureAddProduitStore'])->name('fournisseur.facture.add.produit.store');
            //
        //

        //projet
            Route::resource('/projet', ProjetController::class);
            Route::resource('/projettache', ProjetTacheController::class);
            Route::post('/projet/tache/store/{projet}', [ProjetTacheController::class, 'projetTacheStore'])->name('projet.tache.store');
            Route::patch('/projet/tache/etat/update/{projet}', [ProjetTacheController::class, 'projetTacheEtatUpdate'])->name('projet.tache.etat.update');
        //

        //confirme livraison et transfert magasinier
            Route::get('/facture/transfert/magasinier/{clientdevis}', [CommunPageController::class, 'factureTransfertMagasinier'])->name('facture.transfert.magasinier');
            Route::get('/facture/confirme/livraison/{clientdevis}', [CommunPageController::class, 'factureConfirmeLivraison'])->name('facture.confirme.livraison');
            Route::get('/factures/location/livrees/confirme/retour/{clientdevis}', [GeststockPageController::class, 'factureLocationLivreConfirmeRetour'])->name('facture.location.livre.confirme.retour');
        //

        //presence
            Route::get('/formulaire/presence', [CommunPageController::class, 'formulairePresence'])->name('formulaire.presence');
            Route::post('/formulaire/presence/store', [CommunPageController::class, 'formulairePresenceStore'])->name('formulaire.presence.store');
        //

        //client etablir facture
            Route::post('/facture/client/store/etape2/{clientdevis}/{produit}' , [CommunEtablirFactureClientController::class,'factureClientStoreDeux'])->name('facture.client.store.deux');
            Route::post('/produit/facture/qty/update/{clientdevisprod}' , [CommunEtablirFactureClientController::class,'factureProduitQtyUpdate'])->name('produit.facture.qty.update');
            Route::get('/produit/facture/destroy/{clientdevisprod}' , [CommunEtablirFactureClientController::class,'factureProduitDestroy'])->name('produit.facture.destroy');

            //prestation
                Route::post('/clientdevis/prestation/store/{clientdevis}' , [CommunEtablirFactureClientController::class,'clientdevisPrestationStore'])->name('clientdevis.prestation.store');
                Route::post('/clientdevis/prestation/update/{clientdevisprestation}' , [CommunEtablirFactureClientController::class,'clientdevisPrestationUpdate'])->name('clientdevis.prestation.update');
                Route::delete('/clientdevis/prestation/destroy/{clientdevisprestation}' , [CommunEtablirFactureClientController::class,'clientdevisPrestationDestroy'])->name('clientdevis.prestation.destroy');
            //

            //Archiver
                Route::post('/archiver/clientdevis/{clientdevis}' , [CommunEtablirFactureClientController::class,'archiveClientdevis'])->name('archive.clientdevis');
            //
        //
    
        //client devis 
            Route::delete('/client/devis/destroy/{clientdevis}' , [CommunPageController::class,'ClientdevisDestroy'])->name('client.devis.destroy');
            Route::get('/client/devis/survole/plafond/achat/{clientdevis}' , [CommunEtablirFactureClientController::class,'ClientdevisSurvolePlafondAchat'])->name('client.devis.survole.plafond.achat');
        //
        //client devis frais detail
            Route::post('/clientdevis/frais/detail/store/{clientdevis}', [CommunEtablirFactureClientController::class, 'clientDevisFraisDetailStore'])->name('client.devis.frais.detail.store');
            Route::patch('/clientdevis/frais/detail/update{clientdevisfraisdetail}', [CommunEtablirFactureClientController::class, 'clientDevisFraisDetailUpdate'])->name('client.devis.frais.detail.update');
            Route::delete('/clientdevis/frais/detail/destroy{clientdevisfraisdetail}', [CommunEtablirFactureClientController::class, 'clientDevisFraisDetailDestroy'])->name('client.devis.frais.detail.destroy');
        //

        //produit
            Route::resource('/produit', CommunProduitController::class);
        //

        //import Produit Excel
            Route::post('/import/Produit/Excel' , [CommunPageController::class,'importProduitExcel'])->name('import.produit.excel');
        //

        //reglage
            Route::resource('/moyenpay', CommunMoyenPaiementController::class);
        //
    });
//

//Admin pages
    Route::prefix('/admin/dashboard')->middleware('auth:admin')->name('admin.')->group(function(){
        Route::post('/logout', [AdminPageController::class, 'logout'])->name('logout');
        Route::get('/home' , [AdminPageController::class,'home'])->name('home');

        //commun
            //projet
                Route::get('/projet', [AdminPageController::class, 'projet'])->name('projet');
                Route::get('/projet/tache/{projet}', [AdminPageController::class, 'projetTache'])->name('projet.tache');
            //
            //client
                Route::resource('/client', AdminClientController::class);
                Route::get('/client/commande/impaye/{client}' , [AdminClientController::class,'clientCommandeImpaye'])->name('client.commande.impaye');
                Route::get('/client/commande/paye/{client}' , [AdminClientController::class,'clientCommandePaye'])->name('client.commande.paye');
                Route::get('/client/commande/partielle/{client}' , [AdminClientController::class,'clientCommandePartielle'])->name('client.commande.partielle');
                //gestion
                    //statut
                        Route::get('/all/commandHe/client/paye' , [AdminCommandeController::class,'commandeClientPaye'])->name('commande.client.paye');
                        Route::get('/all/commande/client/partielle' , [AdminCommandeController::class,'commandeClientPartielle'])->name('commande.client.partielle');
                        Route::get('/all/commande/client/impaye' , [AdminCommandeController::class,'commandeClientImpaye'])->name('commande.client.impaye');
                    //
                //
                //commande
                    Route::get('/commande/client/detail/{clientdevis}' , [AdminCommandeController::class,'commandeClientDetail'])->name('commande.client.detail');
                    Route::get('/commande/client/versement/{clientdevis}' , [AdminCommandeController::class,'commandeClientVersement'])->name('commande.client.versement');
                //
            //
            //fournisseur
                Route::get('/tout/les/fournisseurs' , [AdminFournisseurFactureController::class,'allFournisseur'])->name('fournisseur.index');
                Route::get('/fournisseur/facture/impaye/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFactureImpaye'])->name('fournisseur.facture.impaye');
                Route::get('/fournisseur/facture/paye/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFacturePaye'])->name('fournisseur.facture.paye');
                Route::get('/fournisseur/facture/partielle/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFacturePartielle'])->name('fournisseur.facture.partielle');
                //gestion
                    //statut
                        Route::get('/all/facture/fournisseur/paye' , [AdminFournisseurFactureController::class,'allFactureFournisseurPaye'])->name('all.facture.fournisseur.paye');
                        Route::get('/all/facture/fournisseur/partielle' , [AdminFournisseurFactureController::class,'allFactureFournisseurPartielle'])->name('all.facture.fournisseur.partielle');
                        Route::get('/all/facture/fournisseur/impaye' , [AdminFournisseurFactureController::class,'allFactureFournisseurImpaye'])->name('all.facture.fournisseur.impaye');
                    //
                    //fournisseur facture comptable
                        Route::get('/fournisseur/facture/transaction/{fournisseurfacturecomptable}' , [AdminFournisseurFactureController::class,'fournisseurFactureTransaction'])->name('fournisseur.facture.transaction');
                    //
                //
            //
            //depense
                Route::resource('/depense', AdminDepenseController::class);
            //
            //rappel client achat
                Route::get('/client/rappel/vente/1-mois' , [AdminPageController::class,'clientRappelVente1Mois'])->name('client.rappel.vente.mois');
                Route::get('/client/rappel/vente/15-jours' , [AdminPageController::class,'clientRappelVente15Jours'])->name('client.rappel.vente.jours');
            //
            //profil
                Route::get('/mon/profil' , [AdminProfilController::class,'profil'])->name('profil');
                Route::patch('/profil/update', [AdminProfilController::class, 'profilUpdate'])->name('profil.update');
            //
        //

        //commercial
            //devis 
                Route::get('/devis/client/encours' , [AdminCommercialController::class,'devisClientEncours'])->name('devis.client.encours');
            //
            //commercial
                Route::get('/all/commercial' , [AdminCommercialController::class,'allCommercial'])->name('all.commercial');
            //
            //Historique remise
                Route::get('/Client/remise' , [AdminCommercialController::class,'clientRemise'])->name('client.remise');
            //
        //

        //comptable
            //Bilans comptables automatisés
                // client
                    Route::get('/bilan/semaine/facture/client', [AdminComptableController::class, 'bilanSemaineFactureClient'])->name('bilan.semaine.facture.client');
                    Route::get('/bilan/mois/facture/client', [AdminComptableController::class, 'bilanMoisFactureClient'])->name('bilan.mois.facture.client');
                    Route::get('/bilan/trimestre/facture/client', [AdminComptableController::class, 'bilanTrimestreFactureClient'])->name('bilan.trimestre.facture.client');
                    Route::get('/bilan/annee/facture/client', [AdminComptableController::class, 'bilanAnneeFactureClient'])->name('bilan.annee.facture.client');
                //
                //fournisseur
                    Route::get('/bilan/semaine/facture/fournisseur', [AdminComptableController::class, 'bilanSemaineFactureFournisseur'])->name('bilan.semaine.facture.fournisseur');
                    Route::get('/bilan/mois/facture/fournisseur', [AdminComptableController::class, 'bilanMoisFactureFournisseur'])->name('bilan.mois.facture.fournisseur');
                    Route::get('/bilan/trimestre/facture/fournisseur', [AdminComptableController::class, 'bilanTrimestreFactureFournisseur'])->name('bilan.trimestre.facture.fournisseur');
                    Route::get('/bilan/annee/facture/fournisseur', [AdminComptableController::class, 'bilanAnneeFactureFournisseur'])->name('bilan.annee.facture.fournisseur');
                //
                //depense interne
                    Route::get('/bilan/semaine/depense/interne', [AdminComptableController::class, 'bilanSemaineDepenseInterne'])->name('bilan.semaine.depense.interne');
                    Route::get('/bilan/mois/depense/interne', [AdminComptableController::class, 'bilanMoisDepenseInterne'])->name('bilan.mois.depense.interne');
                    Route::get('/bilan/trimestre/depense/interne', [AdminComptableController::class, 'bilanTrimestreDepenseInterne'])->name('bilan.trimestre.depense.interne');
                    Route::get('/bilan/annee/depense/interne', [AdminComptableController::class, 'bilanAnneeDepenseInterne'])->name('bilan.annee.depense.interne');
                //
            //
        //

        //magasinier
            //categorie
                Route::get('/all/categorie' , [AdminMagasinierController::class,'allCategorie'])->name('all.categorie');
                Route::get('/entrepôt/produit/{categorie}' , [AdminMagasinierController::class,'categorieProduit'])->name('categorie.produit');
            //
            //produit
                Route::get('/all/produit' , [AdminMagasinierController::class,'allProduit'])->name('all.produit');
            //
            //stock
                Route::get('/Stock/des/produits/{categorie}', [AdminMagasinierController::class, 'StockProduitUn'])->name('stock.global.produit');
                Route::get('/entrées/sorties/produits', [AdminMagasinierController::class, 'StockProduitDeux'])->name('stock.global.produit.deux');
            //
            //confirme livraison
                Route::get('/factures/livrees', [AdminMagasinierController::class, 'factureLivre'])->name('facture.livre');
                Route::get('/factures/non/livrees', [AdminMagasinierController::class, 'factureNonLivre'])->name('facture.non.livre');
            //
        //

        // //client
        //     Route::resource('/client', AdminClientController::class);
        //     Route::get('/client/commande/impaye/{client}' , [AdminClientController::class,'clientCommandeImpaye'])->name('client.commande.impaye');
        //     Route::get('/client/commande/paye/{client}' , [AdminClientController::class,'clientCommandePaye'])->name('client.commande.paye');
        //     Route::get('/client/commande/partielle/{client}' , [AdminClientController::class,'clientCommandePartielle'])->name('client.commande.partielle');
        //     Route::get('/commande/client/{client}' , [AdminClientController::class,'commandeClient'])->name('commande.client');
        //     //gestion
        //         //statut
        //             Route::get('/all/commandHe/client/paye' , [AdminCommandeController::class,'commandeClientPaye'])->name('commande.client.paye');
        //             Route::get('/all/commande/client/partielle' , [AdminCommandeController::class,'commandeClientPartielle'])->name('commande.client.partielle');
        //             Route::get('/all/commande/client/impaye' , [AdminCommandeController::class,'commandeClientImpaye'])->name('commande.client.impaye');
        //         //
        //     //
        //     //commande
        //         Route::get('/commande/client/versement/{clientdevis}' , [AdminCommandeController::class,'commandeClientVersement'])->name('commande.client.versement');
        //         Route::post('/commande/client/transaction/store/{clientdevis}' , [AdminCommandeController::class,'commandeClientTransactionStore'])->name('commande.client.transaction.store');
        //     //
        // //
        
        // //fournisseur
        //     Route::get('/tout/les/fournisseurs' , [AdminFournisseurFactureController::class,'allFournisseur'])->name('fournisseur.index');
        //     Route::get('/fournisseur/facture/impaye/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFactureImpaye'])->name('fournisseur.facture.impaye');
        //     Route::get('/fournisseur/facture/paye/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFacturePaye'])->name('fournisseur.facture.paye');
        //     Route::get('/fournisseur/facture/partielle/{fournisseur}' , [AdminFournisseurFactureController::class,'fournisseurFacturePartielle'])->name('fournisseur.facture.partielle');
        //     //gestion
        //         //statut
        //             Route::get('/all/facture/fournisseur/paye' , [AdminFournisseurFactureController::class,'allFactureFournisseurPaye'])->name('all.facture.fournisseur.paye');
        //             Route::get('/all/facture/fournisseur/partielle' , [AdminFournisseurFactureController::class,'allFactureFournisseurPartielle'])->name('all.facture.fournisseur.partielle');
        //             Route::get('/all/facture/fournisseur/impaye' , [AdminFournisseurFactureController::class,'allFactureFournisseurImpaye'])->name('all.facture.fournisseur.impaye');
        //         //
        //         //fournisseur facture comptable
        //             Route::get('/fournisseur/facture/transaction/{fournisseurfacturecomptable}' , [AdminFournisseurFactureController::class,'fournisseurFactureTransaction'])->name('fournisseur.facture.transaction');
        //         //
        //     //
        // //

        // //depense
        //     Route::resource('/depense', AdminDepenseController::class);
        // //

        // //rappel client achat
        //     Route::get('/client/rappel/vente/1-mois' , [AdminPageController::class,'clientRappelVente1Mois'])->name('client.rappel.vente.mois');
        //     Route::get('/client/rappel/vente/15-jours' , [AdminPageController::class,'clientRappelVente15Jours'])->name('client.rappel.vente.jours');
        // //

        //profil
            Route::get('/mon/profil' , [AdminProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [AdminProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//ressource pages
    // Route d'accueil
        // Routes liées à l'authentification (login) hors middleware auth
            // Route::get('login', [RessourceAuthenticatedSessionController::class, 'create'])->name('login');
            // Route::post('login', [RessourceAuthenticatedSessionController::class, 'store']);
            // Route::post('/logout', [RessourceAuthenticatedSessionController::class, 'destroy'])->name('logout');
        //
        //
            Route::get('/paies/{paie}/telecharger', [RessourcePaieController::class, 'telecharger'])->name('paies.telecharger');
            Route::get('/fiche-paies', [RessourcePaieController::class, 'fichePaies'])->name('fiche-paies');

            Route::get('/conge', [RessourceCongeController::class, 'create'])->name('conge.create');
            Route::post('/conge', [RessourceCongeController::class, 'store'])->name('conge.store');

            Route::get('/vehicules', [RessourceVehiculeController::class, 'index'])->name('vehicules.index');
            Route::get('/vehicules/create', [RessourceVehiculeController::class, 'create'])->name('vehicules.create');
            Route::post('/vehicules', [RessourceVehiculeController::class, 'store'])->name('vehicules.store');

            // Affiche le formulaire de retour
                Route::get('/vehicules/retourner/{id}', [RessourceVehiculeController::class, 'retourForm'])->name('vehicules.retourForm');
            //

            // Traite le retour du véhicule
                Route::post('/vehicules/retourner/{id}', [RessourceVehiculeController::class, 'retourner'])->name('vehicules.retourner');

                Route::get('/parcking', [RessourceVehiculeController::class, 'parcking'])->name('parcking');

                Route::get('/menu', [RessourceEmployeController::class, 'menu'])->name('menu');

                Route::get('/document', [RessourceEmployeController::class, 'document'])->name('document');
            //

            Route::post('/document', [RessourceDemandeDocumentController::class, 'store'])->name('demandes-documents.store');
            Route::get('/vehicules/disponibles', [RessourceVehiculeController::class, 'disponibles'])->name('vehicules.disponibles');
            Route::get('/vehicules/indisponibles', [RessourceVehiculeController::class, 'indisponibles'])->name('vehicules.indisponibles');

            Route::get('/vehicules/emprunter/{id}', [RessourceVehiculeController::class, 'emprunterForm'])->name('vehicules.emprunterForm');
            Route::post('/vehicules/emprunter/{id}', [RessourceVehiculeController::class, 'emprunter'])->name('vehicules.emprunter');

            Route::get('/vehicules/retour/{id}', [RessourceVehiculeController::class, 'retourForm'])->name('vehicules.retourForm');
            Route::post('/vehicules/retour/{id}', [RessourceVehiculeController::class, 'retourner'])->name('vehicules.retourner');

            Route::get('/vehicules/qr-parking', [RessourceVehiculeController::class, 'qrParking'])->name('vehicules.qrParking');


            Route::get('/presence-formulaire', [RessourcePresenceController::class, 'formulaire'])->name('formulaire');
            Route::post('/presence-formulaire', [RessourcePresenceController::class, 'store'])->name('presence.store');
        //
    //
    //auth ange
        Route::middleware('auth:utilisateur')->group(function () {
            Route::post('/logout', [RessourcePagesController::class, 'logout'])->name('logout');

            Route::get('/parcking', [RessourceVehiculeController::class, 'parcking'])->name('parcking');

            // Page d'accueil pour RH - par exemple welcome.blade.php via EmployeController@index
            Route::get('/welcome', [RessourceEmployeController::class, 'index'])->name('welcome');
            Route::get('/paie', [RessourcePaieController::class, 'paie'])->middleware('auth')->name('paie');

            Route::get('/entretien', [RessourceEntretienController::class, 'Entretien'])->name('entretien');
            Route::post('/entretien', [RessourceEntretienController::class, 'store'])->name('entretiens.store');
            Route::patch('/entretiens/{id}/valider', [RessourceEntretienController::class, 'validerParComm'])->name('entretiens.valider');

            Route::get('/presence', [RessourcePresenceController::class, 'presence'])->name('presence');
            Route::post('/presence', [RessourcePresenceController::class, 'store'])->name('presence.store');


            // Page dashboard pour employé
            Route::get('/dashboard', [RessourceDashboardController::class, 'index'])->name('dashboard');
            // Route::post('/', [RessourceAuthenticatedSessionController::class, 'destroy'])->name('logout');
            // Profil utilisateur
            Route::get('/profile', [RessourceProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [RessourceProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [RessourceProfileController::class, 'destroy'])->name('profile.destroy');

            // Gestion des employés
            Route::get('/employes', [RessourceEmployeController::class, 'liste'])->name('employes.liste');
            Route::post('/employes', [RessourceEmployeController::class, 'store'])->name('employes.store');

            // Paiements
            Route::get('/paiement', [RessourcePaiementController::class, 'index'])->name('paiement.index');
            Route::post('/paiement/{employe}', [RessourcePaiementController::class, 'payer'])->name('paiement.payer');


            // Formulaire demande congé (employé)

            Route::get('/conges', [RessourceCongeController::class, 'index'])->name('conges');
            Route::post('/conges/{conge}/status', [RessourceCongeController::class, 'updateStatus'])->name('conges.updateStatus');
        });
    //

    Route::prefix('/ressource/humaine/dashboard')->middleware('auth:ressource')->name('ressource.')->group(function(){
        Route::get('/home' , [RessourcePageController::class,'home'])->name('home');
        Route::post('/logout', [RessourcePageController::class, 'logout'])->name('logout');

        //projet
            Route::get('/projet', [RessourcePageController::class, 'projet'])->name('projet');
            Route::get('/projet/tache/{projet}', [RessourcePageController::class, 'projetTache'])->name('projet.tache');
        //
        
        //employe
            Route::resource('/employe', RessourceEmployesController::class);

            Route::resource('/employedoc', RessourceEmployeDocumentController::class)->except(['store']);
            Route::post('/employedoc/store/{employe}', [RessourceEmployeDocumentController::class, 'store'])->name('employedoc.store');

            Route::resource('/employecontrat', RessourceEmployeContratController::class)->except(['store']);
            Route::post('/employecontrat/store/{employe}', [RessourceEmployeContratController::class, 'store'])->name('employecontrat.store');
        //  
        //profil
            Route::get('/mon/profil' , [RessourceProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [RessourceProfilController::class, 'profilUpdate'])->name('profil.update');
        // 
        //liste de presence employé
            Route::get('/liste/presence', [RessourcePageController::class, 'listePresence'])->name('liste.presence');
            Route::get('/liste/presence/employe/{ids}/{date}', [RessourcePageController::class, 'listePresenceEmploye'])->name('liste.presence.employe');
            Route::get('/qrcode/presence/employe', [RessourcePageController::class, 'presenceQrcodePdf'])->name('qrcode.presence.employe');
        //

        /*
            //lui
                // Page d'accueil pour RH - par exemple welcome.blade.php via EmployeController@index
                    Route::get('/', [RessourceEmployeController::class, 'index'])->name('home');
                    Route::get('/paie', [RessourcePaieController::class, 'paie'])->middleware('auth')->name('paie');

                    Route::get('/entretien', [RessourceEntretienController::class, 'Entretien'])->name('entretien');
                    Route::post('/entretien', [RessourceEntretienController::class, 'store'])->name('entretiens.store');
                    Route::patch('/entretiens/{id}/valider', [RessourceEntretienController::class, 'validerParComm'])->name('entretiens.valider');
                //

                // Page dashboard pour employé
                    Route::get('/dashboard', [RessourceDashboardController::class, 'index'])->name('dashboard');
                    // Route::post('/', [RessourceAuthenticatedSessionController::class, 'destroy'])->name('logout');
                //
                // Profil utilisateur
                    Route::get('/profile', [RessourceProfileController::class, 'edit'])->name('profile.edit');
                    Route::patch('/profile', [RessourceProfileController::class, 'update'])->name('profile.update');
                    Route::delete('/profile', [RessourceProfileController::class, 'destroy'])->name('profile.destroy');
                //

                // Gestion des employés
                    Route::get('/employes', [RessourceEmployeController::class, 'liste'])->name('employes.liste');
                    Route::post('/employes', [RessourceEmployeController::class, 'store'])->name('employes.store');
                //

                // Paiements
                    Route::get('/paiement', [RessourcePaiementController::class, 'index'])->name('paiement.index');
                    Route::post('/paiement/{employe}', [RessourcePaiementController::class, 'payer'])->name('paiement.payer');

                    Route::get('/conge', [RessourceEmployeController::class, 'conge'])->name('conge');
                    Route::get('/document', [RessourceEmployeController::class, 'document'])->name('document');

                    Route::post('/document', [RessourceDemandeDocumentController::class, 'store'])->name('demandes-documents.store');
                //


                // Formulaire demande congé (employé)
                    Route::get('/conge', [RessourceCongeController::class, 'create'])->name('conge.create');
                    Route::post('/conge', [RessourceCongeController::class, 'store'])->name('conge.store');

                    Route::get('/conges', [RessourceCongeController::class, 'index'])->name('conges');
                    Route::post('/conges/{conge}/status', [RessourceCongeController::class, 'updateStatus'])->name('conges.updateStatus');
                //
            //end lui
         */
    });
//

//magasinier pages
    Route::prefix('/magasinier/dashboard')->middleware('auth:magasinier')->name('magasinier.')->group(function(){
        Route::get('/home' , [MagasinierPageController::class,'home'])->name('home');
        Route::post('/logout', [MagasinierPageController::class, 'logout'])->name('logout');

        //projet
            Route::get('/projet', [MagasinierPageController::class, 'projet'])->name('projet');
            Route::get('/projet/tache/{projet}', [MagasinierPageController::class, 'projetTache'])->name('projet.tache');
        //
        
        //confirme livraison
            Route::get('/factures/livrees', [MagasinierPageController::class, 'factureLivre'])->name('facture.livre');
            Route::get('/factures/non/livrees', [MagasinierPageController::class, 'factureNonLivre'])->name('facture.non.livre');
            Route::get('/facture/client/detail/{clientdevis}' , [MagasinierPageController::class,'factureClientDetail'])->name('facture.client.detail');
        //
        //facture location livrés
            Route::get('/factures/location/livrees/sans/retour', [MagasinierPageController::class, 'factureLocationLivreSansRetour'])->name('facture.location.livre.sans.retour');
            Route::get('/factures/location/livrees/avec/retour', [MagasinierPageController::class, 'factureLocationLivreAvecRetour'])->name('facture.location.livre.avec.retour');
        // 

        //categorie
            Route::resource('/categorie', MagasinierCategorieController::class);
            Route::get('/entrepôt/produit/{categorie}' , [MagasinierCategorieController::class,'categorieProduit'])->name('categorie.produit');
        //
        //produit
            Route::resource('/produit', MagasinierProduitController::class);
        //
        //fournisseur
            Route::resource('/fournisseur', MagasinierFournisseurController::class);
        //
        //fournisseur facture reception
            Route::get('/facture/fournisseur/reception/encours' , [MagasinierFournisseurController::class,'factureFournisseurReceptionEncours'])->name('facture.fournisseur.reception.encours');
            Route::get('/facture/fournisseur/reception/valide' , [MagasinierFournisseurController::class,'factureFournisseurReceptionValide'])->name('facture.fournisseur.reception.valide');
        //
        //fournisseur facture
            Route::resource('/fournisseurfacture', MagasinierFournisseurFactureController::class);

            Route::get('/fournisseur/facture/{fournisseur}', [MagasinierFournisseurFactureController::class, 'fournisseurFacture'])->name('fournisseur.facture');
            Route::get('/fournisseur/facture/detail/{fournisseurfacture}', [MagasinierFournisseurFactureController::class, 'fournisseurFactureDetail'])->name('fournisseur.facture.detail');
            Route::get('/fournisseur/facture/create/{fournisseur}/{produit}', [MagasinierFournisseurFactureController::class, 'fournisseurFactureCreate'])->name('fournisseur.facture.create');
            Route::post('/fournisseur/facture/store', [MagasinierFournisseurFactureController::class, 'fournisseurFactureStore'])->name('fournisseur.facture.store');
            Route::post('/fournisseur/facture/store/add/{fournisseur}/{produit}', [MagasinierFournisseurFactureController::class, 'fournisseurFactureStoreAdd'])->name('fournisseur.facture.store.add');

            Route::get('/facture/fournisseur/invalide', [MagasinierFournisseurFactureController::class, 'fournisseurFactureInvalide'])->name('fournisseur.facture.invalide');
            Route::get('/facture/fournisseur/valide', [MagasinierFournisseurFactureController::class, 'fournisseurFactureValide'])->name('fournisseur.facture.valide');
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

        //comptable
            Route::resource('/comptable', ComptableController::class);
            Route::get('/comptable/compte/update/{comptable}' , [ComptableController::class,'comptableCompteUpdate'])->name('comptable.compte.update');
        //

        //projet
            Route::get('/projet', [ComptablePageController::class, 'projet'])->name('projet');
            Route::get('/projet/tache/{projet}', [ComptablePageController::class, 'projetTache'])->name('projet.tache');
        //

        //FNE CERTIFIER
            Route::get('/fne/certifier/{id}', [ComptableFNEController::class, 'certifierFactureFNE'])->name('certifier.facture.fne');
            Route::get('/fne/certifier/avoir/{clientdevisavoir}', [ComptableFNEController::class, 'certifierFactureAvoirFNE'])->name('certifier.facture.avoir.fne');
        //

        //excel
            //client
                Route::get('/client/facture/export', [ComptablePageController::class, 'clientFactureExport'])->name('client.facture.export');
                Route::get('/client/facture/individuel/export/{client}/{statut}', [ComptablePageController::class, 'clientFactureIndividuelExport'])->name('client.facture.individuel.export');
                Route::get('/client/facture/general/export/{statut}', [ComptablePageController::class, 'clientFactureGeneralExport'])->name('client.facture.general.export');
                Route::get('/client/facture/general/export/CA/{statut}', [ComptablePageController::class, 'clientFactureGeneralCAExport'])->name('client.facture.general.CA.export');
            //
            //fournisseur
                Route::get('/fournisseur/facture/export', [ComptablePageController::class, 'fournisseurFactureExport'])->name('fournisseur.facture.export');
                Route::get('/fournisseur/facture/individuel/export/{fournisseur}/{statut}', [ComptablePageController::class, 'fournisseurFactureIndividuelExport'])->name('fournisseur.facture.individuel.export');
                Route::get('/fournisseur/facture/general/export/{statut}', [ComptablePageController::class, 'fournisseurFactureGeneralExport'])->name('fournisseur.facture.general.export');
            //
        //

        //client
            Route::resource('/client', ComptableClientController::class);
            Route::get('/comptabilite/client' , [ComptableClientController::class,'comptableClient'])->name('comptable.client');
            Route::get('/commercial/client' , [ComptableClientController::class,'commercialClient'])->name('commercial.client');
            
            Route::get('/client/commande/impaye/{client}' , [ComptableClientController::class,'clientCommandeImpaye'])->name('client.commande.impaye');
            Route::get('/client/commande/paye/{client}' , [ComptableClientController::class,'clientCommandePaye'])->name('client.commande.paye');
            Route::get('/client/commande/partielle/{client}' , [ComptableClientController::class,'clientCommandePartielle'])->name('client.commande.partielle');
            /*a supprimer*/            Route::get('/commande/client/{client}' , [ComptableClientController::class,'commandeClient'])->name('commande.client');
            //gestion
                //statut
                    Route::get('/all/commande/client/paye' , [ComptableCommandeController::class,'commandeClientPaye'])->name('commande.client.paye');
                    Route::get('/all/commande/client/partielle' , [ComptableCommandeController::class,'commandeClientPartielle'])->name('commande.client.partielle');
                    Route::get('/all/commande/client/impaye' , [ComptableCommandeController::class,'commandeClientImpaye'])->name('commande.client.impaye');
                //
            //
            //commande
                Route::get('/commande/client/detail/{clientdevis}' , [ComptableCommandeController::class,'commandeClientDetail'])->name('commande.client.detail');
                Route::get('/commande/client/versement/{clientdevis}' , [ComptableCommandeController::class,'commandeClientVersement'])->name('commande.client.versement');
                Route::post('/commande/client/transaction/store/{clientdevis}' , [ComptableCommandeController::class,'commandeClientTransactionStore'])->name('commande.client.transaction.store');
            //
        //
        //client etablir facture
            Route::get('/facture/client/create/etape1' , [ComptableEtablirFactureClientController::class,'factureClientCreate'])->name('facture.client.create');
            Route::post('/facture/client/store/etape1' , [ComptableEtablirFactureClientController::class,'factureClientStore'])->name('facture.client.store');
            Route::get('/facture/client/create/etape2/{clientdevis}' , [ComptableEtablirFactureClientController::class,'factureClientCreateDeux'])->name('facture.client.create.deux');

            Route::post('/produit/prix/update/{produit}' , [ComptableEtablirFactureClientController::class,'produitPrixUpdate'])->name('produit.prix.update');

            //prestation
                Route::get('/facture/client/create/etape2/prestation/{clientdevis}' , [ComptableEtablirFactureClientController::class,'factureClientCreatePrestation'])->name('facture.client.create.prestation');
            //
        //
        //clientdevis
            Route::post('/commande/client/add/bon/{clientdevis}' , [ComptableClientController::class,'commandeClientAddBon'])->name('commande.client.add.bon');
            Route::patch('/commande/client/update/{clientdevis}' , [ComptableClientController::class,'commandeClientUpdate'])->name('commande.client.update');
        //
        //client avoir
            Route::get('/commande/client/avoir/{clientdevis}' , [ComptableCommandeController::class,'commandeClientAvoir'])->name('commande.client.avoir');
            Route::post('/commande/client/avoir/store/{clientdevis}' , [ComptableCommandeController::class,'commandeClientAvoirStore'])->name('commande.client.avoir.store');

            Route::get('/commande/client/all/facture/avoir/{clientdevis}' , [ComptableCommandeController::class,'commandeClientAllFactureAvoir'])->name('commande.client.all.avoir');
            Route::get('/commande/client/avoir/detail/{clientdevisavoir}' , [ComptableCommandeController::class,'commandeClientAvoirDetail'])->name('commande.client.avoir.detail');

            Route::delete('/commande/avoir/destroy/{clientdevisavoir}' , [ComptableCommandeController::class,'commandeAvoirDestroy'])->name('commande.avoir.destroy');
        //
        //client devis frais detail
            Route::get('/clientdevis/frais/detail/{clientdevis}', [ComptablePageController::class, 'clientDevisFraisDetail'])->name('client.devis.frais.detail');
        //

        //rappel client achat
            Route::get('/client/rappel/vente/1-mois' , [ComptablePageController::class,'clientRappelVente1Mois'])->name('client.rappel.vente.mois');
            Route::get('/client/rappel/vente/15-jours' , [ComptablePageController::class,'clientRappelVente15Jours'])->name('client.rappel.vente.jours');
            Route::get('/rappel-client/{periode}', [ComptablePageController::class, 'clientsRappelParPeriode'])->name('client.rappel.periode');
        //

        //fournisseur
            Route::get('/tout/les/fournisseurs' , [ComptableFournisseurFactureController::class,'allFournisseur'])->name('fournisseur.index');
            Route::get('/fournisseur/facture/impaye/{fournisseur}' , [ComptableFournisseurFactureController::class,'fournisseurFactureImpaye'])->name('fournisseur.facture.impaye');
            Route::get('/fournisseur/facture/paye/{fournisseur}' , [ComptableFournisseurFactureController::class,'fournisseurFacturePaye'])->name('fournisseur.facture.paye');
            Route::get('/fournisseur/facture/partielle/{fournisseur}' , [ComptableFournisseurFactureController::class,'fournisseurFacturePartielle'])->name('fournisseur.facture.partielle');
            //gestion
                //statut
                    Route::get('/all/facture/fournisseur/paye' , [ComptableFournisseurFactureController::class,'allFactureFournisseurPaye'])->name('all.facture.fournisseur.paye');
                    Route::get('/all/facture/fournisseur/partielle' , [ComptableFournisseurFactureController::class,'allFactureFournisseurPartielle'])->name('all.facture.fournisseur.partielle');
                    Route::get('/all/facture/fournisseur/impaye' , [ComptableFournisseurFactureController::class,'allFactureFournisseurImpaye'])->name('all.facture.fournisseur.impaye');
                //
                //fournisseur facture comptable
                    Route::resource('/fournisseurfacturecomptable', ComptableFournisseurFactureComptableController::class);
                    Route::get('/fournisseur/facture/transaction/{fournisseurfacturecomptable}' , [ComptableFournisseurFactureComptableController::class,'fournisseurFactureTransaction'])->name('fournisseur.facture.transaction');
                    Route::post('/fournisseur/facture/transaction/store/{fournisseurfacturecomptable}' , [ComptableFournisseurFactureComptableController::class,'fournisseurFactureTransactionStore'])->name('fournisseur.facture.transaction.store');
                    Route::patch('/fournisseur/facture/transaction/update/{fournisseurfct}' , [ComptableFournisseurFactureComptableController::class,'fournisseurFactureTransactionUpdate'])->name('fournisseur.facture.transaction.update');
                    Route::delete('/fournisseur/facture/transaction/destroy/{fournisseurfct}' , [ComptableFournisseurFactureComptableController::class,'fournisseurFactureTransactionDestroy'])->name('fournisseur.facture.transaction.destroy');
                //
                //Fournisseur facture add produit
                    Route::get('/facture/fournisseur/detail/{fournisseurfacturecomptable}' , [ComptablePageController::class,'factureFournisseurDetail'])->name('facture.fournisseur.detail');
                    Route::get('/fournisseur/facture/add/produit/{fournisseurfacturecomptable}' , [ComptablePageController::class,'fournisseurFactureAddProduit'])->name('fournisseur.facture.add.produit');
                //
            //
        //

        //depense
            Route::resource('/depense', ComptableDepenseController::class);
        //

        //Etat des comptes
            //client
                Route::get('/etat/compte/client/paye' , [ComptableEtatCompteController::class,'etatCompteClientPaye'])->name('etat.compte.client.paye');
                Route::get('/etat/compte/client/partielle' , [ComptableEtatCompteController::class,'etatCompteClientPartielle'])->name('etat.compte.client.partielle');
                Route::get('/etat/compte/client/impaye' , [ComptableEtatCompteController::class,'etatCompteClientImpaye'])->name('etat.compte.client.impaye');
            //

            //fournisseur
                Route::get('/etat/compte/fournisseur/paye' , [ComptableEtatCompteController::class,'etatCompteFournisseurPaye'])->name('etat.compte.fournisseur.paye');
                Route::get('/etat/compte/fournisseur/partielle' , [ComptableEtatCompteController::class,'etatCompteFournisseurPartielle'])->name('etat.compte.fournisseur.partielle');
                Route::get('/etat/compte/fournisseur/impaye' , [ComptableEtatCompteController::class,'etatCompteFournisseurImpaye'])->name('etat.compte.fournisseur.impaye');
            //
        //

        //Chiffre d'affaire
            Route::get('/chiffre/affaire/client/general' , [ComptableEtatCompteController::class,'chiffreAffaireClientGeneral'])->name('chiffre.affaire.client.general');

            //client
                Route::get('/chiffre/affaire/client/paye' , [ComptableEtatCompteController::class,'chiffreAffaireClientPaye'])->name('chiffre.affaire.client.paye');
                Route::get('/chiffre/affaire/client/partielle' , [ComptableEtatCompteController::class,'chiffreAffaireClientPartielle'])->name('chiffre.affaire.client.partielle');
                Route::get('/chiffre/affaire/client/impaye' , [ComptableEtatCompteController::class,'chiffreAffaireClientImpaye'])->name('chiffre.affaire.client.impaye');
            //
        //

        //Bilans comptables automatisés
            // client
                Route::get('/factures/filtrer', [ComptableBilanController::class, 'bilanFactureFiltrer'])->name('bilan.facture.filtrer');

                Route::get('/bilan/periode/facture/client/{ids}/{periode}/{type}', [ComptableBilanController::class, 'bilanPeriodeFactureClient'])->name('bilan.periode.facture.client');
                Route::get('/bilan/semaine/facture/client', [ComptableBilanController::class, 'bilanSemaineFactureClient'])->name('bilan.semaine.facture.client');
                Route::get('/bilan/mois/facture/client', [ComptableBilanController::class, 'bilanMoisFactureClient'])->name('bilan.mois.facture.client');
                Route::get('/bilan/trimestre/facture/client', [ComptableBilanController::class, 'bilanTrimestreFactureClient'])->name('bilan.trimestre.facture.client');
                Route::get('/bilan/annee/facture/client', [ComptableBilanController::class, 'bilanAnneeFactureClient'])->name('bilan.annee.facture.client');
            //
            //fournisseur
                Route::get('/bilan/periode/facture/fournisseur/{ids}/{periode}/{type}', [ComptableBilanController::class, 'bilanPeriodeFactureFournisseur'])->name('bilan.periode.facture.fournisseur');
                Route::get('/bilan/semaine/facture/fournisseur', [ComptableBilanController::class, 'bilanSemaineFactureFournisseur'])->name('bilan.semaine.facture.fournisseur');
                Route::get('/bilan/mois/facture/fournisseur', [ComptableBilanController::class, 'bilanMoisFactureFournisseur'])->name('bilan.mois.facture.fournisseur');
                Route::get('/bilan/trimestre/facture/fournisseur', [ComptableBilanController::class, 'bilanTrimestreFactureFournisseur'])->name('bilan.trimestre.facture.fournisseur');
                Route::get('/bilan/annee/facture/fournisseur', [ComptableBilanController::class, 'bilanAnneeFactureFournisseur'])->name('bilan.annee.facture.fournisseur');
            //
            //depense interne
                Route::get('/bilan/periode/depense/interne/{ids}/{periode}/{type}', [ComptableBilanController::class, 'bilanPeriodeDepenseInterne'])->name('bilan.periode.depense.interne');
                Route::get('/bilan/semaine/depense/interne', [ComptableBilanController::class, 'bilanSemaineDepenseInterne'])->name('bilan.semaine.depense.interne');
                Route::get('/bilan/mois/depense/interne', [ComptableBilanController::class, 'bilanMoisDepenseInterne'])->name('bilan.mois.depense.interne');
                Route::get('/bilan/trimestre/depense/interne', [ComptableBilanController::class, 'bilanTrimestreDepenseInterne'])->name('bilan.trimestre.depense.interne');
                Route::get('/bilan/annee/depense/interne', [ComptableBilanController::class, 'bilanAnneeDepenseInterne'])->name('bilan.annee.depense.interne');
            //
        //

        //profil
            Route::get('/mon/profil' , [ComptableProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [ComptableProfilController::class, 'profilUpdate'])->name('profil.update');
        //

        //archive
            Route::get('/archive/des/factures' , [ComptablePageController::class,'allArchiveFacture'])->name('all.archive.facture');
        //

        //reglage
            Route::resource('/delaipay', ComptableDelaipayController::class);
        //

    










        

        //fournisseur
            Route::get('/fournisseur/facture/detail/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureDetail'])->name('fournisseur.facture.detail');
            Route::post('/add/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureAdd'])->name('fournisseur.facture.add');
            Route::get('/fournisseur/facture/etat/update/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureEtatUpdate'])->name('fournisseur.facture.etat.update');
            Route::get('/facture/fournisseur/invalide', [ComptableFournisseurFactureController::class, 'fournisseurFactureInvalide'])->name('fournisseur.facture.invalide');
            Route::get('/facture/fournisseur/valide', [ComptableFournisseurFactureController::class, 'fournisseurFactureValide'])->name('fournisseur.facture.valide');
        // 
        //Suivi de la trésorerie
            Route::get('/consultation/flux', [ComptableSuiviTresorerieController::class, 'consultationFlux'])->name('consultation.flux');
            Route::get('/suivi/paiement', [ComptableSuiviTresorerieController::class, 'suiviPaiement'])->name('suivi.paiement');
            Route::get('/suivi/alerte/anomalie', [ComptableSuiviTresorerieController::class, 'suiviAlerteAnomalie'])->name('suivi.alerte.anomalie');
        //  
        //Exports et éditions
            Route::get('/export/comptable', [ComptablePageController::class, 'exportComptable'])->name('export.comptable');
            Route::get('/filtrage/donnees', [ComptablePageController::class, 'filtrageDonnee'])->name('filtrage.donnee');
            Route::get('/journaux/comptable', [ComptablePageController::class, 'journauxComptable'])->name('journaux.comptable');
        //   
        //Intégration avec un cabinet comptable
            Route::get('/fichier/comptable', [ComptablePageController::class, 'fichierComptable'])->name('fichier.comptable');
            Route::get('/export/fichier', [ComptablePageController::class, 'exportFichier'])->name('export.fichier');
        //    
        //recette
            Route::get('/suivi/recette', [ComptablePageController::class, 'suiviRecette'])->name('suivi.recette');
        //
        // // commande
        //     //client
        //         Route::get('/commande/client/encours' , [ComptableCommandeController::class,'commandeClientEncours'])->name('commande.client.encours');
        //         Route::get('/commande/client/validés' , [ComptableCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
        //         Route::get('/commande/client/refusés' , [ComptableCommandeController::class,'commandeClientRefuse'])->name('commande.client.refuse');
                

        //         Route::post('/rejet/commande/client/store/{clientdevis}' , [ComptableCommandeController::class,'rejetCommandeClientStore'])->name('rejet.commande.client.store');
        //         Route::get('/annuler/rejet/commande/client/{clientdevis}' , [ComptableCommandeController::class,'annulerRejetCommandeClient'])->name('annuler.rejet.commande.client');
        //         Route::post('/valider/commande/client/store/{clientdevis}' , [ComptableCommandeController::class,'validerCommandeClientStore'])->name('valider.commande.client.store');
        //     //
        // //
    });
//

//commercial pages
    Route::prefix('/commercial/dashboard')->middleware('auth:commercial')->name('commercial.')->group(function(){
        Route::get('/home' , [CommercialPageController::class,'home'])->name('home');
        Route::post('/logout', [CommercialPageController::class, 'logout'])->name('logout');

        //projet
            Route::get('/projet', [CommercialPageController::class, 'projet'])->name('projet');
            Route::get('/projet/tache/{projet}', [CommercialPageController::class, 'projetTache'])->name('projet.tache');
        //

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
            // Route::patch('/devis/produit/prix/update/{produit}' , [CommercialDevisController::class,'devisProduitPrixUpdate'])->name('devis.produit.prix.update');
            
            //particulier (entreprise)
                /*supprimer*/Route::get('/devis/entreprise/create/etape1' , [CommercialDevisController::class,'devisParticulierCreate'])->name('devis.particulier.create');
                /*supprimer*/Route::post('/devis/entreprise/store/etape1' , [CommercialDevisController::class,'devisParticulierStore'])->name('devis.particulier.store');
                /*supprimer*/Route::get('/devis/entreprise/create/etape2/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierCreateDeux'])->name('devis.particulier.create.deux');
                /*supprimer*/Route::post('/devis/entreprise/store/etape2/{particulierdevis}/{produit}' , [CommercialDevisController::class,'devisParticulierStoreDeux'])->name('devis.particulier.store.deux');
                /*supprimer*/Route::post('/produit/devis/entreprise/qty/update/{particulierdevisprod}' , [CommercialDevisController::class,'devisParticulierProduitQtyUpdate'])->name('produit.devis.particulier.qty.update');
                /*supprimer*/Route::get('/produit/devis/entreprise/destroy/{particulierdevisprod}' , [CommercialDevisController::class,'devisParticulierProduitDestroy'])->name('produit.devis.particulier.destroy');  
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
                    /*supprimer*/Route::get('/devis/entreprise/encours' , [CommercialDevisController::class,'devisParticulierEncours'])->name('devis.particulier.encours');
                    /*supprimer*/Route::get('/devis/entreprise/finalite/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierFinalite'])->name('devis.particulier.finalite');
                    /*supprimer*/Route::patch('/devis/entreprise/update/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierUpdate'])->name('devis.particulier.update');
                    /*supprimer*/Route::delete('/devis/entreprise/destroy/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierDestroy'])->name('devis.particulier.destroy');
                    /*supprimer*/Route::get('/devis/entreprise/convertir/update/{particulierdevis}' , [CommercialDevisController::class,'devisParticulierConvertirUpdate'])->name('devis.particulier.convertir.update');
                //
            //
        //

        //facture client
            Route::get('/facture/client/paye' , [CommercialFactureClientController::class,'factureClientPaye'])->name('facture.client.paye');
            Route::get('/facture/client/partielle' , [CommercialFactureClientController::class,'factureClientPartielle'])->name('facture.client.partielle');
            Route::get('/facture/client/impaye' , [CommercialFactureClientController::class,'factureClientImpaye'])->name('facture.client.impaye');
        //
        //commercial
            Route::resource('/commercial', CommercialController::class);
            Route::get('/commercial/statistique/{commercial}' , [CommercialController::class,'commercialStatistique'])->name('commercial.statistique');
            Route::get('/commercial/statistique/annee/{commercial}' , [CommercialController::class,'commercialStatistiqueAnnee'])->name('commercial.statistique.annee');
            Route::get('/commercial/statistique/mois/{commercial}/{year}/{month}' , [CommercialController::class,'commercialStatistiqueMois'])->name('commercial.statistique.mois');
        //
        //profil
            Route::get('/mon/profil' , [CommercialProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [CommercialProfilController::class, 'profilUpdate'])->name('profil.update');
        //
        //Historique remise
            Route::get('/Client/remise' , [CommercialPageController::class,'clientRemise'])->name('client.remise');
            /*supprimer*/Route::patch('/Particulier/remise', [CommercialPageController::class, 'particulierRemise'])->name('particulier.remise');
        //
        //Statistique
            Route::get('/statistique' , [CommercialPageController::class,'statistique'])->name('statistique');
            Route::get('/statistique/annee' , [CommercialPageController::class,'statistiqueAnnee'])->name('statistique.annee');
            Route::get('/statistique/mois/{year}/{month}' , [CommercialPageController::class,'statistiqueMois'])->name('statistique.mois');
        //
        //stock
            Route::get('/Stock/des/produits/{categorie}', [CommercialPageController::class, 'StockProduit'])->name('stock.global.produit');
        //
        //rapport
            Route::get('/mon/indicateur/de/performance' , [CommercialPageController::class,'rapport'])->name('rapport');
        //




        
        //particulier (entreprise)
            /*supprimer*/Route::resource('/particulier', CommercialParticulierController::class);
        //
        //commande
            //client
                /*supprimer*/Route::get('/commande/client/encours' , [CommercialCommandeController::class,'commandeClientEncours'])->name('commande.client.encours');
                /*supprimer*/Route::get('/commande/client/validés' , [CommercialCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
                /*supprimer*/Route::get('/commande/client/refusés' , [CommercialCommandeController::class,'commandeClientRefuse'])->name('commande.client.refuse');
            //
            //particulier (entreprise)
                /*supprimer*/Route::get('/commande/entreprise/encours' , [CommercialCommandeController::class,'commandeParticulierEncours'])->name('commande.particulier.encours');
                /*supprimer*/Route::get('/commande/entreprise/validés' , [CommercialCommandeController::class,'commandeParticulierValide'])->name('commande.particulier.valide');
                /*supprimer*/Route::get('/commande/entreprise/refusés' , [CommercialCommandeController::class,'commandeParticulierRefuse'])->name('commande.particulier.refuse');
            //
        //
        
            // Route::resource('/devis', CommercialDevisController::class);//->except(['create','store']);
            // Route::get('/devis/create/deux/{clientdevis}' , [CommercialDevisController::class,'devisCreateDeux'])->name('devis.create.deux');
            // Route::post('/devis/store/deux/{clientdevis}/{produit}' , [CommercialDevisController::class,'devisStoreDeux'])->name('devis.store.deux');

    });
//

//pack auto pages
    Route::prefix('/pack/auto')->middleware('auth:packauto')->name('packauto.')->group(function(){
        Route::get('/home' , [PackautoPageController::class,'home'])->name('home');
        Route::post('/logout', [PackautoPageController::class, 'logout'])->name('logout');

        //all véhicules            
            Route::resource('/vehicule', PackautoVehiculeController::class);
        //
        //véhicules empruntés emprunt
            Route::get('/vehicule/emprunt', [PackautoPageController::class, 'vehiculeEmprunt'])->name('vehicule.emprunt');
        //
        //véhicules disponibles
            Route::get('/vehicule/disponible', [PackautoPageController::class, 'vehiculeDisponible'])->name('vehicule.disponible');
        //
        //demande carburant
            Route::resource('/vehiculedc', PackautoDemandeCarburantController::class);
        //
        //projet
            Route::get('/projet', [PackautoPageController::class, 'projet'])->name('projet');
        //
        //profil
            Route::get('/mon/profil' , [PackautoProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [PackautoProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//secretaire pages
    Route::prefix('/secretaire')->middleware('auth:secretaire')->name('secretaire.')->group(function(){
        Route::get('/home' , [SecretairePageController::class,'home'])->name('home');
        Route::post('/logout', [SecretairePageController::class, 'logout'])->name('logout');

        //projet
            Route::get('/projet', [SecretairePageController::class, 'projet'])->name('projet');
        //
        //profil
            Route::get('/mon/profil' , [SecretaireProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [SecretaireProfilController::class, 'profilUpdate'])->name('profil.update');
        //
    });
//

//gestionnnaire stock pages
    Route::prefix('/gestionnnaire/stock')->middleware('auth:geststock')->name('geststock.')->group(function(){
        Route::get('/home' , [GeststockPageController::class,'home'])->name('home');
        Route::post('/logout', [GeststockPageController::class, 'logout'])->name('logout');

        //entrepôt
            Route::resource('/categorie', GeststockCategorieController::class);
            // Route::get('/mes/entrepot/produit/{categorie}' , [GeststockCategorieController::class,'categorieProduit'])->name('categorie.produit');
            Route::get('/entrepot/categorie/{categorie}' , [GeststockCategorieController::class,'entrepotCategorie'])->name('entrepot.categorie');
            Route::get('/entrepot/categorie/produit/{entrepotcateg}' , [GeststockCategorieController::class,'entrepotCategorieProduit'])->name('entrepot.categorie.produit');
        //
        //categorie de produit
            Route::resource('/categorieprod', GeststockCategorieProduitController::class);
        //
        //entrepot categorie 
            Route::post('/entrepot/categorie/store/un/{categorie}' , [GeststockEntrepotCategorieController::class,'entrepotCategorieStoreUn'])->name('entrepotcateg.store');
            Route::post('/entrepot/categorie/store/deux' , [GeststockEntrepotCategorieController::class,'entrepotCategorieStoreDeux'])->name('entrepotcategs.store');
            Route::delete('/entrepot/categorie/destroy/{entrepotcateg}' , [GeststockEntrepotCategorieController::class,'entrepotCategorieDestroy'])->name('entrepotcateg.destroy');
        //

        //projet
            Route::get('/projet', [GeststockPageController::class, 'projet'])->name('projet');
        //
        //confirme livraison
            Route::get('/factures/emises', [GeststockPageController::class, 'factureEmise'])->name('facture.emise');
            Route::get('/factures/encours/livraison', [GeststockPageController::class, 'factureEncoursLivraison'])->name('facture.encours.livraison');
            Route::get('/factures/livrees', [GeststockPageController::class, 'factureLivre'])->name('facture.livre');
            Route::get('/facture/client/detail/{clientdevis}' , [GeststockPageController::class,'factureClientDetail'])->name('facture.client.detail');
        //

        //facture location livrés
            Route::get('/factures/location/livrees/sans/retour', [GeststockPageController::class, 'factureLocationLivreSansRetour'])->name('facture.location.livre.sans.retour');
            Route::get('/factures/location/livrees/avec/retour', [GeststockPageController::class, 'factureLocationLivreAvecRetour'])->name('facture.location.livre.avec.retour');
        // 

        //produit
            Route::resource('/produit', GeststockProduitController::class);
        //
        //fournisseur
            Route::resource('/fournisseur', GeststockFournisseurController::class);
        //
        //Fournisseur facture add produit
            Route::get('/facture/fournisseur/detail/{fournisseurfacturecomptable}' , [GeststockPageController::class,'factureFournisseurDetail'])->name('facture.fournisseur.detail');
            Route::get('/fournisseur/facture/add/produit/{fournisseurfacturecomptable}' , [GeststockPageController::class,'fournisseurFactureAddProduit'])->name('fournisseur.facture.add.produit');
        //
        //fournisseur facture emise et receptionné
            //fournisseur
                Route::get('/facture/fournisseur/reception/encours/{fournisseur}' , [GeststockPageController::class,'factureFournisseurReceptionEncours'])->name('facture.fournisseur.reception.encours');
                Route::get('/facture/fournisseur/reception/valide/{fournisseur}' , [GeststockPageController::class,'factureFournisseurReceptionValide'])->name('facture.fournisseur.reception.valide');
            //
            //generale
                Route::get('/generale/facture/fournisseur/reception/encours' , [GeststockPageController::class,'generaleFactureFournisseurReceptionEncours'])->name('generale.facture.fournisseur.reception.encours');
                Route::get('/generale/facture/fournisseur/reception/valide' , [GeststockPageController::class,'generaleFactureFournisseurReceptionValide'])->name('generale.facture.fournisseur.reception.valide');
            //
        //
        //fournisseur facture
            Route::resource('/fournisseurfacture', GeststockFournisseurFactureController::class);

            Route::get('/fournisseur/facture/{fournisseur}', [GeststockFournisseurFactureController::class, 'fournisseurFacture'])->name('fournisseur.facture');
            Route::get('/fournisseur/facture/detail/{fournisseurfacture}', [GeststockFournisseurFactureController::class, 'fournisseurFactureDetail'])->name('fournisseur.facture.detail');
            Route::get('/fournisseur/facture/create/{fournisseur}/{produit}', [GeststockFournisseurFactureController::class, 'fournisseurFactureCreate'])->name('fournisseur.facture.create');
            Route::post('/fournisseur/facture/store', [GeststockFournisseurFactureController::class, 'fournisseurFactureStore'])->name('fournisseur.facture.store');
            Route::post('/fournisseur/facture/store/add/{fournisseur}/{produit}', [GeststockFournisseurFactureController::class, 'fournisseurFactureStoreAdd'])->name('fournisseur.facture.store.add');

            Route::get('/facture/fournisseur/invalide', [GeststockFournisseurFactureController::class, 'fournisseurFactureInvalide'])->name('fournisseur.facture.invalide');
            Route::get('/facture/fournisseur/valide', [GeststockFournisseurFactureController::class, 'fournisseurFactureValide'])->name('fournisseur.facture.valide');
        //
        //stock
            Route::get('/Stock/des/produits/{entrepotcateg}', [GeststockStockProduitController::class, 'StockProduitUn'])->name('stock.global.produit');
            Route::post('/quantite/produit/update/{produit}', [GeststockStockProduitController::class, 'quantiteProduitUpdate'])->name('quantite.produit.update');
            Route::get('/entrées/sorties/produits', [GeststockStockProduitController::class, 'StockProduitDeux'])->name('stock.global.produit.deux');
        //
        //commande
            //client
                // Route::get('/commande/client/validés' , [GeststockCommandeController::class,'commandeClientValide'])->name('commande.client.valide');
                // Route::get('/commande/client/livrés' , [GeststockCommandeController::class,'commandeClientLivre'])->name('commande.client.livre');
                // Route::get('/commande/client/detail/{clientdevis}' , [GeststockCommandeController::class,'commandeClientDetail'])->name('commande.client.detail');
                // Route::post('/confirme/livraison/commande/client/{clientdevis}' , [GeststockCommandeController::class,'confirmeLivraisonCommandeClient'])->name('confirme.livraison.commande.client');
            //

            //client all facture
                // Route::get('/all/facture/client' , [GeststockCommandeController::class,'allFactureClient'])->name('all.facture.client');
            //
        //
        //profil
            Route::get('/mon/profil' , [GeststockProfilController::class,'profil'])->name('profil');
            Route::patch('/profil/update', [GeststockProfilController::class, 'profilUpdate'])->name('profil.update');
        //

    });
//
