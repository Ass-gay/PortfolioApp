<?php
    require_once("UserController.php");

    $userController = new UserController();

    // Permet de connecter
    if (isset($_POST['frmLogin'])) {
        $userController->auth();
    }

    // Permet de deconnecter
    if (isset($_GET['logout'])) {
        $userController->logout();
    }

    // Permet de enregistre un user
    if (isset($_POST['frmAddUser'])) {
        $userController->registerUser();
    }

    // Permet de changer mot de passe
    if (isset($_POST['frmChangePassword'])) {
        $userController->changePassword();
    }

    // Suppresion un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
        $userController->desactivateUser();
    }

    // Restauration un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'restaurer') {
        $userController->activateUser();
    }

    // Edition d'un utilisateur
    if (isset($_POST['frmEditUser'])) {
        $userController->editUser();
    }

    // Edition d'un utilisateur
    if (isset($_POST['frmReinitConfirmMail'])) {
        $userController->sendMailConfirmUser();
    }

    // Edition d'un utilisateur
    if (isset($_POST['frmReiniPassword'])) {
        $userController->ReinitPassword();
    }

?>