<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Geststock\GeststockCommercialFactureController;
use App\Http\Controllers\Geststock\GeststockGestionnaireStockController;
use App\Http\Controllers\Commun\Packauto\CommunPackautoVehiculeController;

//Auth , Commun , Principale
    use App\Http\Controllers\Auth\LoginController;

    use App\Http\Controllers\Commun\FournisseurController;
    use App\Http\Controllers\Commun\ProjetController;
    use App\Http\Controllers\Commun\CommunPageController;
    use App\Http\Controllers\Commun\ProjetTacheController;
    use App\Http\Controllers\Commun\CommunProduitController;
    use App\Http\Controllers\Commun\CommunEtablirFactureClientController;
    use App\Http\Controllers\Commun\FournisseurFactureComptableController;
    use App\Http\Controllers\Commun\reglage\CommunMoyenPaiementController;

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
    use App\Http\Controllers\Comptable\ComptableController;
    use App\Http\Controllers\Comptable\newFonction\ComptableFournisseurFactureComptableController;

    use App\Http\Controllers\Comptable\reglage\ComptableDelaipayController;
    use App\Http\Controllers\Comptable\newFonction\ComptableEtablirFactureClientController;
//
//Geststock
    use App\Http\Controllers\Geststock\GeststockCategorieProduitController;
    use App\Http\Controllers\Geststock\GeststockEntrepotCategorieController;   
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
    use App\Http\Controllers\Packauto\PackautoCategorieVehiculeController;
    use App\Http\Controllers\Packauto\PackautoPageController;
    use App\Http\Controllers\Packauto\PackautoProfilController;
    use App\Http\Controllers\Packauto\PackautoVehiculeController;
    use App\Http\Controllers\Packauto\PackautoDemandeCarburantController;
    use App\Http\Controllers\Packauto\PackautoChauffeurController;
    use App\Http\Controllers\Packauto\PackautoVehiculeDocNameController;
    use App\Http\Controllers\Packauto\PackautoChauffeurDocNameController;
    
    use App\Http\Controllers\Packauto\PackautoPanneController;
    use App\Http\Controllers\Packauto\PackautoAccidentController;
    use App\Http\Controllers\Packauto\PackautoEntretienController;
    use App\Http\Controllers\Packauto\PackautoVehiculeDocController;
    use App\Http\Controllers\Packauto\PackautoChauffeurDocController;
    use App\Http\Controllers\Packauto\PackautoEmpruntAffectationController;
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
        Route::get('/pdf/bon/livraison/{clientdevis}', [PdfDevisCommandePageController::class, 'pdfBonLivraison'])->name('pdf.bon.livraison');

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

            //creation
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

        //presence renvoyé par qrcode
            Route::get('/formulaire/presence', [CommunPageController::class, 'formulairePresence'])->name('formulaire.presence');
            Route::post('/formulaire/presence/store', [CommunPageController::class, 'formulairePresenceStore'])->name('formulaire.presence.store');
        //

        //vehicule renvoyé par qrcode
            Route::get('/emprunt/vehicule/generale', [CommunPackautoVehiculeController::class, 'empruntVehiculeGenerale'])->name('emprunt.vehicule.generale');
            Route::get('/emprunt/vehicule/{pvehicule}', [CommunPackautoVehiculeController::class, 'empruntVehicule'])->name('emprunt.vehicule');
            Route::post('/emprunt/vehicule/store', [CommunPackautoVehiculeController::class, 'empruntVehiculeStore'])->name('emprunt.vehicule.store');
        
            Route::get('/panne/vehicule/generale', [CommunPackautoVehiculeController::class, 'panneVehiculeGenerale'])->name('panne.vehicule.generale');
            Route::get('/panne/vehicule/{pvehicule}', [CommunPackautoVehiculeController::class, 'panneVehicule'])->name('panne.vehicule');
            Route::post('/panne/vehicule/store', [CommunPackautoVehiculeController::class, 'panneVehiculeStore'])->name('panne.vehicule.store');
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
            //convertir facture en vente, location ou prestation
                Route::post('/facture/client/convertir/{clientdevis}' , [CommunEtablirFactureClientController::class,'factureClientConvertir'])->name('facture.client.convertir');
            //
            //Archiver
                Route::post('/archiver/clientdevis/{clientdevis}' , [CommunEtablirFactureClientController::class,'archiveClientdevis'])->name('archive.clientdevis');
            //
        //
    
        //client devis 
            Route::delete('/client/devis/destroy/{clientdevis}' , [CommunPageController::class,'ClientdevisDestroy'])->name('client.devis.destroy');
            Route::post('/produit/prix/update/{produit}' , [CommunPageController::class,'produitPrixUpdate'])->name('produit.prix.update');
           
            Route::post('/client/devis/transaction/store/{clientdevis}' , [CommunPageController::class,'clientDevisTransactionStore'])->name('client.devis.transaction.store');
            Route::post('/client/devis/add/bon/{clientdevis}' , [CommunPageController::class,'clientDevisAddBon'])->name('client.devis.add.bon');
            Route::patch('/client/devis/update/{clientdevis}' , [CommunPageController::class,'clientDevisUpdate'])->name('client.devis.update');

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

        // //QR code vehicule
        //     Route::get('/liste/presence', [RessourcePageController::class, 'listePresence'])->name('liste.presence');
        //     Route::get('/liste/presence/employe/{ids}/{date}', [RessourcePageController::class, 'listePresenceEmploye'])->name('liste.presence.employe');
        //     Route::get('/qrcode/presence/employe', [RessourcePageController::class, 'presenceQrcodePdf'])->name('qrcode.presence.employe');
        // //
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
            Route::get('/moyens/de/paiement' , [ComptablePageController::class,'MoyenPaiement'])->name('moyen.paiement');
        //

    










        

        //fournisseur
            Route::get('/fournisseur/facture/detail/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureDetail'])->name('fournisseur.facture.detail');
            Route::post('/add/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureAdd'])->name('fournisseur.facture.add');
            Route::get('/fournisseur/facture/etat/update/{fournisseurfacture}', [ComptableFournisseurFactureController::class, 'fournisseurFactureEtatUpdate'])->name('fournisseur.facture.etat.update');
            Route::get('/facture/fournisseur/invalide', [ComptableFournisseurFactureController::class, 'fournisseurFactureInvalide'])->name('fournisseur.facture.invalide');
            Route::get('/facture/fournisseur/valide', [ComptableFournisseurFactureController::class, 'fournisseurFactureValide'])->name('fournisseur.facture.valide');
        // 
        // //Suivi de la trésorerie
        //     Route::get('/consultation/flux', [ComptableSuiviTresorerieController::class, 'consultationFlux'])->name('consultation.flux');
        //     Route::get('/suivi/paiement', [ComptableSuiviTresorerieController::class, 'suiviPaiement'])->name('suivi.paiement');
        //     Route::get('/suivi/alerte/anomalie', [ComptableSuiviTresorerieController::class, 'suiviAlerteAnomalie'])->name('suivi.alerte.anomalie');
        // //  
        // //Exports et éditions
        //     Route::get('/export/comptable', [ComptablePageController::class, 'exportComptable'])->name('export.comptable');
        //     Route::get('/filtrage/donnees', [ComptablePageController::class, 'filtrageDonnee'])->name('filtrage.donnee');
        //     Route::get('/journaux/comptable', [ComptablePageController::class, 'journauxComptable'])->name('journaux.comptable');
        // //   
        // //Intégration avec un cabinet comptable
        //     Route::get('/fichier/comptable', [ComptablePageController::class, 'fichierComptable'])->name('fichier.comptable');
        //     Route::get('/export/fichier', [ComptablePageController::class, 'exportFichier'])->name('export.fichier');
        // //    
        // //recette
        //     Route::get('/suivi/recette', [ComptablePageController::class, 'suiviRecette'])->name('suivi.recette');
        // //
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
            // Route::get('/responsable/commercial/client', [CommercialClientController::class, 'responsableCommercialClient'])->name('responsable.commercial.client');
        //

        //devis 
            //client
                Route::get('/devis/client/create/etape1' , [CommercialDevisController::class,'devisClientCreate'])->name('devis.client.create');
                Route::post('/devis/client/store/etape1' , [CommercialDevisController::class,'devisClientStore'])->name('devis.client.store');
                Route::get('/devis/client/create/etape2/{clientdevis}' , [CommercialDevisController::class,'devisClientCreateDeux'])->name('devis.client.create.deux');
                Route::get('/devis/client/create/etape2/prestation/{clientdevis}' , [CommercialDevisController::class,'devisClientCreateDeuxPrestation'])->name('devis.client.create.deux.prestation');
                Route::post('/devis/client/store/etape2/{clientdevis}/{produit}' , [CommercialDevisController::class,'devisClientStoreDeux'])->name('devis.client.store.deux');
                
                Route::post('/produit/devis/qty/update/{clientdevisprod}' , [CommercialDevisController::class,'devisProduitQtyUpdate'])->name('produit.devis.qty.update');
                Route::get('/produit/devis/destroy/{clientdevisprod}' , [CommercialDevisController::class,'devisProduitDestroy'])->name('produit.devis.destroy');
            //
            
            Route::post('/facture/client/store/etape2/{clientdevis}/{produit}' , [CommercialDevisController::class,'factureClientStoreDeux'])->name('facture.client.store.deux');
            Route::post('/produit/facture/qty/update/{clientdevisprod}' , [CommercialDevisController::class,'factureProduitQtyUpdate'])->name('produit.facture.qty.update');
            Route::get('/produit/facture/destroy/{clientdevisprod}' , [CommercialDevisController::class,'factureProduitDestroy'])->name('produit.facture.destroy');

            //prestation
                Route::post('/clientdevis/prestation/store/{clientdevis}' , [CommercialDevisController::class,'clientdevisPrestationStore'])->name('clientdevis.prestation.store');
                Route::post('/clientdevis/prestation/update/{clientdevisprestation}' , [CommercialDevisController::class,'clientdevisPrestationUpdate'])->name('clientdevis.prestation.update');
                Route::delete('/clientdevis/prestation/destroy/{clientdevisprestation}' , [CommercialDevisController::class,'clientdevisPrestationDestroy'])->name('clientdevis.prestation.destroy');
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
    });
