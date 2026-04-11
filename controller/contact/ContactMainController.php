<?php

    session_start();
    require_once("ContactController.php");

    $contactController = new ContactController();

    // Ajout un contact dans la BD
    if (isset($_POST['frmContact'])) {
        $contactController->addContact();
    }
?>