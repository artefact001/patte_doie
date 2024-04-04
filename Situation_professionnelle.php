<?php
class SituationProfessionnelle {
    private $connexion;
    private $contenu;

    public function __construct($connexion, $contenu) {
        $this->connexion = $connexion;
        $this->contenu = $contenu;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function add($contenu) {
        try {
            $sql = "INSERT INTO Situation_Professionnelle (Contenu) VALUES (:contenu)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $resultats = $stmt->execute();
            if ($resultats) {
                header("location: liste.php");
                exit();
            } else {
                die("Erreur : Impossible d'insérer des données.");
            }
        } catch (PDOException $e) {
            die("Erreur : Impossible d'insérer des données " . $e->getMessage());
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM Situation_Professionnelle";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        } catch (PDOException $e) {
            die("Erreur : Impossible d'afficher les éléments " . $e->getMessage());
        }
    }

    public function update($id, $contenu) {
        try {
            $sql = "UPDATE Situation_Professionnelle SET Contenu = :contenu WHERE ID = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM Situation_Professionnelle WHERE ID = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur : Impossible de supprimer la situation professionnelle : " . $e->getMessage());
        }
    }
}
?>