//

//pack auto pages
    Route::prefix('/pack/auto')->middleware('auth:packauto')->name('packauto.')->group(function(){
        Route::get('/home' , [PackautoPageController::class,'home'])->name('home');
        Route::post('/logout', [PackautoPageController::class, 'logout'])->name('logout');

        //categorie de vehicule
            Route::resource('/pcategorievehicule', PackautoCategorieVehiculeController::class);
            Route::get('/categorie/vehicule/{pcategorievehicule}' , [PackautoCategorieVehiculeController::class,'categorieVehicule'])->name('categorie.vehicule');
        //
        //all véhicules            
            Route::resource('/pvehicule', PackautoVehiculeController::class);
            Route::resource('/pvehiculedocname', PackautoVehiculeDocNameController::class);
            Route::get('/vehicules/disponible', [PackautoVehiculeController::class, 'vehiculeDisponible'])->name('vehicule.disponible');
            Route::get('/vehicules/emprunt', [PackautoVehiculeController::class, 'vehiculeEmprunte'])->name('vehicule.emprunte');
            Route::get('/vehicules/maintenance', [PackautoVehiculeController::class, 'vehiculeMaintenance'])->name('vehicule.maintenance');

            Route::post('/vehicule/document/store/{pvehicule}' , [PackautoVehiculeDocController::class,'vehiculeDocumentStore'])->name('vehicule.document.store');
            Route::patch('/vehicule/document/store/{pvehiculedoc}' , [PackautoVehiculeDocController::class,'vehiculeDocumentUpdate'])->name('vehicule.document.update');
            Route::delete('/vehicule/document/store/{pvehiculedoc}' , [PackautoVehiculeDocController::class,'vehiculeDocumentDestroy'])->name('vehicule.document.destroy');
        //
        //QR code vehicule
            Route::get('/qrcode/emprunt/vehicule/generale', [PackautoPageController::class, 'qrcodeEmpruntVehiculeGenerale'])->name('qrcode.emprunt.vehicule.generale');
            Route::get('/qrcode/emprunt/vehicule/{pvehicule}', [PackautoPageController::class, 'qrcodeEmpruntVehicule'])->name('qrcode.emprunt.vehicule');

            Route::get('/qrcode/panne/vehicule/generale', [PackautoPageController::class, 'qrcodePanneVehiculeGenerale'])->name('qrcode.panne.vehicule.generale');
            Route::get('/qrcode/panne/vehicule/{pvehicule}', [PackautoPageController::class, 'qrcodePanneVehicule'])->name('qrcode.panne.vehicule');
        //
        //chauffeur
            Route::resource('/pchauffeur', PackautoChauffeurController::class);
            Route::resource('/pchauffeurdocname', PackautoChauffeurDocNameController::class);

            Route::post('/chauffeur/document/store/{pchauffeur}' , [PackautoChauffeurDocController::class,'chauffeurDocumentStore'])->name('chauffeur.document.store');
            Route::patch('/chauffeur/document/store/{pchauffeurdoc}' , [PackautoChauffeurDocController::class,'chauffeurDocumentUpdate'])->name('chauffeur.document.update');
            Route::delete('/chauffeur/document/store/{pchauffeurdoc}' , [PackautoChauffeurDocController::class,'chauffeurDocumentDestroy'])->name('chauffeur.document.destroy');
        //
        //panne
            Route::resource('/ppanne', PackautoPanneController::class);
            Route::post('/panne/attester/{ppanne}', [PackautoPanneController::class, 'panneAttester'])->name('panne.attester');
            Route::patch('/panne/attester/update/{pentretien}', [PackautoPanneController::class, 'panneAttesterUpdate'])->name('panne.attester.update');

            Route::get('/panne/encours', [PackautoPanneController::class, 'panneEncours'])->name('panne.encours');
            Route::get('/panne/entretenu', [PackautoPanneController::class, 'panneEntretenu'])->name('panne.entretenu');
        //
        //entretien
            Route::get('/entretien/panne', [PackautoEntretienController::class, 'entretienPanne'])->name('entretien.panne');
            // Route::get('/entretien/detail/panne/{pentretien}', [PackautoEntretienController::class, 'entretienDetailPanne'])->name('entretien.detail.panne');
        //
        //emprunt et affectaion
            Route::resource('/paffectation', PackautoEmpruntAffectationController::class);
            Route::post('/approuve/emprunt/{paffectation}', [PackautoEmpruntAffectationController::class, 'approuveEmprunt'])->name('approuve.emprunt');
            Route::post('/cloture/emprunt/{paffectation}', [PackautoEmpruntAffectationController::class, 'clotureEmprunt'])->name('cloture.emprunt');
            // Route::post('/rejet/emprunt/{paffectation}', [PackautoEmpruntAffectationController::class, 'rejetEmprunt'])->name('rejet.emprunt');

            Route::get('/emprunt/en/attente', [PackautoEmpruntAffectationController::class, 'empruntEnAttente'])->name('emprunt.en.attente');
            Route::get('/emprunt/encours', [PackautoEmpruntAffectationController::class, 'empruntEncours'])->name('emprunt.encours');
            Route::get('/emprunt/general', [PackautoEmpruntAffectationController::class, 'empruntGeneral'])->name('emprunt.general');
            
            Route::get('/affectaion/encours', [PackautoEmpruntAffectationController::class, 'affectaionEncours'])->name('affectaion.encours');
            Route::get('/affectaion/general', [PackautoEmpruntAffectationController::class, 'affectaionGeneral'])->name('affectaion.general');
        //
        //accident
            Route::get('/all/accident', [PackautoAccidentController::class, 'accident'])->name('accident');
            Route::get('/accident/detail/{paccident}', [PackautoAccidentController::class, 'accidentDetail'])->name('accident.detail');
            Route::get('/accident/rapport/{paccident}', [PackautoAccidentController::class, 'accidentRapport'])->name('accident.rapport');
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

        //Rgeststock
            Route::resource('/rgeststock', GeststockGestionnaireStockController::class);
            Route::get('/gestionnaire/compte/update/{rgeststock}' , [GeststockGestionnaireStockController::class,'geststockCompteUpdate'])->name('geststock.compte.update');
        //
        //Commercial
            Route::get('/all/commercial' , [GeststockCommercialFactureController::class,'allCommercial'])->name('all.commercial');
            
            //facture client
                Route::get('/commercial/facture/client/create/etape1/{commercial}' , [GeststockCommercialFactureController::class,'geststockFactureClientCreate'])->name('commercial.facture.client.create');
                Route::post('/commercial/facture/client/store/etape1/{commercial}' , [GeststockCommercialFactureController::class,'geststockFactureClientStore'])->name('commercial.facture.client.store');
                //vente et location
                    Route::get('/commercial/facture/client/create/etape2/{clientdevis}' , [GeststockCommercialFactureController::class,'geststockFactureClientCreateDeux'])->name('commercial.facture.client.create.deux');

                    Route::post('/commercial/facture/client/store/etape2/{clientdevis}/{produit}' , [GeststockCommercialFactureController::class,'devisClientStoreDeux'])->name('devis.client.store.deux');
                    Route::post('/commercial/facture/produit/devis/qty/update/{clientdevisprod}' , [GeststockCommercialFactureController::class,'devisProduitQtyUpdate'])->name('produit.devis.qty.update');
                    Route::get('/commercial/facture/produit/devis/destroy/{clientdevisprod}' , [GeststockCommercialFactureController::class,'devisProduitDestroy'])->name('produit.devis.destroy');
                //
                //prestation
                    Route::get('/commercial/facture/client/create/etape2/prestation/{clientdevis}' , [GeststockCommercialFactureController::class,'geststockFactureClientPrestationDeux'])->name('commercial.facture.client.prestation.deux');
                //

                //facture client etablie
                    Route::get('/commercial/facture/client/etablie/{commercial}' , [GeststockCommercialFactureController::class,'geststockFactureClientEtablie'])->name('commercial.facture.client.etablie');
                    Route::get('/facture/client/etablie/generale' , [GeststockCommercialFactureController::class,'geststockFactureClientEtablieGenerale'])->name('commercial.facture.client.etablie.general');
                //
            //
        //
        //bilan des affaires
            Route::get('/bilan/factures/filtrer', [GeststockPageController::class, 'bilanFactureFiltrer'])->name('bilan.facture.filtrer');
        //
        //produit
            Route::resource('/produit', GeststockProduitController::class);
            Route::get('/classement/produit/vendu', [GeststockPageController::class, 'classementProduitVendu'])->name('classement.produit.vendu');
        //





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

        //fournisseur
            Route::resource('/fournisseur', GeststockFournisseurController::class);
        //
        //Fournisseur facture add produit
            Route::get('/facture/fournisseur/detail/{fournisseurfacturecomptable}' , [GeststockPageController::class,'factureFournisseurDetail'])->name('facture.fournisseur.detail');
            Route::get('/fournisseur/facture/add/produit/{fournisseurfacturecomptable}' , [GeststockPageController::class,'fournisseurFactureAddProduit'])->name('fournisseur.facture.add.produit');
        //
        //fournisseur facture comptable
            //fournisseur
                Route::get('/facture/fournisseur/reception/encours/{fournisseur}' , [GeststockPageController::class,'factureFournisseurReceptionEncours'])->name('facture.fournisseur.reception.encours');
                Route::get('/facture/fournisseur/reception/valide/{fournisseur}' , [GeststockPageController::class,'factureFournisseurReceptionValide'])->name('facture.fournisseur.reception.valide');
            //
            //generale
                Route::get('/general/facture/fournisseur/encours' , [GeststockPageController::class,'generaleFactureFournisseurReceptionEncours'])->name('generale.facture.fournisseur.reception.encours');
                Route::get('/general/facture/fournisseur/valide' , [GeststockPageController::class,'generaleFactureFournisseurReceptionValide'])->name('generale.facture.fournisseur.reception.valide');
            //
        //
        //fournisseur facture
            //fournisseur
                Route::get('/fournisseur/{fournisseur}/facture/reception/encours' , [GeststockFournisseurFactureController::class,'fournisseurFactureReceptionEncours'])->name('fournisseur.facture.reception.encours');
                Route::get('/fournisseur/{fournisseur}/facture/reception/recu' , [GeststockFournisseurFactureController::class,'fournisseurFactureReceptionRecu'])->name('fournisseur.facture.reception.recu');
            //
            //generale
                Route::get('/generale/facture/fournisseur/reception/encours' , [GeststockFournisseurFactureController::class,'generaleFournisseurFactureReceptionEncours'])->name('generale.fournisseur.facture.reception.encours');
                Route::get('/generale/facture/fournisseur/reception/recu' , [GeststockFournisseurFactureController::class,'generaleFournisseurFactureReceptionRecu'])->name('generale.fournisseur.facture.reception.recu');
                Route::get('/generale/facture/fournisseur/reception/valide' , [GeststockFournisseurFactureController::class,'generaleFournisseurFactureReceptionValide'])->name('generale.fournisseur.facture.reception.valide');
            //
            //ressource
                Route::resource('/fournisseurfacture', GeststockFournisseurFactureController::class);
            //
            //creation
                Route::get('/fournisseur/confirme/creation/facture/{fournisseur}' , [GeststockFournisseurFactureController::class,'fournisseurConfirmeCreationFacture'])->name('fournisseur.confirme.creation.facture');
                Route::get('/facture/fournisseur/produit/{fournisseurfacture}' , [GeststockFournisseurFactureController::class,'fournisseurFactureProduit'])->name('fournisseur.facture.produit');
                Route::post('/facture/fournisseur/ajout/produit/{fournisseurfacture}/{produit}' , [GeststockFournisseurFactureController::class,'fournisseurFactureAddProduit'])->name('fournisseur.facture.add.produit');
                Route::post('/facture/fournisseur/edit/produit/{fournisseurfactureprod}' , [GeststockFournisseurFactureController::class,'fournisseurFactureEditProduit'])->name('fournisseur.facture.edit.produit');
                Route::get('/facture/fournisseur/destroy/produit/{fournisseurfactureprod}' , [GeststockFournisseurFactureController::class,'fournisseurFactureDestroyProduit'])->name('fournisseur.facture.destroy.produit');
            //
            //confirme reception et conformité
                Route::get('/facture/fournisseur/confirme/reception/{fournisseurfacture}' , [GeststockFournisseurFactureController::class,'fournisseurFactureConfirmeReception'])->name('fournisseur.facture.confirme.reception');
                Route::get('/facture/fournisseur/confirme/conformité/{fournisseurfacture}' , [GeststockFournisseurFactureController::class,'fournisseurFactureConfirmeConformite'])->name('fournisseur.facture.confirme.conformite');
            //
        //
        //fournisseur facture

            Route::get('/fournisseur/facture/{fournisseur}', [GeststockFournisseurFactureController::class, 'fournisseurFacture'])->name('fournisseur.facture');
            Route::get('/fournisseur/facture/detail/{fournisseurfacture}', [GeststockFournisseurFactureController::class, 'fournisseurFactureDetail'])->name('fournisseur.facture.detail');
            Route::get('/fournisseur/facture/create/{fournisseur}/{produit}', [GeststockFournisseurFactureController::class, 'fournisseurFactureCreate'])->name('fournisseur.facture.create');
            Route::post('/fournisseur/facture/store', [GeststockFournisseurFactureController::class, 'fournisseurFactureStore'])->name('fournisseur.facture.store');
            Route::post('/fournisseur/facture/store/add/{fournisseur}/{produit}', [GeststockFournisseurFactureController::class, 'fournisseurFactureStoreAdd'])->name('fournisseur.facture.store.add');

            Route::get('/facture/fournisseur/invalide', [GeststockFournisseurFactureController::class, 'fournisseurFactureInvalide'])->name('fournisseur.facture.invalide');
            Route::get('/facture/fournisseur/valide', [GeststockFournisseurFactureController::class, 'fournisseurFactureValide'])->name('fournisseur.facture.valide');
        //
        //stock
            Route::get('/Stock/des/produits-par-entrepot/{categorie}', [GeststockStockProduitController::class, 'StockProduitUn'])->name('stock.global.produit');
            Route::get('/Stock/des/produits-par-famille/{entrepotcateg}', [GeststockStockProduitController::class, 'StockFamilleProduitUn'])->name('stock.global.famille.produit');
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
