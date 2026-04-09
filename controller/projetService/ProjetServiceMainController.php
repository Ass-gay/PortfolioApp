<?php

    session_start();
    require_once("ProjetServiceController.php");

    $serviceProjetController = new ProjetServiceController();

    // Ajout d'un service/Projet
    if (isset($_POST['frmAddServiceProjet'])) {
        $serviceProjetController->addServiceProjet();
    }

    // Edition d'un service/projet
    if (isset($_POST['frmEditServiceProjet'])) {
        $serviceProjetController->editServiceProjet();
    }

    // Suppresion d'un service/projet
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
        $serviceProjetController->desactivateServiceProjet();
    }

    // Restauration d'un service/projet
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'restaurer') {
        $serviceProjetController->activateServiceProjet();
    }

    // Suppresion def d'un service/projet
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'supDef') {
        $serviceProjetController->supDefServiceProjet();
    }

?>