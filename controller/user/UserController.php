<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

    session_start();
    require_once ("../../model/UserRepository.php");
    require "../../vendor/autoload.php";

    class userController 
    {
        private $userRepository;
        
        public function __construct()
        {
            $this->userRepository = new UserRepository();
        }

        // Permet de valider l'email et le password
        public function validateLoginFieldes($email, $password)
        {
            if (empty($email) || empty($password)) {
                return "Tout les champs sont obligatoires.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "L'email fournit est invalide.";
            }
            return null;
        }

        // Permet de faire la gestion des erreurs
        public function setErrorAndRedirect($message, $title, $redirectUrl = "login")
        {
            $_SESSION["error"] = $message;
            header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" .urldecode($title));
            exit;
        }

        // Permet de faire la gestion message des success
        public function setSuccessAndRedirect($message, $title, $redirectUrl = "admin")
        {
            $_SESSION["success"] = $message;
            header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" .urldecode($title));
            exit;
        }

        // Permet d'authenfier le super administrateur
        public function authSuperAdmin($email, $password)
        {
            if ($email === "ag@gmail.com" && $password === "@ag12345") {
                $_SESSION["id"] = 1;
                $_SESSION["email"] = $email;
                $_SESSION["nom"] = "Ass Gaye";
                $_SESSION["etat"] = 1;
                $_SESSION["photo"] = "default.jpg";
                $this->setSuccessAndRedirect("Bienvenue sur dashboard admin", "Connexion Reussie.");
            }
            return false;
        }

        // Permet d'authenfier un administrateur
        public function authAdmin($email, $password, $userRepository)
        {
            $user = $userRepository->login($email, $password);

            if ($user && $user['etat'] == 1) {
                $_SESSION["id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["etat"] = $user["etat"];
                $_SESSION["photo"] = $user["photo"];

                if (isset($_POST['remember'])) {
                    setcookie('remember_me', $user['id'], time() + 86400 * 30, '/', '', false, true);
                }

                $this->setSuccessAndRedirect("Bienvenue sur dashboard admin", "Connexion Reussie.");
            }
            else
            {
                $this->setErrorAndRedirect("Votre compte a ete desactiver", "Acces non autorises.");
            }
            return false;
        }

        // Authentification
        function auth()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');
    
                // Validation des champs
                $messageError = $this->validateLoginFieldes($email, $password);
                if ($messageError) {
                    $this->setErrorAndRedirect($messageError, "Erreur de connexion");
                }
    
                // Verifier si c'est un super Administrateur
                if ($this->authSuperAdmin($email, $password)) {
                    exit;
                }
    
                // Authentification classique des Administrateur via la methode login()
                if (!$this->authAdmin($email, $password, $this->userRepository)) {
                    $this->setErrorAndRedirect("Identifiants incorrects", "Erreur de connexion");
                }
                
            }
        }

        // Permet de deconecter un administrateur
        public function logout()
        {
            // Suppression des variable de saissions
            session_unset();
            session_destroy();

            if (isset($_COOKIE['remember_me'])) {
                    setcookie('remember_me', '', time() - 3000, '/', '', false, true);
                }

                $this->setSuccessAndRedirect("Vous avez ete deconecte avec succes", "Deconnexion Reussie.", "home");
        }

        //Permet de generer un mot de passe par defaut
        private function generateDefaultPassword($length = 8)
        {
            $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $chaineLength = strlen($chaine); // 62
            $randomPassword = '';

            for ($i=0; $i < $length; $i++) { // 8 fois par defaut
                $randomPassword .= $chaine[rand(0, $chaineLength - 1)]; // 0 a 61
            }
            return $randomPassword;
        }

        // Permet d'envoyer un email contenant les identifiant de connexion (email,password)
        public function sendPasswordEmail($nom, $email, $password, $message)
        {
            $mail = new PHPMailer(true);

            try {
                // Configuration du server SMPT
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = '16b0d3b898c96b';
                $mail->Password = 'b036a19cf4624f';
                $mail->Port = 2525;

                // Expediteur
                $mail->setFrom('no-reply@aggraphiste.com', 'AG Graphiste');
                // Destinateur
                $mail->addAddress($email, 'Utilisateur');

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Bienvenue sur la plate-forme AG Graphiste';
                $mail->Body = "
                    <h1>Bienvenue <b>{$nom}</b> !</h1>
                    <p>{$message} :</p>
                    <ul>
                        <li>Email : <strong>{$email}</strong> </li>
                        <li>Mot de passe : <strong>{$password}</strong> </li>
                    </ul>
                    <p>Merci de vous connecter pour commencer.</p>
                ";
                $mail->AltBody = "Bravo ! Voici vos identifiant.  Email  : {$email} , Mot de passe  {$password}:";

                // Envoyer de l'email
                $mail->send();
                echo "Email envoyé avec succès à  {$email}";
            } catch (Exception $error) {
                echo "Erreur lors de envoi de l'email :  {$email->ErrorInfo}" ;
            }
        }

        // Permet d'enregistrer un utilisateur
        public function registerUser()
        {
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recuperation des donnes
                $nom = trim($_POST['add-user-nom'] ?? '');
                $adresse = trim($_POST['add-user-adresse'] ?? '');
                $telephone = trim($_POST['add-user-telephone'] ?? '');
                $email = trim($_POST['add-user-email'] ?? '');
                $role = trim($_POST['add-user-role'] ?? 'Admin');
                $photo = $_FILES['add-user-photo'] ?? null;
                $createdBy = $_SESSION['id'] ?? null;

                // Generation du mot de passe par defaut
                $password = $this->generateDefaultPassword();

                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                // Verifier si un utilisateur avec cet email existe daja
                if ($this->userRepository->getUserByEmail($email)) {
                    $this->setErrorAndRedirect("Cet e-mail est déjà utilisé", "Erreur de création de compte", "listeUser");
                }

                // Validation des donnees
                if (empty($nom) || empty($adresse) || empty($telephone) || empty($email)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires", "Erreur de création de compte", "listeUser");
                }

                // Validation du role
                if (!in_array($role, ['Admin', 'User'])) {
                    $this->setErrorAndRedirect("Le Role selectionne est invalide.", "Erreur de modification", "listeUser");
                }

                // Validation email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->setErrorAndRedirect("L'adresse email est invalide.", "Erreur de création de compte", "listeUser");
                }

                // Validation de la photo
                $photoName = null;
                if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
                    // Recuperation de la photo
                    $uploadDir = "../../public/images/user/";
                    $photoName = uniqid() . "_" . basename($photo['name']);
                    $uploadPath = $uploadDir . $photoName;
                }
    
                // Deplacement de la photo
                if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                    $this->setErrorAndRedirect("Echec du telechargement de la photo.", "Erreur de création de compte", "listeUser");
                }

                try {
                    $userId = $this->userRepository->register(
                        $nom, $adresse, $telephone, $photoName, $email, $hashPassword, $role, $createdBy
                    );

                    if ($userId) {

                    $message = $role == "Admin"
                        ? "Un mail contenant les identifiants de connexion à été envoyé"
                        : "Compte créé avec succès";
                        // Envoi du mail
                        if ($role == "Admin") {
                            $this->sendPasswordEmail($nom, $email, $password, "Votre compte a ete cree avec succes. Voici vos identifiant : ");
                        }
                        $this->setSuccessAndRedirect($message, "Compte créé avec succès", "listeUser");
                    }
                } catch (Exception $error) {
                        $this->setErrorAndRedirect("Erreur " . $error->getMessage(), "Erreur de création de compte", "listeUser");
                }

            }
        }

        // Permet de changer le mot de passe  d'un utilisateur
        public function changePassword()
        {
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recuperation des donnes
                $userId = $_SESSION['id'] ?? null;
                $currentPassword = trim($_POST['current_password'] ?? '');
                $newPassword = trim($_POST['new_password'] ?? '');
                $confirmPassword = trim($_POST['confirm_password'] ?? '');

                // Verifier si l'utilisateur est connecter
                if (!$userId) {
                    $this->setErrorAndRedirect("Vous devez vous connecter d'abord pour changer votre mot de passe", "Accès non autorisé");
                }

                // Validation des donnees
                if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires", "Erreur de modification du password", "listeUser");
                }

                // Validation des deux password (nouveau et confirmation)
                if ($newPassword !== $confirmPassword) {
                    $this->setErrorAndRedirect("Le nouveau mot de passe et le mot de passe de confirmation ne correspond pas.", "Erreur de modification du password", "listeUser");
                }

                // Validation si le nouveau mot de passe est egal a 8 caractere ous pas
                if (strlen($newPassword) < 8) {
                    $this->setErrorAndRedirect("Le nouveau mot de passe doit contenir au moins 8 caractères.", "Erreur de modification du password", "listeUser");
                }

                // Appele getById de userRepository pour recuperer id de user
                try {
                    $user = $this->userRepository->getById($userId);

                    if (!$user) {
                        $this->setErrorAndRedirect("Utilisateur non trouvé dans la base de données.", "Erreur de modification du password", "listeUser");
                    }

                    // Verifie si current_password saisie par user est correspond au password actuel de la BD
                    if (!password_verify($currentPassword, $user['password'])) {
                        $this->setErrorAndRedirect("Le nouveau mot de passe saisie ne correspond pas avec encein.", "Erreur de modification du password", "listeUser");
                    }

                    // Hachage du password
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Changement du password dans la BD
                    $this->userRepository->updatedPassword($userId, $hashedPassword);

                    // envoi mail
                    $this->sendPasswordEmail($user['nom'], $user['email'], $newPassword, "Votre mot de passe a ete changer avec succes. Voici vos identifiant : ");

                    $this->setSuccessAndRedirect("Votre mot de passe à été changé Avec succès", "Modification réussie", "listeUser");
                } catch (Exception $error) {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de la modification du mot de passe : " . $error->getMessage(), "Erreur de modification du password", "listeUser");
            
                }
            }
        }

        // Permet de desactiver un utilisateur dans la BD
        public function desactivateUser()
        {
            $id = intval($_GET['id']);
            $deletedBy = $_SESSION['id'] ?? null;
            $etatUser = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatUser !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Acces non autorise", "login");
            }

            // Verification Id 1
            if (($id == 1)) {
                $this->setErrorAndRedirect("Impossible de supprimer le super admin", "Acces non autorise", "listeUser");
            }

            // Verification des donnees
            if (empty($id) || empty($deletedBy)) {
                $this->setErrorAndRedirect("Impossible de desactiver cette utilisateur", "Information manquantes");
            }

            // Appel du repository pour desactiver
            try {
                $result = $this->userRepository->desactivate($id, $deletedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Utilisateur supprime avec succes", "Supprission reusie", "listeUser");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la suppression" . $error->getMessage(), "Erreur de suppression", "listeUser");
            }
        }

        // Permet de restaurer un utilisateur dans la BD
        public function activateUser()
        {
            $id = intval($_GET['id']);
            $updatedBy = $_SESSION['id'] ?? null;
            $etatUser = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatUser !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Acces non autorise", "login");
            }

            // Verification des donnees
            if (empty($id) || empty($updatedBy)) {
                $this->setErrorAndRedirect("Impossible de restaurer cette utilisateur", "Information manquantes");
            }

            // Appel du repository pour activer
            try {
                $result = $this->userRepository->activate($id, $updatedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Utilisateur restaurer(e) avec succes", "Restauration reusie", "listeUser");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la restauration" . $error->getMessage(), "Erreur de suppression", "listeUser");
            }
        }

        // Permet de modifier un utilisateur dans la BD
        public function editUser()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $id = intval(trim($_POST['edit-user-id'] ?? ''));
                $nom = trim($_POST['edit-user-nom'] ?? '');
                $adresse = trim($_POST['edit-user-adresse'] ?? '');
                $telephone = trim($_POST['edit-user-telephone'] ?? '');
                $email = trim($_POST['edit-user-email'] ?? '');
                $role = trim($_POST['edit-user-role'] ?? 'Admin');
                $photo = $_FILES['edit-user-photo'] ?? null;
                $updatedBy = $_SESSION['id'] ?? null;

                // Validation des donnees
                if (empty($nom) || empty($adresse) || empty($telephone) || empty($email) || empty($role)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification", "listeUser");
                }

                // Validation du role
                if (!in_array($role, ['Admin', 'User'])) {
                    $this->setErrorAndRedirect("Le Role selectionne est invalide.", "Erreur de modification", "listeUser");
                }

                // Validation de la photo
                $photoName = null;
                if ($photo) {
                    // Recuperation de la photo
                    $uploadDir = "../../public/images/user/";
                    $photoName = uniqid() . "_" . basename($photo['name']);
                    $uploadPath = $uploadDir . $photoName;
    
                    // Deplacement de la photo
                    if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                        $this->setErrorAndRedirect("Echec du telechargement de la photo.", "Erreur de modification", "listeUser");
                    }
                }
                // Si aucune photo n'est choisie, conserver l'ancienne photo
                if (!$photoName) {
                    $photoName = trim($photo['current-photo'] ?? '');
                }

                // Appel de la methode edit pour modifier dans la BD
                try {
                   $reponse = $this->userRepository->edit( $id, $nom, $adresse, $telephone, $photoName, $email, $role, $updatedBy);
                   if ($reponse) {
                    $msg = $role == 'Admin' ? "Administrateur modifier avec success." : "User modifier avec success.";
                    $this->setSuccessAndRedirect($msg, "modification reussie", "listeUser");
                   }
                   else
                    {
                        $this->setErrorAndRedirect("Une erreur est survenue lors de la modification.", "Erreur de modification", "listeUser");
                    }
                } catch (Exception $error) {
                        $this->setErrorAndRedirect("Erreur" . $error->getMessage(), "Erreur de modification", "listeUser");
                }
            }
        }

        // Authentification
        public function sendMailConfirmUser()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = trim($_POST['reinit-confirm-email'] ?? '');

                // Validation des champs
                 if (empty($email)) {
                    $this->setErrorAndRedirect("L'adresse email est obligatoire", "Erreur de confirmation", "reinitEmail");
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->setErrorAndRedirect("L'email fournit est invalide", "Erreur de confirmation", "reinitEmail");
                }

                // Verifier si un utilisateur avec cet email existe daja
                if (!$this->userRepository->getUserByEmail($email)) {
                    $this->setErrorAndRedirect("Ce compte est introuvable !", "Erreur de confirmation", "reinitEmail");
                }

                $code = $this->generateDefaultPassword();
                $_SESSION['code'] = $code;
                $_SESSION['email-user-reinit'] = $email;
                $message = "<a href='http://localhost/FORMATION/PortfolioApp/reinit?code=$code&email=$email'> Merci de cliquer ici pour reinitialiser votre mot de passe</a>";
                // $this->newseletterController->sendMessageMail($email, $message);

                $this->setSuccessAndRedirect("Email de reinitialisation du mot de passe envoyer avec succes.", "Reinitialisation du mot de passe", "reinitEmail");
                
            }
        }

        // Permet de reinitialiser le mot de passe  d'un utilisateur
        public function ReinitPassword()
        {
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recuperation des donnes
                $newPassword = trim($_POST['new-password-reinit'] ?? '');
                $confirmPassword = trim($_POST['confirm-password-reinit'] ?? '');

                $code =$_SESSION['code'];

                // Validation des donnees
                if (empty($newPassword) || empty($confirmPassword)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires", "Erreur de reinitialisation du password", "reinit?code=$code");
                }

                // Validation des deux password (nouveau et confirmation)
                if ($newPassword !== $confirmPassword) {
                    $this->setErrorAndRedirect("Le nouveau mot de passe et le mot de passe de confirmation ne correspond pas.", "Erreur de reinitialisation du password", "reinit?code=$code");
                }

                // Validation si le nouveau mot de passe est egal a 8 caractere ous pas
                if (strlen($newPassword) < 8) {
                    $this->setErrorAndRedirect("Le nouveau mot de passe doit contenir au moins 8 caractères.", "Erreur de reinitialisation du password", "reinit?code=$code");
                }

                // Appele getById de userRepository pour recuperer id de user
                try {
                    $user = $this->userRepository->getUserByEmail($_SESSION['email-user-reinit']);

                    if (!$user) {
                        $this->setErrorAndRedirect("Utilisateur non trouvé dans la base de données.", "Erreur de modification du password", "reinit?code=$code");
                    }

                    // Hachage du password
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Changement du password dans la BD
                    $this->userRepository->updatedPassword($user['id'], $hashedPassword);

                    // envoi mail
                    $this->sendPasswordEmail($user['nom'], $user['email'], $newPassword, "Votre mot de passe a ete reinitialiser avec succes. Voici vos identifiant : ");

                    $this->setSuccessAndRedirect("Votre mot de passe à été reinitialiser Avec succès", "Reinitialisation réussie", "login");
                } catch (Exception $error) {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de la reinitialisation du mot de passe : " . $error->getMessage(), "Erreur de modification du password", "reinit?code=$code");
            
                }
            }
        }

        

        
    }
    

?>