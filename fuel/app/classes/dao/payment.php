<?php

class Dao_Payment {
    public static $StatusInit = "INIT";
    public static $StatusApproved = "APPROVED";
    public static $StatusDeclined = "DECLINED";
    public static $StatusCanceled = "CANCELED";
    
    public static $Mois = [
        '1' => 'Janvier',
        '2' => 'Février',
        '3' => 'Mars',
        '4' => 'Avril',
        '5' => 'Mai',
        '6' => 'Juin',
        '7' => 'Juillet',
        '8' => 'Août',
        '9' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre',
    ];

    //
    public static function persist($id_user, $est_teledeclaree = true) {
        /*$declaration = new Model_Declaration();
        $declaration->mois_concerne = self::$Mois[(Input::post('cle_mois'))];
        $declaration->annee_concernee = trim(Input::post('annee_concernee')); 
       
        $declaration->statut = self::$StatutTraitement;
        $declaration->est_preparee = $declaration->est_calculee = $declaration->est_signee = $declaration->est_envoyee = $declaration->est_apuree = false;  
        $declaration->est_enregistree = true;
        $declaration->est_teledeclaree = $est_teledeclaree;
        $gestionnaire = Dao_Gestionnaire::getOneWithRelated($id_user);
        $declaration->etablissement = $gestionnaire->etablissement;
        $declaration->auteur_id = $id_user;
        $declaration->numero =  $gestionnaire->etablissement->rccm.'-'.self::getNextId().'-'.date('m-Y');
        
        $unite_hebergement_id = Input::post('unite_hebergement_id', null);
        if (null != $unite_hebergement_id) {
            $ligne_declaration = new Model_LigneDeclaration(); 
           // $ligne_declaration->nombre_unites_vendues = Input::post('nombre_unites_vendues');
            $ligne_declaration->montant_declare_cdf = floatval(Input::post('montant_declare_cdf_hebergement'));
            $ligne_declaration->montant_declare_usd = floatval(Input::post('montant_declare_usd_hebergement'));
            $ligne_declaration->taux_redevance_appliquee = floatval(Input::post('taux_redevance_hebergement'));
            $ligne_declaration->taux_subvention_appliquee = floatval(Input::post('taux_subvention_hebergement'));
            $ligne_declaration->auteur_id = $declaration->auteur_id;
            $ligne_declaration->acte_generateur = Dao_ActeGenerateur::getOneByNature(Dao_ActeGenerateur::$NatureHebergement);
            $ligne_declaration->unite_touristique_id = (int)Input::post('unite_hebergement_id');
            
            $declaration->lignes_declaration[] = $ligne_declaration;
        }

        $unites_restauration = Input::post('unites_restauration', null);
        if (null != $unites_restauration) {
            $montants_declares_cdf_restauration = Input::post('montants_declares_cdf_restauration');
            $montants_declares_usd_restauration = Input::post('montants_declares_usd_restauration');

            for ($i=0; $i < count($unites_restauration); $i++) { 
                $unite_restauration_id = $unites_restauration[$i];

                $ligne_declaration = new Model_LigneDeclaration(); 
                // $ligne_declaration->nombre_unites_vendues = Input::post('nombre_unites_vendues');
                 $ligne_declaration->montant_declare_cdf =  floatval($montants_declares_cdf_restauration[$unite_restauration_id.'']);
                 $ligne_declaration->montant_declare_usd = floatval($montants_declares_usd_restauration[$unite_restauration_id.'']);
                 $ligne_declaration->taux_redevance_appliquee = floatval(Input::post('taux_redevance_restauration'));
                 $ligne_declaration->taux_subvention_appliquee = floatval(Input::post('taux_subvention_restauration'));
                 $ligne_declaration->auteur_id = $declaration->auteur_id;
                 $ligne_declaration->acte_generateur = Dao_ActeGenerateur::getOneByNature(Dao_ActeGenerateur::$NatureRestauration);
                 $ligne_declaration->unite_touristique_id = (int) $unite_restauration_id;
            
                 $declaration->lignes_declaration[] = $ligne_declaration;
            }
        }
        // Savechanges
        return $declaration->save() ? $declaration : null;*/
    }

