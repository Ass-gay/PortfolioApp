<?php
    require_once("UserController.php");

    $userController = new UserController();

    // Permet de connecter
    if (isset($_POST['frmLogin'])) {
        $userController->auth();
    }

?>