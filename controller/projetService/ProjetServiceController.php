<?php 

    require_once("../../model/ProjetServiceRepository.php");

    
    class ProjetServiceController
    {
        private $projetServiceRepository;
        
        public function __construct()
        {
            $this->projetServiceRepository = new ProjetServiceRepository();
        }

        // Permet de faire la gestion message des erreurs
        public function setErrorAndRedirect($message, $title, $redirectUrl = "listeProjetService")
        {
            $_SESSION["error"] = $message;
            header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet de faire la gestion message des success
        public function setSuccessAndRedirect($message, $title, $redirectUrl = "listeProjetService")
        {
            $_SESSION["success"] = $message;
            header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet d'ajouter une service / projet dans la BD
        public function addServiceProjet()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $titre = trim($_POST['titre'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $type = trim($_POST['type'] ?? '');
                $photo = $_FILES['photo'] ?? null;
                $createdBy = $_SESSION['id'] ?? null;

                // Validation des donnees
                if (empty($titre) || empty($description) || empty($type) || !$photo) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'ajout");
                }

                // Validation du type
                if (!in_array($type, ['Projet', 'Service'])) {
                    $this->setErrorAndRedirect("Le type selectionne est invalide.", "Erreur d'ajout");
                }

                // Validation de la photo
                if ($photo['error'] !== UPLOAD_ERR_OK) {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de la telechargement de la photo.", "Erreur d'ajout");
                }

                // Recuperation de la photo
                $uploadDir = "../../public/images/projetService/";
                $photoName = uniqid() . "_" . basename($photo['name']);
                $uploadPath = $uploadDir . $photoName;

                // Deplacement de la photo
                if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                    $this->setErrorAndRedirect("Echec du telechargement de la photo.", "Erreur d'ajout");
                }

                // Appel de la methode add pour inserer dans la BD
                try {
                   $reponse = $this->projetServiceRepository->add($titre, $description, $photoName, $type, $createdBy);
                   if ($reponse) {
                    $msg = $type == 'Projet' ? "Projet ajoutee avec success." : "Service ajoutee avec success.";
                    $this->setSuccessAndRedirect($msg, "Ajout reussie");
                   }
                   else
                    {
                        $this->setErrorAndRedirect("Une erreur est survenue lors de l'ajout.", "Erreur d'ajout");
                    }
                } catch (Exception $error) {
                        $this->setErrorAndRedirect("Erreur" . $error->getMessage(), "Erreur d'ajout");
                }
            }
        }

        // Permet de modifier une projet ou service dans la BD
        public function editServiceProjet()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $id = intval(trim($_POST['edit-id'] ?? ''));
                $titre = trim($_POST['edit-titre'] ?? '');
                $description = trim($_POST['edit-description'] ?? '');
                $type = trim($_POST['edit-type'] ?? '');
                $photo = $_FILES['edit-photo'] ?? null;
                $updatedBy = $_SESSION['id'] ?? null;

                // Validation des donnees
                if (empty($titre) || empty($description) || empty($type)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
                }

                // Validation du type
                if (!in_array($type, ['Projet', 'Service'])) {
                    $this->setErrorAndRedirect("Le type selectionne est invalide.", "Erreur de modification");
                }

                // Validation de la photo
                $photoName = null;
                if ($photo) {
                    // Recuperation de la photo
                    $uploadDir = "../../public/images/projetService/";
                    $photoName = uniqid() . "_" . basename($photo['name']);
                    $uploadPath = $uploadDir . $photoName;
    
                    // Deplacement de la photo
                    if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                        $this->setErrorAndRedirect("Echec du telechargement de la photo.", "Erreur de modification");
                    }
                }
                // Si aucune photo n'est choisie, conserver l'ancienne photo
                if (!$photoName) {
                    $photoName = trim($photo['current-photo'] ?? '');
                }

                // Appel de la methode edit pour modifier dans la BD
                try {
                   $reponse = $this->projetServiceRepository->edit( $id, $titre, $description, $photoName, $type, $updatedBy);
                   if ($reponse) {
                    $msg = $type == 'Projet' ? "Projet modifier avec success." : "Service modifier avec success.";
                    $this->setSuccessAndRedirect($msg, "modification reussie");
                   }
                   else
                    {
                        $this->setErrorAndRedirect("Une erreur est survenue lors de la modification.", "Erreur de modification");
                    }
                } catch (Exception $error) {
                        $this->setErrorAndRedirect("Erreur" . $error->getMessage(), "Erreur de modification");
                }
            }
        }

        // Permet de desactiver une Projet ou service dans la BD
        public function desactivateServiceProjet()
        {
            $id = intval($_GET['id']);
            $deletedBy = $_SESSION['id'] ?? null;
            $etatUser = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatUser !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Acces non autorise", "login");
            }

            // Verification des donnees
            if (empty($id) || empty($deletedBy)) {
                $this->setErrorAndRedirect("Impossible de desactiver cette service", "Information manquantes");
            }

            // Appel du repository pour desactiver
            try {
                $result = $this->projetServiceRepository->desactivate($id, $deletedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Projet/Service supprime(e) avec succes", "Supprission reusie", "listeProjetService");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la suppression" . $error->getMessage(), "Erreur de suppression", "listeProjetService");
            }
        }

        // Permet de restaurer une Projet ou service dans la BD
        public function activateServiceProjet()
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
                $this->setErrorAndRedirect("Impossible de restaurer cette Projet", "Information manquantes");
            }

            // Appel du repository pour activer
            try {
                $result = $this->projetServiceRepository->activate($id, $updatedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Projet/Service restaurer(e) avec succes", "Restauration reusie");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la restauration" . $error->getMessage(), "Erreur de suppression");
            }
        }

        // Permet de supprimer definitivement une Projet ou service dans la BD
        public function supDefServiceProjet()
        {
            $id = intval($_GET['id']);
            $etatUser = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatUser !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Accès non autorisé", "login");
            }

            // Verification des donnees
            if (empty($id)) {
                $this->setErrorAndRedirect("Impossible de supprimer cette réalisation", "Informations manquantes");
            }

            // Appel du repository pour supprimer
            try {
                $result = $this->projetServiceRepository->delete($id);

                if ($result > 0) {
                    $this->setErrorAndRedirect(
                        "Aucune Projet trouvée pour suppression",
                        "Suppression échouée"
                    );
                    } else {
                    $this->setSuccessAndRedirect(
                        "Projet/Service supprimé avec succès",
                        "Suppression réussie"
                    );
                }

            } catch (Exception $error) {
                $this->setErrorAndRedirect(
                    "Erreur lors de la suppression : " . $error->getMessage(),
                    "Erreur de suppression"
                );
            }
        }

    }

?>