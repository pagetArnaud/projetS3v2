<?php
class ControllerPanier{
    protected static $object = 'panier';

    public static function add(){
    if (empty(unserialize($_COOKIE['panier']))) {
        $panier[$_POST['idProduit']] = $_POST['quantite'];
    } else {
        $panier=unserialize($_COOKIE['panier']);
        $panier[$_POST['idProduit']] = $_POST['quantite'];
    }
    setcookie("panier", serialize($panier), time()+600);
    header('Location: ./index.php?controller=Panier&action=read');
    exit();
    }
    public static function read(){
        $view='detail';
        $pagetitle='Votre panier';
        require (File::build_path(array("view","view.php")));
    }
    public static function deleteAll(){
        setcookie ("panier", "", time() - 1);
        header('Location: ./index.php?controller=Panier&action=read');
        exit();
    }
    public static function delete(){
        $panier=unserialize($_COOKIE['panier']);
        unset($panier[$_GET['idProduit']]);
        setcookie("panier", serialize($panier), time()+600);
        header('Location: ./index.php?controller=panier&action=read');
        exit();
    }
}
?>