    //
    public static function persistDirect() {
        $payment = new Model_Payment();
        $declaration->mois_concerne = self::$Mois[(Input::post('cle_mois'))];
        $declaration->annee_concernee = trim(Input::post('annee_concernee')); 
       
        $declaration->statut = self::$StatutTraitement;
        $declaration->est_preparee = $declaration->est_calculee = $declaration->est_signee = $declaration->est_envoyee = $declaration->est_apuree = false;  
        $declaration->est_enregistree = true;
        $declaration->est_teledeclaree = $est_teledeclaree;
        $gestionnaire = Dao_Gestionnaire::getOneWithRelated($id_user);
        $declaration->etablissement = $gestionnaire->etablissement;
        $declaration->auteur_id = $id_user;
        $declaration->numero =  $gestionnaire->etablissement->rccm.'-'.self::getNextId().'-'.date('m-Y');
        
        $unite_hebergement_id = Input::post('unite_hebergement_id', null);
        if (null != $unite_hebergement_id) {
            $ligne_declaration = new Model_LigneDeclaration(); 
           // $ligne_declaration->nombre_unites_vendues = Input::post('nombre_unites_vendues');
            $ligne_declaration->montant_declare_cdf = floatval(Input::post('montant_declare_cdf_hebergement'));
            $ligne_declaration->montant_declare_usd = floatval(Input::post('montant_declare_usd_hebergement'));
            $ligne_declaration->taux_redevance_appliquee = floatval(Input::post('taux_redevance_hebergement'));
            $ligne_declaration->taux_subvention_appliquee = floatval(Input::post('taux_subvention_hebergement'));
            $ligne_declaration->auteur_id = $declaration->auteur_id;
            $ligne_declaration->acte_generateur = Dao_ActeGenerateur::getOneByNature(Dao_ActeGenerateur::$NatureHebergement);
            $ligne_declaration->unite_touristique_id = (int)Input::post('unite_hebergement_id');
            
            $declaration->lignes_declaration[] = $ligne_declaration;
        }

        $unites_restauration = Input::post('unites_restauration', null);
        if (null != $unites_restauration) {
            $montants_declares_cdf_restauration = Input::post('montants_declares_cdf_restauration');
            $montants_declares_usd_restauration = Input::post('montants_declares_usd_restauration');

            for ($i=0; $i < count($unites_restauration); $i++) { 
                $unite_restauration_id = $unites_restauration[$i];

                $ligne_declaration = new Model_LigneDeclaration(); 
                // $ligne_declaration->nombre_unites_vendues = Input::post('nombre_unites_vendues');
                 $ligne_declaration->montant_declare_cdf =  floatval($montants_declares_cdf_restauration[$unite_restauration_id.'']);
                 $ligne_declaration->montant_declare_usd = floatval($montants_declares_usd_restauration[$unite_restauration_id.'']);
                 $ligne_declaration->taux_redevance_appliquee = floatval(Input::post('taux_redevance_restauration'));
                 $ligne_declaration->taux_subvention_appliquee = floatval(Input::post('taux_subvention_restauration'));
                 $ligne_declaration->auteur_id = $declaration->auteur_id;
                 $ligne_declaration->acte_generateur = Dao_ActeGenerateur::getOneByNature(Dao_ActeGenerateur::$NatureRestauration);
                 $ligne_declaration->unite_touristique_id = (int) $unite_restauration_id;
            
                 $declaration->lignes_declaration[] = $ligne_declaration;
            }
        }
        // Savechanges
        return $declaration->save() ? $declaration : null;
    }
  
    //
    public static function update($id_declaration, $id_user) {
        $is_done = false;
        $declaration = Model_Declaration::find($id_declaration);
        $mois_concerne = self::$Mois[(Input::post('cle_mois'))];
        $annee_concernee = trim(Input::post('annee_concernee'));

        if($declaration->mois_concerne != $mois_concerne || $declaration->annee_concernee != $annee_concernee) {
            $declaration->mois_concerne = $mois_concerne;
            $declaration->annee_concernee = $annee_concernee;
            $declaration->auteur_id = $id_user;
            $is_done = $declaration->save();
        } else {
            $declaration->date_denregistrement = Utils::RenvoyerNow();
            $is_done = $declaration->save();
        }

        if(!$is_done) return false;
        
        $ligne_hebergement_id = Input::post('ligne_hebergement_id', null);
        if (null != $ligne_hebergement_id) {
            $ligne_declaration = Model_LigneDeclaration::find($ligne_hebergement_id);
            $montant_declare_cdf = floatval(Input::post('montant_declare_cdf_hebergement'));
            $montant_declare_usd = floatval(Input::post('montant_declare_usd_hebergement'));

            if($ligne_declaration->montant_declare_cdf != $montant_declare_cdf 
            || $ligne_declaration->montant_declare_usd != $montant_declare_usd) {
                $ligne_declaration->montant_declare_cdf = $montant_declare_cdf;
                $ligne_declaration->montant_declare_usd = $montant_declare_usd;
                $ligne_declaration->auteur_id = $id_user;
                $is_done = $ligne_declaration->save();
            } else $is_done = true;
        }

        if(!$is_done) return false;

        $lignes_restauration = Input::post('lignes_restauration', null);
        if (null != $lignes_restauration) {
            $montants_declares_cdf_restauration = Input::post('montants_declares_cdf_restauration');
            $montants_declares_usd_restauration = Input::post('montants_declares_usd_restauration');

            for ($i = 0; $i < count($lignes_restauration); $i++) { 
                $ligne_restauration_id = $lignes_restauration[$i];

                $ligne_declaration = Model_LigneDeclaration::find($ligne_restauration_id);
                $montant_declare_cdf =  floatval($montants_declares_cdf_restauration[$ligne_restauration_id.'']);
                $montant_declare_usd = floatval($montants_declares_usd_restauration[$ligne_restauration_id.'']);

                if($ligne_declaration->montant_declare_cdf != $montant_declare_cdf 
                || $ligne_declaration->montant_declare_usd != $montant_declare_usd) {
                    $ligne_declaration->montant_declare_cdf = $montant_declare_cdf;
                    $ligne_declaration->montant_declare_usd = $montant_declare_usd;
                    $ligne_declaration->auteur_id = $id_user;
                    $is_done = $ligne_declaration->save();
                } else $is_done = true;
                
                if(!$is_done) return false;
            }
        }
        return $is_done;
    }
    
