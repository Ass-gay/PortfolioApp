<?php 

    require_once("../../model/ContactRepository.php");

    
    class ContactController
    {
        private $contactRepository;
        
        public function __construct()
        {
            $this->contactRepository = new ContactRepository();
        }

        // Permet de faire la gestion message des erreurs
        public function setErrorAndRedirect($message, $title, $redirectUrl = "home")
        {
            $_SESSION["error"] = $message;
            header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet de faire la gestion message des success
        public function setSuccessAndRedirect($message, $title, $redirectUrl = "home")
        {
            $_SESSION["success"] = $message;
            header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet d'ajouter un Contact dans la BD
        public function addContact()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $nom = trim($_POST['nom'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $sujet = trim($_POST['sujet'] ?? '');
                $message = trim($_POST['message'] ?? '');
                // Validation des donnees
                if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Message non envoyee");
                }

                // Validation email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->setErrorAndRedirect("L'adresse email est invalide.", "Message non envoyee");
                }

                // Appel de la methode add pour inserer dans la BD
                try {
                   $reponse = $this->contactRepository->add($nom, $email, $sujet, $message);
                   if ($reponse) {
                    $this->setSuccessAndRedirect("Message envoyer avec succes", "Envoi reussie");
                   }
                   else
                    {
                        $this->setErrorAndRedirect("Une erreur est survenue lors l'envoyer du message.", "Message non envoyee");
                    }
                } catch (Exception $error) {
                        $this->setErrorAndRedirect("Erreur" . $error->getMessage(), "Erreur d'envoi");
                }
            }
        }
    }
?>