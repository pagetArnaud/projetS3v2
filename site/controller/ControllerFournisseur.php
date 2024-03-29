<?php
require_once File::build_path(array("model", "ModelFournisseur.php")); 
class ControllerFournisseur{
    protected static $object = 'fournisseur';
    public static function readAll() {
        $tab_fournisseur = ModelFournisseur::selectAll(); 
        $view='list';
        $pagetitle='Liste des Fournisseurs';
        require (File::build_path(array("view","view.php")));    
    }
    public static function read() {
    	$fournisseur = ModelFournisseur::select($_GET['idFournisseur']);   
    	if ($fournisseur==false) {
    		$view='error'; 
            $pagetitle='Erreur de recherche';
            $error='Erreur : le fournisseur n existe pas';
    	} else {
    		$view='detail'; 
            $pagetitle='Détails de '.$fournisseur->get("nomFournisseur");  
    	}
        require (File::build_path(array("view","view.php"))); 
    }
    public static function create() {
        $effect="created";
        $view='update';
        $pagetitle='Création d un fournisseur';
        $v = new ModelFournisseur();
        require (File::build_path(array("view","view.php")));
    }
    public static function created() {
        if (ModelFournisseur::save($_POST)===false) {
            $view='error';
            $pagetitle='Erreur insertion';
            $error='Erreur : le fournisseur existe déjà';
        } else {
            $tab_fournisseur = ModelFournisseur::selectAll();
            $view='created';
            $pagetitle='Liste des Fournisseurs';
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function delete() {
    	if (ModelFournisseur::delete($_GET['idFournisseur'])===false) {
            $view='error';
            $pagetitle='Erreur suppression';
            $error='Erreur : le fournisseur n existe pas';
    	} else {
	    	$tab_fournisseur = ModelFournisseur::selectAll();
            $view='deleted';
            $pagetitle='Liste des Fournisseurs';
    	}
        require (File::build_path(array("view","view.php")));
    }
    public static function update() {
        $effect="updated";
        $v = ModelFournisseur::select($_GET['idFournisseur']);
        $view='update';
        $pagetitle='Mise à jour';
        require (File::build_path(array("view","view.php")));
    }
    public static function updated() {
        if (ModelFournisseur::update($_POST)===false) {
            $view='error';
            $pagetitle='Erreur mise à jour';
        } else {
            $tab_fournisseur = ModelFournisseur::selectAll();
            $view='updated';
            $pagetitle='Liste des voitures';
        }
        require (File::build_path(array("view","view.php")));
    }
}
?>