    //
    public static function delete($id)
    {
        $declaration = Model_Declaration::find($id);
        return $declaration->delete();
    }
  
    //
    public static function getAll() {
        return Model_Declaration::query()
               ->order_by('id', 'desc')
               ->related('lignes_declaration')
               ->get();
    }

    //
    public static function getOne($id)
    {
        return Model_Declaration::find($id);
    }

    //
    public static function getOneWithRelated($id)
    {
        return Model_Declaration::query()
                ->where('id', $id)
                ->related(['etablissement', 'lignes_declaration'])
                ->get_one();
    }

    //
    public static function getOneByNumero($numero)
    { 
        return Model_Declaration::query()
                ->where('numero', $numero)
                ->related(['etablissement', 'lignes_declaration'])
                ->get_one();
    }

    public static function getOneByPeriodeBeforePersist($id_user) {
        $mois_concerne = self::$Mois[(Input::post('cle_mois'))];
        $annee_concernee = trim(Input::post('annee_concernee'));
        
        $gestionnaire = Dao_Gestionnaire::getOneWithRelated($id_user);

        return Model_Declaration::query()
                ->where('etablissement_id', $gestionnaire->etablissement_id)
                ->where('mois_concerne', $mois_concerne)
                ->where('annee_concernee', $annee_concernee)
                ->get_one();
    }

    public static function getOneByPeriodeBeforeUpdate($declaration_id) {
        $declaration = self::getOne($declaration_id);
        $mois_concerne = self::$Mois[(Input::post('cle_mois'))];
        $annee_concernee = trim(Input::post('annee_concernee'));

        return Model_Declaration::query()
                ->where('id', '<>', $declaration->id)
                ->where('etablissement_id', $declaration->etablissement_id)
                ->where('mois_concerne', $mois_concerne)
                ->where('annee_concernee', $annee_concernee)
                ->get_one();
    }

    //
    public static function getAllByEtablissement($id_etablissement) {
        return Model_Declaration::query()
            //->related(['etablissement', 'auteur'])
            ->where('etablissement_id', $id_etablissement)
            ->related('lignes_declaration')
            ->get();
    }

    //
    public static function getAllByAuteur($id_auteur)
    {
        return Model_Declaration::query()
            ->where('auteur_id', $id_auteur)
            ->where('est_teledeclaree', true)
            ->get();
    }

    //
    public static function getAllByAuteurFonctionnaire($id_auteur) {
        return Model_Declaration::query()
            ->where('auteur_id', $id_auteur)
            ->where('est_teledeclaree', false)
            ->get();
    }

    public static function getAuteurDeclaration($declaration) {
        return $declaration->est_teledeclaree ? 
        Dao_Gestionnaire::getOne($declaration->auteur_id) : 
        Dao_Fonctionnaire::getOne($declaration->auteur_id);
    }

    public static function getNextId()
    {
        $result = \DB::query("SELECT MAx(id) as max FROM declaration")->as_assoc()->execute();
        return $result !=null ? $result[0]['max'] + 1 : 1 ;
    }
    
    public static function pay($id) {
        $declaration = Model_Declaration::find($id);
        $declaration->statut = self::$StatutAttenteApurement;
        $declaration->save();
    }
    
    public static function sign($id) {
        $declaration = Model_Declaration::find($id);
        $declaration->est_signee = true;
        $declaration->save();
    }
    
    public static function sentToCollecteur($id) {
        $declaration = Model_Declaration::find($id);
        $declaration->statut = self::$StatutAttentePaiement;
        $declaration->save();
    }
	
	public static function sentApurementToCollecteur($id) {
        $declaration = Model_Declaration::find($id);
        $declaration->statut = self::$StatutApuree;
        return $declaration->save();
    }
    
    public static function sendToAdministration($id) {
        $declaration = Model_Declaration::find($id);
        $declaration->statut = self::$StatutPriseEnCompte;
        $declaration->est_envoyee = true;
        $declaration->date_denvoie = Utils::RenvoyerNow();
        $declaration->save();
    }
}
