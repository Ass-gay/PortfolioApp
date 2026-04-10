<?php 
    require_once("DbRepository.php");

    class CompetenceRepository extends DbRepository
    {
        // Recuperer la liste des Competence
        public function getAll(int $etat)
        {
            $sql = "SELECT 
                        com.*,
                        u1.email as created_by_email,
                        u2.email as updated_by_email
                    FROM competences com
                    LEFT JOIN
                        users u1 ON com.created_by = u1.id

                    LEFT JOIN
                        users u2 ON com.updated_by = u2.id
                    WHERE com.etat = :etat";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(['etat' => $etat]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                $etatLabel = $etat == 1 ? "actives" : "supprimes";
                error_log("Erreur lors de la recuperation des $etatLabel" . $error->getMessage());
                throw $error;
            }
        }

        // Recuperer un Competence via son ID
        public function getCompetenceById(int $id)
        {
            $sql = "SELECT * FROM competences WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([':id' => $id]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la recuperation de la competences d'id $id" . $error->getMessage());
                throw $error;
            }
        }

        // Permet d'ajouter une nouvelle Competence
        public function add($nom, $description, $niveau, $createdBy)
        {
            $sql = "INSERT INTO competences (nom, description, niveau, etat, created_at, created_by)
                    VALUES (:nom, :description, :niveau, default, NOW(), :created_by) ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'description' => $description,
                    'niveau' => $niveau,
                    'created_by' => $createdBy
                ]);
                $lastInsertId = $this->db->lastInsertId();
                return $lastInsertId ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'ajout de la competence $nom " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de modifier une nouvelle Competence
        public function edit($id, $nom, $description, $niveau, $updatedBy)
        {
          $sql = "UPDATE competences
            SET nom = :nom,
                description = :description,
                niveau = :niveau, 
                updated_at = NOW(), 
                updated_by = :updated_by 
            WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'description' => $description,
                    'niveau' => $niveau,
                    'updated_by' => $updatedBy,
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors la modification de la competence $nom " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de desactiver un Competence
        public function desactivate($id, $deletedBy)
        {
            $sql = "UPDATE competences
                    SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE id = :id ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([ 'deleted_by' => $deletedBy,'id' => $id]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors la desactivation de la competences d/id $id  " . $error->getMessage());
                throw $error;
            }
        }

        // Permet d'activer un Competence
        public function activate($id, $updatedBy)
        {
            $sql = "UPDATE competences
                    SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE id = :id ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([ 'updated_by' => $updatedBy,'id' => $id]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors l'activation de la competencesd/id $id  " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de supprime devinitivement un Competence 
        public function delete(int $id)
        {
            $sql = "DELETE FROM competences WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la suppression de la competences d'id $id" . $error->getMessage());
                throw $error;
            }
        }

    }
    
?>