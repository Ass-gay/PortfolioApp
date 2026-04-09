<?php 
    require_once("DbRepository.php");

    class ProjetServiceRepository extends DbRepository
    {
        // Recuperer la liste des service et des projet
        public function getAll(int $etat)
        {
            $sql = "SELECT 
                        sp.*,
                        u1.email as created_by_email,
                        u2.email as updated_by_email
                    FROM projetServices sp
                    LEFT JOIN
                        users u1 ON sp.created_by = u1.id

                    LEFT JOIN
                        users u2 ON sp.updated_by = u2.id
                    WHERE sp.etat = :etat";
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

        // Recuperer la liste des service ou projet
        public function getAllByEtatAndType(int $etat, string $type)
        {
            $sql = "SELECT * FROM projetServices WHERE etat = :etat and type = :type";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(['etat' => $etat,'type' => $type]);
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                $etatLabel = $etat == 1 ? "actives" : "supprimes";
                $typeLabel = $type == "Projet" ? "Projet" : "services";
                error_log("Erreur lors de la recuperation des $typeLabel $etatLabel" . $error->getMessage());
                throw $error;
            }
        }

        // Recuperer un service ou projet via son ID
        public function getServiceProjetById(int $id)
        {
            $sql = "SELECT * FROM projetServices WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([':id' => $id]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la recuperation de la service/projet d'id $id" . $error->getMessage());
                throw $error;
            }
        }

        // Permet d'ajouter une nouvelle service ou projet
        public function add($titre, $description, $photo, $type, $createdBy)
        {
            $sql = "INSERT INTO projetServices (titre, description, photo, type, etat, created_at, created_by)
                    VALUES (:titre, :description, :photo, :type, default, NOW(), :created_by) ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'titre' => $titre,
                    'description' => $description,
                    'photo' => $photo,
                    'type' => $type,
                    'created_by' => $createdBy
                ]);
                $lastInsertId = $this->db->lastInsertId();
                return $lastInsertId ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'ajout de la service/projet $titre " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de modifier une nouvelle service ou projet
        public function edit($id, $titre, $description, $photo, $type, $updatedBy)
        {
          $sql = "UPDATE projetServices
            SET titre = :titre,
                description = :description,
                photo = :photo, 
                type = :type,
                updated_at = NOW(), 
                updated_by = :updated_by 
            WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'titre' => $titre,
                    'description' => $description,
                    'photo' => $photo,
                    'type' => $type,
                    'updated_by' => $updatedBy,
                    'id' => $id
                ]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors la modification de la service/projet $titre " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de desactiver un service ou projet
        public function desactivate($id, $deletedBy)
        {
            $sql = "UPDATE projetServices
                    SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE id = :id ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([ 'deleted_by' => $deletedBy,'id' => $id]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors la desactivation de la service/projet d/id $id  " . $error->getMessage());
                throw $error;
            }
        }

        // Permet d'activer un service ou projet
        public function activate($id, $updatedBy)
        {
            $sql = "UPDATE projetServices
                    SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE id = :id ";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([ 'updated_by' => $updatedBy,'id' => $id]);
                $rowAffected = $statement->rowCount();
                return $rowAffected > 0; // True Si $rowAffected > 0
            } catch (PDOException $error) {
                error_log("Erreur lors l'activation de la service/projet d/id $id  " . $error->getMessage());
                throw $error;
            }
        }

        // Permet de supprime devinitivement un service ou projet 
        public function delete(int $id)
        {
            $sql = "DELETE FROM projetServices WHERE id = :id";
            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de la suppression de la service/projet d'id $id" . $error->getMessage());
                throw $error;
            }
        }
    }
?>