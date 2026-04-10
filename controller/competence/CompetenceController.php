<?php 

    require_once("../../model/CompetenceRepository.php");

    
    class CompetenceController
    {
        private $competenceRepository;
        
        public function __construct()
        {
            $this->competenceRepository = new CompetenceRepository();
        }

        // Permet de faire la gestion message des erreurs
        public function setErrorAndRedirect($message, $title, $redirectUrl = "listeCompetence")
        {
            $_SESSION["error"] = $message;
            header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet de faire la gestion message des success
        public function setSuccessAndRedirect($message, $title, $redirectUrl = "listeCompetence")
        {
            $_SESSION["success"] = $message;
            header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet d'ajouter une competence dans la BD
        public function addCompetence()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $nom = trim($_POST['nom-competence'] ?? '');
                $description = trim($_POST['description-competence'] ?? '');
                $niveau = trim($_POST['niveau-competence'] ?? '');
                $createdBy = $_SESSION['id'] ?? null;

                // Validation des donnees
                if (empty($nom) || empty($description) || empty($niveau)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'ajout");
                }

                // Appel de la methode add pour inserer dans la BD
                try {
                   $reponse = $this->competenceRepository->add($nom, $description, $niveau, $createdBy);
                   if ($reponse) {
                    $this->setSuccessAndRedirect("Competence ajoutee avec success.", "Ajout reussie");
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

        // Permet de modifier une competence dans la BD
        public function editCompetence()
        {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                
                // Recuperation des donnees du formulaire
                $id = intval(trim($_POST['edit-id-competence'] ?? ''));
                $nom = trim($_POST['edit-nom-competence'] ?? '');
                $description = trim($_POST['edit-description-competence'] ?? '');
                $niveau = trim($_POST['edit-niveau-competence'] ?? '');
                $updatedBy = $_SESSION['id'] ?? null;

                // Validation des donnees
                if (empty($nom) || empty($description) || empty($niveau)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
                }

                // Appel de la methode edit pour modifier dans la BD
                try {
                   $reponse = $this->competenceRepository->edit( $id, $nom, $description, $niveau, $updatedBy);
                   if ($reponse) {
                    $this->setSuccessAndRedirect("Competence modifier avec success.", "modification reussie");
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

        // Permet de desactiver une competence dans la BD
        public function desactivateCompetence()
        {
            $id = intval($_GET['id']);
            $deletedBy = $_SESSION['id'] ?? null;
            $etatCompetence = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatCompetence !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Acces non autorise", "login");
            }

            // Verification des donnees
            if (empty($id) || empty($deletedBy)) {
                $this->setErrorAndRedirect("Impossible de desactiver cette service", "Information manquantes");
            }

            // Appel du repository pour desactiver
            try {
                $result = $this->competenceRepository->desactivate($id, $deletedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Competence supprime(e) avec succes", "Supprission reusie", "listeCompetence");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la suppression" . $error->getMessage(), "Erreur de suppression", "listeCompetence");
            }
        }

        // Permet de restaurer une competence dans la BD
        public function activateCompetence()
        {
            $id = intval($_GET['id']);
            $updatedBy = $_SESSION['id'] ?? null;
            $etatCompetence = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatCompetence !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Acces non autorise", "login");
            }

            // Verification des donnees
            if (empty($id) || empty($updatedBy)) {
                $this->setErrorAndRedirect("Impossible de restaurer cette competence", "Information manquantes");
            }

            // Appel du repository pour activer
            try {
                $result = $this->competenceRepository->activate($id, $updatedBy);

                if ($result) {
                    $this->setSuccessAndRedirect("Competence restaurer(e) avec succes", "Restauration reusie");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la restauration" . $error->getMessage(), "Erreur de suppression");
            }
        }

        // Permet de supprimer definitivement une competence dans la BD
        public function supDefCompetence()
        {
            $id = intval($_GET['id']);
            $etatCompetence = $_SESSION['etat'] ?? null;

            // Verification de l'etat de l'utilisateur
            if ($etatCompetence !== 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas actif", "Accès non autorisé", "login");
            }

            // Verification des donnees
            if (empty($id)) {
                $this->setErrorAndRedirect("Impossible de supprimer cette Competence", "Informations manquantes");
            }

            // Appel du repository pour supprimer
            try {
                $result = $this->competenceRepository->delete($id);

                if ($result > 0) {
                    $this->setErrorAndRedirect(
                        "Aucune Competence trouvée pour suppression",
                        "Suppression échouée"
                    );
                    } else {
                    $this->setSuccessAndRedirect(
                        "Competence supprimé avec succès",
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