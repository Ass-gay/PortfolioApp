<?php

    session_start();
    require_once("CompetenceController.php");

    $competenceController = new CompetenceController();

    // Ajout d'un Competence
    if (isset($_POST['frmAddcompetence'])) {
        $competenceController->addCompetence();
    }

    // Edition d'un Competence
    if (isset($_POST['frmEditcompetence'])) {
        $competenceController->editCompetence();
    }

    // Suppresion d'un Competence
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
        $competenceController->desactivateCompetence();
    }

    // Restauration d'un Competence
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'restaurer') {
        $competenceController->activateCompetence();
    }

    // Suppresion def d'un Competence
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'supDef') {
        $competenceController->supDefCompetence();
    }

?>