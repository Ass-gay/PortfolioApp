<?php 

    session_start();
    require_once ("../../model/UserRepository.php");

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

        
    }
    

?>